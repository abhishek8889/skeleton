<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ModelService;
use App\Models\Post;
use App\Http\Resources\Posts\PostResource;


class PostController extends Controller
{
    protected Post $postService;

    public function __construct(ModelService $modelService){
        $this->postService = $modelService->postService();
    }
    public function list(Request $request){
        try{
            $relations = ['tags'];
            $posts = $this->postService->list($relations);
            // return PostResource::collection($posts);
            return $this->sendResponse($posts, 'Post list fetched successfully');

        }catch(\Exception $e){
            return $this->sendError([],$e->getMessage(), 500);
        }
    }
    public function postDetail(Request $request){
        dd('ghhfh');
    }
}
