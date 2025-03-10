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
        // $relations = [''];
        // $posts = $this->postService->list();
       
        // return Inertia::render('Posts/Index',[
        //     'type' => 'list',
        //     'posts' => $posts,
        // ]);
        return view('admin.pages.posts.index');
    }

    public function create(Request $request){
        $categories = Category::get();
        $post_type = [
            [
                'id' => 1,
                'name' => 'Banner'
            ],
            [
                'id' => 2,
                'name' => 'Popular'
            ],
            [
                'id' => 3,
                'name' => 'Quotes'
            ],
            [
                'id' => 4,
                'name' => 'Highlighted'
            ]
        ];
        return Inertia::render('Posts/Index',[
            'type' => 'create',
            'categories' => $categories,
            'post_type' => $post_type
        ]);
    }

    public function store(Request $request){
        try{
            // dd($request->all());
            $rules = [
                'title' => 'required',
                'short_name' => 'required',
                'content' => 'required',
                'author' => 'required',
                'category_id' => 'required',
                'content' => 'required',
            ];
            $message = [
                'category_id.required' => 'The category field is required.',
            ];

            $validator = Validator::make($request->all(), $rules,$message);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $tag_list = [];
            if($request->has('image') && $request->image != null){
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
            return redirect()->back()->with('success', 'Post created successfully !');
        }catch(Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
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
        // dd($postDetail);
        $post_type = [
            [
                'id' => 1,
                'name' => 'Banner'
            ],
            [
                'id' => 2,
                'name' => 'Popular'
            ],
            [
                'id' => 3,
                'name' => 'Quotes'
            ],
            [
                'id' => 4,
                'name' => 'Highlighted'
            ]
        ];

        return Inertia::render('Posts/Index',[
            'type' => 'edit',
            'categories' => $categories,
            'postDetail' => $postDetail,
            'thumbnail' => $thumbnail,
            'post_type' => $post_type
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
            if($request->has('image') && $request->image != null){
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
                    if(!isset($tag['id'])){
                        array_push($tag_list , $this->tagService->storeAndReturnId($tag));
                    }
                }
            }

            $request['tag_id'] = $tag_list;
            $post = $this->postService->put($request->all());

            return redirect()->back()->with('success', 'Post updated successfully !');

        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
