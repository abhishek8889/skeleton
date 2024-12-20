<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Media;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Validator;
use App\Services\ModelService;

class CategoryController extends Controller
{
    protected Category $categoryService;
    protected Media $mediaService;
    protected $fileUploadService;

    public function __construct(ModelService $modelService ,FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
        $this->categoryService = $modelService->categoryService();
        $this->mediaService = $modelService->mediaService();

    }
    public function index(Request $request){

        $categories = $this->categoryService->all();
        return Inertia::render('Categories/Index',[
            'type' => 'list',
            'categories' => $categories
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
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:categories|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('cat_image') && $request->cat_image != null){
                $image = $request->file('cat_image');
                $upload_url = $this->fileUploadService->upload($image,'images','cloudinary');
            
                $request['url'] = $upload_url['image_url'];
                $request['file_unique_id'] = $upload_url['public_id'];
                $request['cloud_provider'] = 'CLOUDINARY';
                $request['file_type'] = 'IMAGE';

                // ::::::::::: Save data in media table :::::::::::

                $media = $this->mediaService->store($request->all());
                $media_id = $media->id;
                $request['category_image'] = $media_id;

            }
            
            $category = Category::create([
                'name' => $request->name,
                'parent_id' => !empty($request->parent_id)?$request->parent_id:NULL,
                'category_image' => !empty($request['category_image'])?$request['category_image']:NULL,
                'status' => 1
            ]);
            return redirect()->back()->with('success','Category Added Successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function edit(Request $request){
        $parent_category = Category::whereNull('parent_id')->get();

        return Inertia::render('Categories/Index',[
            'type' => 'update',
            'parent_category' => $parent_category
        ]);
    }
}
