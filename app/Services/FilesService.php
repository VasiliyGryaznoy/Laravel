<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Storage;

class FilesService extends Service
{
   public function getFiles()
   {
       $files = File::allFiles(storage_path('files'));
    
       foreach ($files as $key => $file) {
           $path = explode('/', $file);
           $files[$key] = $path[count($path) - 1];
       }
       
       return $files;
   }
    
    public function saveFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        try{
            Storage::put('files/'.$fileName, file_get_contents($file->getRealPath()));
        } catch(\Exception $ex) {
            return $this->handleSaveFileException($ex);
        }
        
        return [
            'result' => true,
            'fileName'  =>  $fileName
        ];
    }
}
