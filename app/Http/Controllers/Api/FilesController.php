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
    
    public function store(Files $request)
    {
        if(!$fileName = $this->filesService->saveFile($request)) {
            return response(['Something went wrong'], 500);
        }
    
        return response(['fileName' => $fileName]);
    }
}
