<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Services\FilesService;
use App\Services\ImagesService;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    private $filesService;
    private $imgServ;
    
    public function __construct(FilesService $filesService, ImagesService $imgServ)
    {
        $this->filesService = $filesService;
        $this->imgServ = $imgServ;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('images.list')->with('images', $this->filesService->getFiles('public', 'users-images2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.uploading');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        if(!$fileName = $this->filesService->saveFile($request, 'public', 'users-images2/')) {
            return redirect()->back()
                ->withErrors(['Something went wrong(storing of image)']);
        }
    
        $resizeResult = $this->imgServ->resizeImage('users-images2/', $fileName);
        if(!$resizedFileName = $resizeResult) {
            return redirect()->back()
                ->withErrors(['Something went wrong(resizing of image)']);
        }
    
        if(!$croppFileName = $this->imgServ->croppImage('users-images2/', $resizedFileName)) {
            return redirect()->back()
                ->withErrors(['Something went wrong(cropping of image)']);
        }
        
        return redirect()->back()
            ->with('msg', 'Good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
