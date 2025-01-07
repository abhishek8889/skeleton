<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
use App\Models\PostMeta;
use App\Services\ModelService;
use App\Models\Media;


class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','short_name','category_id','author','image_name','excerpt','status','type_id'];
    protected $appends = ['content','meta_tags','thumbnail'];

    
    public static function store($request){
        // dd($request['meta_tags']);
        $data = DB::transaction(function () use ($request) {
            $data = self::create([
                'title' => $request['title'] ,
                'slug' => Helper::generateSlug($request['title']) ,
                'short_name' => $request['short_name'] ,
                'category_id' => $request['category_id'] ?? NULL ,
                'author' => $request['author'] ,
                'image_name' => $request['image_name'] ?? NULL,
                'excerpt' => $request['excerpt'] ,
                'type_id' => $request['type_id'] ?? NULL,
                // 'content' => $request['content']
            ]);

            // :::::::::::::::::: Adding data in post meta table ::::::::::::::::::

            $this->storePostMeta($data->id, $request);

            // :::::::::::::::::: End ::::::::::::::::::

            // :::::::::::: Attach tag with posts ::::::::::::
            if(!empty($request['tag_id']) && count($request['tag_id']) > 0){
                $data->tags()->attach($request['tag_id']);
            }

            // :::::::::::: Attach media with posts ::::::::::::
            if(isset($request['media_list_id']) && is_array($request['media_list_id'] )){
                $data->media()->attach($request['media_list_id']);
            }

            return $data;
        });
        return $data;
    }

    /**
     * Store post meta data.
    */
    private static function storePostMeta($postId, $request)
    {
        $metaKeys = [
            'content' => $request['content'] ?? null,
            'meta_tags' => !empty($request['meta_tags']) ? json_encode($request['meta_tags']) : null,
            'thumbnail' => $request['media_list_id'][0] ?? null,
            'fb_link' => $request['fb_link'] ?? null,
            'insta_link' => $request['insta_link'] ?? null,
            'twitter_link' => $request['twitter_link'] ?? null,
            'email_link' => $request['email_link'] ?? null,
        ];

        $postMetaData = [];
        foreach ($metaKeys as $key => $value) {
            if (!empty($value)) {
                $postMetaData[] = [
                    'post_id' => $postId,
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($postMetaData)) {
            PostMeta::insert($postMetaData);
        }
    }

    public static function put($request){
        $data = DB::transaction(function () use ($request) {
            $data = self::updateOrCreate(
                [
                    'id' => $request['id']  // Search criteria
                ],
                [
                    'title' => $request['title'],
                    'slug' => Helper::generateSlug($request['title']),
                    'short_name' => $request['short_name'],
                    'category_id' => $request['category_id'],
                    'author' => $request['author'],
                    'excerpt' => $request['excerpt'],
                    'image_name' => $request['image_name'] ?? NULL
                ]
            );
            
            // :::::::::::::::::: Adding data in post meta table ::::::::::::::::::

            if(!empty($request['content'])){ 
                $data->content = $request['content'];
            }
            if( !empty($request['meta_tags'])){
                $data->meta_tags = $request['meta_tags'];
            }
            if(!empty($request['media_list_id']) && is_array(($request['media_list_id']))){
                $data->thumbnail = $request['media_list_id'][0];
            }
          
            // :::::::::::::::::: End ::::::::::::::::::
            
            // :::::::::::: Attach tag with posts ::::::::::::
            if(!empty($request['tag_id']) && count($request['tag_id']) > 0){
                $data->tags()->sync($request['tag_id']);
            }

            // :::::::::::: Attach media with posts ::::::::::::
            if(isset($request['media_list_id']) && is_array($request['media_list_id'] )){
                $data->media()->sync($request['media_list_id']);
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

    public static function getDetail($id,$relations = []){
        $data = DB::transaction(function () use ($id , $relations) {
            return self::with($relations)->find($id);
        });
        return $data;
    }

    public static function list($relations =[]){
        $data = DB::transaction(function () use ($relations) {
            return self::with($relations)->get();
        });
        return $data;
    }



    // public function postMeta(){
    //     return $this->hasOne(PostMeta::class,'post_id','id');
    // }

    public function postMetas()
    {
        return $this->hasMany(PostMeta::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'post_media', 'post_id', 'media_id');
    }

    public function thumbnail(){
        $media_id = $this->postMetas()->where('meta_key','thumbnail')->value('meta_value');
        if($media_id){
           $media = Media::find($media_id);
           return $media;
        }
        return null;
    }


    // :::::::::::: Mutators :::::::::::::
    
    public function setContentAttribute($value)
    {
        $this->postMetas()->updateOrCreate(
            ['meta_key' => 'content'],
            ['meta_value' => $value]
        );
    }

    public function setMetaTagsAttribute($value)
    {
        $this->postMetas()->updateOrCreate(
            ['meta_key' => 'meta_tags'],
            ['meta_value' => json_encode($value)]
        );
    }

    public function setThumbnailAttribute($value){
        $this->postMetas()->updateOrCreate(
            ['meta_key' => 'thumbnail'],
            ['meta_value' => $value]
        );
    }
    
    // :::::::::::: Accessors :::::::::::::

    public function getContentAttribute(){
        return $this->postMetas()->where('meta_key','content')->value('meta_value');
    }
    public function getMetaTagsAttribute(){
        $metaTags = $this->postMetas()->where('meta_key','meta_tags')->value('meta_value');
        return $metaTags ? json_decode($metaTags) : null;
    }
    public function getThumbnailAttribute(){
        $thumbnail_media_id = $this->postMetas()->where('meta_key','thumbnail')->value('meta_value');
        if($thumbnail_media_id){
            $media = Media::find($thumbnail_media_id);
            return $media ? $media->url : null;
        }else{
            return null;
        }
    }

}
