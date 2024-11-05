<?php

namespace  App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class FileUploadService{


    // /**
    //  * Save the uploaded image.
    //  *
    //  * @param \Illuminate\Http\UploadedFile $image
    //  * @param string $path
    //  * @return string $filename
    // */

    //  public function saveFile($file, $type ,$directory='')
    // {
    //     if($type = 'image'){
    //         $this->uploadImage($file,$directory='');
    //     }

    // }

    /**
     * Save an image to the specified storage disk.
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @param string $disk
     * @return string $filename
     */
    public function upload( UploadedFile $file, $path = 'images', $disk = 'local')
    {
        if(empty($file)){
            return array('status' => false ,'message' => 'No file found');
        }
        $filename = time() . '.' . $file->getClientOriginalExtension();
        Storage::disk($disk)->putFileAs($path, $file, $filename);
        return array(
            'url' => Storage::disk($disk)->url("{$path}/{$filename}"),
            'file_name' => $filename,
            'directory_path' => $path.'/'.$filename
        );
    }

}


?>
