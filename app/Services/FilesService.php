<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Storage;

class FilesService extends Service
{
   public function getFiles($storage = null, $path = "files")
   {
       if($storage === null)
           $files = Storage::allFiles($path);
       else
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
        
        try{
            if($storage === null)
                $saveResult = Storage::put($path.$fileName, file_get_contents($file->getRealPath()));
            else
                $saveResult = Storage::disk($storage)->put($path.$fileName, file_get_contents($file->getRealPath()));
            
            if($saveResult){
                return [
                    'result' => true,
                    'fileName'  =>  $fileName
                ];
            }
        } catch(\Exception $ex) {
            $this->handleSaveFileException($ex);
        }
    
        return [
            'result' => false,
            'msg'  =>  'Something went wrong!'
        ];
    }
}
