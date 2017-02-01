<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Services\FilesService;
use App\Services\ImagesService;

class ImagesController extends Controller
{
    private $filesService;
    private $imgServ;
    
    public function __construct(FilesService $filesService, ImagesService $imgServ)
    {
        $this->filesService = $filesService;
        $this->imgServ = $imgServ;
    }
    
    public function index()
    {
        return response($this->filesService->getFiles('public', 'users-images'));
    }
    
    public function store(ImageRequest $request)
    {
        $action = $request->input('action');
        $userId = auth()->user()->id;
    
        $filePath = "users-images/$userId/";
        
        switch ($action) {
            case 'resize':
                if(!$fileName = $this->filesService->saveFile($request, 'public', $filePath)) {
                    return response(['Something went wrong(saving)'], 500);
                }
            
                if(!$resizeName = $this->imgServ->resizeImage($filePath, $fileName)) {
                    return response(['Something went wrong(resizing)'], 500);
                }
                
                $resultFileName = $filePath. $resizeName;
                break;
            case 'cropp':
                if(!$fileCropped = $this->imgServ->saveCroppedImage($request, $filePath)) {
                    return response(['Something went wrong(cropp)'], 500);
                }
                
                $resultFileName = $filePath . $fileCropped;
                break;
            default:
                return response(["Action didn't select!"], 500);
        }
    
        return response(['fileName' => $resultFileName]);
    }
}
