<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Services\ModelService;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;


use Exception;
use App\Services\FileUploadService;

class PostController extends Controller
{
    protected Post $postService;
    protected Tag $tagService;
    protected Media $mediaService;

    protected $fileUploadService;
    
    public function __construct(ModelService $modelService, FileUploadService $fileUploadService){
        $this->postService = $modelService->postService();
        $this->tagService = $modelService->tagService();
        $this->mediaService = $modelService->mediaService();
        $this->fileUploadService =  $fileUploadService;

    }

    public function index(Request $request){
        $posts = Post::get();
        return Inertia::render('Posts/Index',[
            'type' => 'list',
            'posts' => $posts
        ]);
    }

    public function create(Request $request){
        $categories = Category::get();

        return Inertia::render('Posts/Index',[
            'type' => 'create',
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        // try{
            // dd($request->all());

            $tag_list = [];
            if($request->has('image')){
                $image = $request->file('image');
                $upload_url = $this->fileUploadService->upload($image,'images','cloudinary');

                $request['url'] = $upload_url['image_url'];
                $request['file_unique_id'] = $upload_url['public_id'];
                $request['cloud_provider'] = 'CLOUDINARY';
                $request['file_type'] = 'IMAGE';

                // ::::::::::: Save data in media table :::::::::::

                $media = $this->mediaService->store($request->all());
                $media_id = $media->id;
                $request['media_list_id'] = array($media_id);
            }
            if(!empty($request->tags) && is_array($request->tags)){
                foreach($request->tags as $tag){
                    array_push($tag_list , $this->tagService->storeAndReturnId($tag));
                }
            }

            $request['tag_id'] = $tag_list;
            $post = $this->postService->store($request->all());
            // return redirect
        // }catch(Exception $e){
        //     // return redirect()->back()->with('error' , $e->getMessage());
        // }
    }

    public function delete($postId){
        if(!empty($postId)){
            $this->postService->remove($postId,'id');
        }
    }

    public function edit(Request $request , $postId){


        $categories = Category::get();
        $relations = ['postMetas','tags','media'];

        $postDetail = $this->postService->getDetail($postId,$relations);

        $thumbnail = $postDetail->thumbnail();

        return Inertia::render('Posts/Index',[
            'type' => 'edit',
            'categories' => $categories,
            'postDetail' => $postDetail,
            'thumbnail' => $thumbnail
        ]);
    }

    public function update(Request $request){
       try{

        $rules = [
            'title' => 'required',
            'short_name' => 'required',
            'category_id' => 'required',
            'author' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = $this->postService->getDetail($request->id);
     
        $tag_list = [];

        if($request->has('image')){
            // Delete old image from cloudinary and update new one in db :::::::::::
            $image = $request->file('image');
            $deleteFile  = $this->fileUploadService->delete($post->thumbnail()->unique_id,'cloudinary');
            $upload_url = $this->fileUploadService->upload($image,'images','cloudinary');

            $request['url'] = $upload_url['image_url'];
            $request['file_unique_id'] = $upload_url['public_id'];
            $request['cloud_provider'] = 'CLOUDINARY';
            $request['file_type'] = 'IMAGE';
            $request['media_id'] = $post->thumbnail()->id ?? NULL;

            // ::::::::::: Update image info in media table :::::::::::

            $media = $this->mediaService->put($request->all()); 

        }

        if(!empty($request->tags) && is_array($request->tags)){
            foreach($request->tags as $tag){
                array_push($tag_list , $this->tagService->storeAndReturnId($tag));
            }
        }

        $request['tag_id'] = $tag_list;

        $post = $this->postService->put($request->all());
        

       }catch(Exception $e){
            $this->sendError([], $e->getMessage());
        }
    }
}
