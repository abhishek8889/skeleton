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

class PostController extends Controller
{
    protected Post $postService;
    protected Tag $tagService;
    public function __construct(ModelService $modelService){
        $this->postService = $modelService->postService();
        $this->tagService = $modelService->tagService();

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
            if(!empty($request->tags) && is_array($request->tags)){
            //    dd($request->tags);
                foreach($request->tags as $tag){
                    array_push($tag_list , $this->tagService->storeAndReturnId($tag));
                }
            }
            $request['tag_id'] = $tag_list;
            $post = $this->postService->store($request->all());
            // dd($post);
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

}
