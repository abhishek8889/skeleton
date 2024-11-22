<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Services\ModelService;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use App\Services\FileUploadService;

class PostController extends Controller
{
    protected Post $postService;
    protected Tag $tagService;
    protected $fileUploadService;
    
    public function __construct(ModelService $modelService, FileUploadService $fileUploadService){
        $this->postService = $modelService->postService();
        $this->tagService = $modelService->tagService();
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
        try{
            // dd($request->all());

            $tag_list = [];
            if($request->has('image')){
                $image = $request->file('image');
                $upload_url = $this->fileUploadService->upload($image,'images','cloudinary');
                $request['image_name'] = $upload_url['image_url'];
                $request['public_id'] = $upload_url['public_id'];
            }
            if(!empty($request->tags) && is_array($request->tags)){
                foreach($request->tags as $tag){
                    array_push($tag_list , $this->tagService->storeAndReturnId($tag));
                }
            }
            $request['tag_id'] = $tag_list;
            $post = $this->postService->store($request->all());
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function delete($postId){
        if(!empty($postId)){
            $this->postService->remove($postId,'id');
        }
    }

    public function update(Request $request , $postId){
        // dd($postId);
        $categories = Category::get();
        $postDetail = $this->postService->getDetail($postId);
        // dd($postDetail);

        return Inertia::render('Posts/Index',[
            'type' => 'edit',
            'categories' => $categories,
            'postDetail' => $postDetail
        ]);
    }

}
