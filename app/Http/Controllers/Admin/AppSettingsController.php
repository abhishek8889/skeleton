<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ModelService;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Media;

class AppSettingsController extends Controller
{
    protected Post $postService;
    protected Tag $tagService;
    protected Media $mediaService;

    public function __construct(ModelService $modelService){
        $this->postService = $modelService->postService();
        $this->tagService = $modelService->tagService();
        $this->mediaService = $modelService->mediaService();

    }
    public function index(Request $request){
        $posts = Post::get();
        return Inertia::render('AppSetting/Index',[
            'type' => 'list',
            'posts' => $posts
        ]);
    }
}
