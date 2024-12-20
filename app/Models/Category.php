<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','parent_id','status','category_image'];
    protected $appends = ['image'];


    public function categoryImage(){
        return $this->belongsTo(Media::class,'category_image');
    }

    public function getImageAttribute(){
        if(isset($this->categoryImage->url) && !empty($this->categoryImage->url)){
            return $this->categoryImage->url;
        }else{
            return NULL;
        }
        return $this->categoryImage->url;
    }

    
}
