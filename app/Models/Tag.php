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
            $tagExist = self::where('name',$tagName)->first();
            if(!$tagExist){
                $data = self::create([
                    'name' => $tagName,
                    'slug' => Helper::generateSlug($tagName)
                ]);
            }else{
                $data = $tagExist;
            }
            return $data->id;
        });
        return $data;
    }
   

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
