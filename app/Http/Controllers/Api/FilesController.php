<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FilesService;
use App\Http\Requests\Files;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    private $filesService;
    
    public function __construct(FilesService $filesService)
    {
        $this->filesService = $filesService;
    }
    
    public function index()
    {
        return response($this->filesService->getFiles());
    }
    
    public function store(Request $request)
    {
        $saveResult = $this->filesService->saveFile($request);
        if($saveResult['result']) {
            return response(['fileName' => $saveResult['fileName']]);
        } else {
            return response(['Something went wrong'], 500);
        }
    }
    
    public function show($id)
    {
        if(File::exists(storage_path('files/') . $id)) {
            return response()
                ->download(storage_path('files/') . $id);
        } else {
            return response([false]);
        }
        
    }
}
