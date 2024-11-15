<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    public static function store($request){
        $data = DB::transaction(function () use ($request) {
            $data = self::create([
                'name' => $request['name'],
                'slug' => Helper::generateSlug($request['name'])
            ]);
            return $data;
        });
        return $data;
    }
    public static function storeAndReturnId($tagName){
     
        $data = DB::transaction(function () use ($tagName) {
     
            $data = self::create([
                'name' => $tagName,
                'slug' => Helper::generateSlug($tagName)
            ]);
            return $data->id;
        });
        return $data;
    }
   

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
