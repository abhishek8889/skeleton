<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request){
        return "hello from tag controller";
    }

    public function searchTag(Request $request){
        try{
            
            $search = !empty($request->search)?trim($request->search):'';
            if(!empty($search)){
                $tags = Tag::where('name','LIKE','%'.$search.'%')->get();
                return $this->sendResponse($tags,'Tags fetched successfully.');
            }

        }catch(\Exception $e){
            return $this->sendError([],$e->getMessage(),500);
            // return response()->json(['error'=>$e->getMessage()],500);
        }
    }
}
