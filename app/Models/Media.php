<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['name','url','type','size','extension','mime_type','cloud_provider','unique_id'];

    public function store($request){
        $data = DB::transaction(function() use ($request){
            $data = self::create([
                'name' => $request['name'] ?? NULL,
                'url' => $request['url'] ?? NULL,
                'type' => $request['file_type'] ?? NULL,
                'size' => $request['file_size'] ?? NULL,
                'extension' => $request['file_extension'] ?? NULL,
                'mime_type' => $request['file_mime_type'] ?? NULL,
                'cloud_provider' => $request['cloud_provider'] ?? NULL,
                'unique_id' => $request['file_unique_id'] ?? NULL,
            ]);
            return $data;
        });
        return $data;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_media', 'media_id', 'post_id');
    }
}
