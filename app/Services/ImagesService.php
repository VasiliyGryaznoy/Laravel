<?php

namespace App\Services;

use Storage;
use Image;

class ImagesService extends Service
{
    public function resizeImage($filePath, $fileName, $with = 540, $height = 480)
    {
        $fileFullPath = public_path($filePath . $fileName);
        $resizedName = $this->getResizedName($fileName);
        $resizedPath = public_path($filePath . $resizedName);
        
        try {
            $img = Image::make($fileFullPath);
            $img->resize($with, $height);
            $img->save($resizedPath);
    
            return ['result' => true, 'fileName' => $resizedName];
        } catch(\Exception $ex) {
            return ['result' => $this->handleSaveFileException($ex)];
        }
    }
    
    public function croppImage($filePath, $fileName)
    {
        $fileFullPath = public_path($filePath . $fileName);
        $croppedName = $this->getCroppedName($fileName);
        $croppedPath = public_path($filePath . $croppedName);
    
        try {
            $img = Image::make($fileFullPath);
            $img->crop(100, 100, 25, 25);
            $img->save($croppedPath);
    
            return ['result' => true, 'fileName' => $croppedName];
        } catch(\Exception $ex) {
            return ['result' => $this->handleSaveFileException($ex)];
        }
    }
    
    private function getResizedName($fileName)
    {
        $name = explode('.', $fileName);
        
        return $name[0] . '_resized.' . $name[1];
    }
    
    public function getCroppedName($fileName)
    {
        $name = explode('.', $fileName);
    
        return $name[0] . '_cropped.' . $name[1];
    }
}