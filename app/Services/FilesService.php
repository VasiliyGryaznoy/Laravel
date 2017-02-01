<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Storage;

class FilesService extends Service
{
   public function getFiles($storage = null, $path = "files")
   {
       $files = Storage::disk($storage)->allFiles($path);
    
       foreach ($files as $key => $file) {
           $path = explode('/', $file);
           $files[$key] = $path[count($path) - 1];
       }
       
       return $files;
   }
    
    public function saveFile(Request $request, $storage = null, $path = "files/", $fileName = null)
    {
        $file = $request->file('file');
        
        if($fileName === null)
            $fileName = $file->getClientOriginalName();
        
        try {
            if(!Storage::disk($storage)->put($path.$fileName, file_get_contents($file->getRealPath())))
                throw new Exception("File didn't save!");
        } catch(\Exception $ex) {
            return $this->handleSaveFileException($ex);
        }
    
        return $fileName;
    }
}
