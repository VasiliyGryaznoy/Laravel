<?php

namespace App\Services;

use Storage;
use Image;

class ImagesService extends Service
{
    private $fileServ;
    
    public function __construct(FilesService $filesService)
    {
        $this->fileServ = $filesService;
    }
    
    public function resizeImage($filePath, $fileName, $with = 540, $height = 480)
    {
        $fileFullPath = public_path($filePath . $fileName);
        $resizedName = $this->getResizedName($fileName);
        $resizedPath = $filePath . $resizedName;
        
        try {
            $img = Image::make($fileFullPath);
            $img->resize($with, $height);
            $this->saveImageInStorage($img, $resizedName, $resizedPath);
    
            return ['result' => true, 'fileName' => $resizedName];
        } catch(\Exception $ex) {
            return ['result' => $this->handleSaveFileException($ex)];
        }
    }
    
    public function croppImage($filePath, $fileName)
    {
        $fileFullPath = public_path($filePath . $fileName);
        $croppedName = $this->getCroppedName($fileName);
        $croppedPath = $filePath . $croppedName;
    
        try {
            $img = Image::make($fileFullPath);
            $img->crop(100, 100, 25, 25);
            $this->saveImageInStorage($img, $croppedName, $croppedPath);
    
            return ['result' => true, 'fileName' => $croppedName];
        } catch(\Exception $ex) {
            return ['result' => $this->handleSaveFileException($ex)];
        }
    }
    
    private function saveImageInStorage($img, $resizedName, $storagePath)
    {
        $tempImgPath = 'temp-images/'.$resizedName;
        $fullTempPath = public_path($tempImgPath);
        $img->save($fullTempPath);
        if(!Storage::disk('public')->exists($storagePath))
            Storage::disk('public')->move($tempImgPath, $storagePath);
        else
            Storage::disk('public')->delete($tempImgPath);
    }
    
    public function saveCroppedImage($request, $filePath)
    {
        $file = $request->file('file');
        $newFileName = $this->getCroppedName($file->getClientOriginalName());
        
        return $this->fileServ->saveFile($request, 'public', $filePath, $newFileName);
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