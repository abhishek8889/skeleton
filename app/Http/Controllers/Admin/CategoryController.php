<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    protected $fileUploadService;
    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }
    public function index(Request $request){

        return Inertia::render('Categories/Index',[
            'type' => 'list'
        ]);
    }

    public function addCategory(Request $request){
        $parent_category = Category::whereNull('parent_id')->get();

        return Inertia::render('Categories/Index',[
            'type' => 'add',
            'parent_category' => $parent_category
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('category/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->hasFile('cat_image')){
            $file = $request->file('cat_image');
            $fileUpload = $this->fileUploadService->upload($file, 'category_image','public');
            if(!isset($fileUpload['file_name'])){
                return response()->json(['message' => 'Please try again.'],400);
            }
        }

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => !empty($request->parent_id)?$request->parent_id:NULL,
            'category_image' => !empty($fileUpload['directory_path'])?$fileUpload['directory_path']:NULL,
            'status' => 1
        ]);
        return to_route('categories.add');
    }

    public function edit(Request $request){
        $parent_category = Category::whereNull('parent_id')->get();

        return Inertia::render('Categories/Index',[
            'type' => 'update',
            'parent_category' => $parent_category
        ]); 
    }
}
