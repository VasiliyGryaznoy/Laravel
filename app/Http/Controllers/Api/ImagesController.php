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
                $saveResult = $this->filesService->saveFile($request, 'public', $filePath);
                if(!$saveResult['result']) {
                    return response(['Something went wrong(saving)'], 500);
                }
                
                $resizeResult = $this->imgServ->resizeImage($filePath, $saveResult['fileName']);
            
                if(!$resizeResult['result'])
                    return response(['Something went wrong(resizing)'], 500);
                else {
                    $resultFileName = $filePath. $resizeResult['fileName'];
                    break;
                }
            case 'cropp':
                $resultSaveCropped = $this->imgServ->saveCroppedImage($request, $filePath);
                
                if(!$resultSaveCropped['result'])
                    return response(['Something went wrong(cropp)'], 500);
                else {
                    $resultFileName = $filePath . $resultSaveCropped['fileName'];
                    break;
                }
            default:
                return response(["Action didn't select!"], 500);
        }
    
        return response([
            'fileName' => $resultFileName
        ]);
    }
}
