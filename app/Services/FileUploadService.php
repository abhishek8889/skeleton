<?php

namespace  App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Cloudinary\Laravel\Facades\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
class FileUploadService{

    /**
     * Save an image to the specified storage disk.
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string $disk
     * @return string $filename
     */
    public function upload( UploadedFile $file, $path = 'images', $disk = 'local')
    {
        $uploadedFile = [];
        if($disk == 'cloudinary'){
            $uploadedFile['image_url'] = cloudinary()->upload($file->getRealPath())->getSecurePath();
            $uploadedFile['public_id'] = cloudinary()->upload($file->getRealPath())->getPublicId();
        }
        // dd($uploadedFile);
        return $uploadedFile;
    }

}


?>
