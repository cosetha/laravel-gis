<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;
use Illuminate\Support\Facades\File;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderBy('created_at','desc')->get();
        return view('admin.kategori.index',['kategori' => $kategori ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $messsages = array(            
            'nama.required'=>'Field Nama Perlu di Isi',
            'gambar.required'=>'Field Gambar Perlu di Isi',
            'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
            'gambar.max'=>'Max ukuran gambar 8mb',           
        );
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:8000',
        ],$messsages
        );
        if ($validator->fails()) {
            $error = $validator->errors();
            return back()->withInput()->withErrors($error);
         }else{
            $directory = 'assets/upload/thumbnail';
            $file = request()->file('gambar');
            $nama = time().$file->getClientOriginalName();
            $file->name = $nama;
            $file->move($directory, $file->name);
            $kategori = new Kategori();
            $kategori->nama = $request->nama;
            $kategori->gambar= $directory."/".$nama;
            $kategori->save();
            return redirect('/dashboard/kategori/create')->with(['success' => ' Berhasil menambahkan Kategori '.$kategori->nama]);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.kategori.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        if($kategori === null){
            abort (404);
        }else{
        return view('admin.kategori.edit',['kategori' => $kategori ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       
        $kategori = Kategori::find($request->id);
        if($request->hasFile('gambar')){
            $messsages = array(            
                'nama.required'=>'Field Nama Perlu di Isi',
                'gambar.required'=>'Field Gambar Perlu di Isi',
                'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                'gambar.max'=>'Max ukuran gambar 8mb',           
            );
            $validator = Validator::make($request->all(),[
                'nama' => 'required',
                'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:8000',
            ],$messsages
            );
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{
                $directory = 'assets/upload/thumbnail';
                $file = request()->file('gambar');
                $nama = time().$file->getClientOriginalName();
                $file->name = $nama;
                $file->move($directory, $file->name);            
                $image_path = url('/').$kategori->gambar;  
                try {
                    File::Delete($kategori->gambar);
                } catch (\Throwable $th) {
                    //throw $th;
                }               
               

                $kategori = Kategori::find($request->id);
                $old = $kategori->nama;
                $kategori->nama = $request->nama;
                $kategori->gambar= $directory."/".$nama;
                $kategori->save();
                return redirect('/dashboard/kategori/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Kategori '.$old.' menjadi '.$kategori->nama]);
             }
        }else{
            $messsages = array(            
                'nama.required'=>'Field Nama Perlu di Isi',           
            );
            $validator = Validator::make($request->all(),[
                'nama' => 'required'],$messsages
            );
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{                   
                $kategori = Kategori::find($request->id);
                $old = $kategori->nama;
                $kategori->nama = $request->nama;               
                $kategori->save();
                return redirect('/dashboard/kategori/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Kategori '.$old.' menjadi '.$kategori->nama]);                
             }
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::find($id);
            File::Delete($kategori->gambar);          
            $kategori->delete();
            return response()->json([
                "message" => "Success"
            ]);
            //code...
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
