<?php

namespace App\Services;

use Storage;
use Image;

class ImagesService extends Service
{
    public function resizeImage($fileParth, $fileName, $with = 540, $height = 480)
    {
        $filePath = public_path($fileParth . $fileName);
        $resizedName = $this->getResizedPath($fileName);
        $resizedPath = public_path($fileParth . $resizedName);
        
        try {
            $img = Image::make($filePath);
            $img->resize($with, $height);
            $img->save($resizedPath);
    
            return ['result' => true, 'fileName' => $fileParth . $resizedName];
        } catch(\Exception $ex) {
            return ['result' => $this->handleSaveFileException($ex)];
        }
    }
    
    private function getResizedPath($fileName)
    {
        $name = explode('.', $fileName);
        
        return $name[0] . '_resized.' . $name[1];
    }
}