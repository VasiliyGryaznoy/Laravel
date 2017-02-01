<?php

namespace App\Services;

use League\Flysystem\Exception;
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
            
            if(!Storage::disk('public')->put($resizedPath, $img->stream()->__toString()))
                throw new \Exception('Something went wrong!');
        } catch(\Exception $ex) {
            return $this->handleSaveFileException($ex);
        }
    
        return $resizedName;
    }
    
    public function croppImage($filePath, $fileName)
    {
        $fileFullPath = public_path($filePath . $fileName);
        $croppedName = $this->getCroppedName($fileName);
        $croppedPath = $filePath . $croppedName;
    
        try {
            $img = Image::make($fileFullPath);
            $img->crop(100, 100, 25, 25);
            
            if(!Storage::disk('public')->put($croppedPath, $img->stream()->__toString()))
                throw new \Exception('Something went wrong!');
        } catch(\Exception $ex) {
            return $this->handleSaveFileException($ex);
        }
    
        return $croppedName;
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