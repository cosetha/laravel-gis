<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function store()
    {
        $directory = 'upload/file';
        $file = request()->file('file');
        $old = $file->getClientOriginalName();
        $nama = time().$file->getClientOriginalName();
        $file->name = $nama;
        $file->move($directory, $file->name);
        return response()->json(['location' => URL::asset('/'.$directory."/".$nama),'alt'=>$old]);

    }
    public function storeImg()
    {
        $directory = 'assets/upload/images';
        $file = request()->file('file');
        $old = $file->getClientOriginalName();
        $nama = time().$file->getClientOriginalName();
        $file->name = $nama;
        $file->move($directory, $file->name);
        return response()->json(['location' => URL::asset('/'.$directory."/".$nama),'alt'=>$old]);

    }
}
