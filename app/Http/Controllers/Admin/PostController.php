<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;


class PostController extends Controller
{
    public function index(Request $request){

        return Inertia::render('Posts/Index',[
            'type' => 'list'
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
        dd($request->all());
    }
}
