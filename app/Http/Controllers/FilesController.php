<?php

namespace App\Http\Controllers;

use App\Http\Requests\Files;
use App\Services\FilesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Redirect;
use Storage;

class FilesController extends Controller
{
    private $filesService;
    
    public function __construct(FilesService $filesService)
    {
        $this->filesService = $filesService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('files.list')->with('files', $this->filesService->getFiles());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.uploading');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Files $request)
    {
        if(!$fileName = $this->filesService->saveFile($request)) {
            return redirect()->back()
                ->withErrors(['Something went wrong']);
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
        if(!Storage::exists('files/' . $id)) {
            return redirect()->back()
                ->withErrors(['File not found!']);
        }
    
        return response()
            ->download(storage_path('files/') . $id);
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
