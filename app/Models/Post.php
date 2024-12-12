<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
use App\Models\PostMeta;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','short_name','category_id','author','image_name','excerpt','status','type_id'];



    public static function store($request){
        // dd($request['meta_tags']);
        $data = DB::transaction(function () use ($request) {
            $data = self::create([
                'title' => $request['title'] ,
                'slug' => Helper::generateSlug($request['title']) ,
                'short_name' => $request['short_name'] ,
                'category_id' => $request['category_id'] ,
                'author' => $request['author'] ,
                'image_name' => $request['image_name'] ?? NULL,
                'excerpt' => $request['excerpt'] ,
                // 'content' => $request['content']
            ]);

            if(!empty($request['content']) || !empty($request['meta_tags'])){
                $postMeta = new postMeta([
                    'content' => $request['content'],
                    'meta_tags' => json_encode($request['meta_tags'])
                ]);
                $data->postMeta()->save($postMeta);
            }

            if(!empty($request['tag_id']) && count($request['tag_id']) > 0){
                $data->tags()->attach($request['tag_id']);
            }

            if(isset($request['media_list_id']) && is_array($request['media_list_id'] )){
                $data->media()->attach($request['media_list_id']);
            }

            return $data;
        });
        return $data;
    }

    public static function remove($id, $key)
    {
        $data = DB::transaction(function () use ($id, $key) {
            return self::where($key, $id)->delete();
        });

        return $data;
    }

    public static function getDetail($id){
        $data = DB::transaction(function () use ($id) {
            return self::with('postMeta','tags')->find($id);
        });
        return $data;
    }



    public function postMeta(){
        return $this->hasOne(PostMeta::class,'post_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'post_media', 'post_id', 'media_id');
    }




}
