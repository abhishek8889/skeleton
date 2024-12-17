<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','meta_key','meta_value'];

    // Accessor

    public function getMetaTagsAttribute($value)
    {
        $metaTags = json_decode($value, true);

        return $metaTags ?: ['default' => 'No meta tags available'];
    }

    public function posts()
    {
        return $this->belongsTo(Post::class,'id','post_id');
    }

}
