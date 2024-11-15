<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','short_name','category_id','author','image_name','excerpt','content','status','type_id'];
   
   
  
    public static function store($request){
        $data = DB::transaction(function () use ($request) {
            $data = self::create([
                'title' => $request['title'] ,
                'slug' => Helper::generateSlug($request['title']) ,
                'short_name' => $request['short_name'] ,
                'category_id' => $request['category_id'] ,
                'author' => $request['author'] ,
                // 'image_name' => $request->image_name,
                'excerpt' => $request['excerpt'] ,
                'content' => $request['content'] 
            ]);
            if(!empty($request['tag_id']) && count($request['tag_id']) > 0){
                $data->tags()->attach($request['tag_id']);
            }
            return $data;

        });
        return $data;
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }




}
