<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ModelService;
use App\Models\Post;


class PostController extends Controller
{
    protected Post $postService;

    public function __construct(ModelService $modelService){
        $this->postService = $modelService->postService();
    }
    public function list(Request $request){
        try{
            $posts = $this->postService->with('media')->get();
        
            return $this->sendResponse($posts, 'Post list fetched successfully');

        }catch(\Exception $e){
            return $this->sendError([],$e->getMessage(), 500);
        }
    }
    public function postDetail(Request $request){
        dd('ghhfh');
    }
}
