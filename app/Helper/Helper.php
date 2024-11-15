<?php 

namespace App\Helper;
class Helper{
    public static function generateSlug($name =''){
        $random_string = self::generateRandomString(4);
        $slug = strtolower(str_replace(' ', '-', $name)) . '-' . $random_string;
        return $slug;
    }

    public static function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
    }
}