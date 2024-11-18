<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','content','meta_tags   '];

    public function posts()
    {
        return $this->belongsTo(Post::class,'id','post_id');
    }
}
