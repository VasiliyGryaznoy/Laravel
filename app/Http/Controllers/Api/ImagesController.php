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
        $userId = auth()->user()->id;
        $saveResult = $this->filesService->saveFile($request, 'public', "users-images/$userId/");
        if($saveResult['result']) {
            $filePath = 'users-images/'.auth()->user()->id . '/';
            $resizeResult = $this->imgServ->resizeImage($filePath, $saveResult['fileName']);
            
            if($resizeResult['result'])
            {
                return response([
                    'fileName' => $resizeResult['fileName']
                ]);
            }
        }
            
        return response(['Something went wrong'], 500);
    }
}
