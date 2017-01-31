<?php

namespace App\Http\Controllers;

use App\Http\Requests\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Redirect;
use Storage;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::allFiles(storage_path('files'));
    
        foreach ($files as $key => $file) {
            $path = explode('/', $file);
            $files[$key] = $path[count($path) - 1];
        }
        
        return view('files.list')->with('files', $files);
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
        $file = $request->file('file');
        if(Storage::put('files/'.$file->getClientOriginalName(), file_get_contents($file->getRealPath()))) {
            return redirect()->back()
                ->with('msg', 'Good!');
        } else {
            return redirect()->back()
                ->withErrors(['Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(File::exists(storage_path('files/') . $id)) {
            return response()
                ->download(storage_path('files/') . $id);
        } else {
            return redirect()->back()
                ->withErrors(['File not found!']);
        }

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
