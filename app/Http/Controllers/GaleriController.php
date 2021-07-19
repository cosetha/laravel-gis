<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use Illuminate\Support\Facades\URL;
use Validator;
Use Str;
use Illuminate\Support\Facades\File; 

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri = Galeri::orderBy('created_at','desc')->get();
        return view('admin.galeri.index',['galeri' => $galeri ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Lokasi::orderBy('created_at','desc')->get();      
        return view('admin.galeri.create',['kategori'=>$kategori]);
        
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
            'gambar.required'=>'Field Gambar Perlu di Isi',
            'gambar.max'=>'Ukuran Gambar Max 10mb',
            'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
            'lokasi.required'=>'Field Nama Lokasi Perlu di Isi', 
            'deskripsi.required'=>'Field Deskripsi Perlu di Isi',        
        );
        $validator = Validator::make($request->all(),[
            'lokasi' => 'required',
            'deskripsi'=> 'required',
            'gambar'=>'required|max:10000|mimes:jpeg,jpg,png,gif',
            ''],$messsages
        );
        if ($validator->fails()) {
            $error = $validator->errors();
            return back()->withInput()->withErrors($error);
         }else{
            $directory = 'upload/gambar';
            $file = request()->file('gambar');
            $nama = time().$file->getClientOriginalName();
            $file->name = $nama;
            $file->move($directory, $file->name);
            $galeri = new Galeri();
            $galeri->deskripsi = $request->deskripsi;
            $galeri->gambar= $directory."/".$nama;
            $galeri->save();
            $galeri->locations()->attach(Lokasi::where('id', $request->lokasi)->first());
            return redirect('/dashboard/galeri/create')->with(['success' => ' Berhasil menambahkan Galeri ']);
         }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galeri = Galeri::where('id',$id)->first();
        $kategori = Lokasi::orderBy('created_at','desc')->get();
        if($kategori === null){
            abort (404);
        }else{
        // print_r($lokasi);
        return view('admin.galeri.edit',['galeri'=>$galeri,'kategori'=>$kategori]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->hasFile('gambar')){

            $messsages = array(            
                'gambar.required'=>'Field Gambar Perlu di Isi',
                'gambar.max'=>'Ukuran Gambar Max 10mb',
                'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                'lokasi.required'=>'Field Nama Lokasi Perlu di Isi', 
                'deskripsi.required'=>'Field Deskripsi Perlu di Isi',        
            );
            $validator = Validator::make($request->all(),[
                'lokasi' => 'required',
                'deskripsi'=> 'required',
                'gambar'=>'required|max:10000|mimes:jpeg,jpg,png,gif',
                ''],$messsages
            );
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{
                $directory = 'upload/gambar';
                $file = request()->file('gambar');
                $nama = time().$file->getClientOriginalName();
                $file->name = $nama;
                $file->move($directory, $file->name);
                $galeri = Galeri::find($request->id);
                File::Delete($galeri->gambar);
                $galeri->locations()->detach(Lokasi::where('id', $galeri->lokasi)->first());       
                $galeri->deskripsi = $request->deskripsi; 
                $galeri->locations()->detach(Lokasi::where('id', $galeri->lokasi)->first()); 
                $galeri->deskripsi = $request->deskripsi;
                $galeri->gambar= $directory."/".$nama;
                $galeri->save();
                $galeri->locations()->attach(Lokasi::where('id', $request->lokasi)->first());
                return redirect('/dashboard/galeri/create')->with(['success' => ' Berhasil Mengedit Galeri ']);
             }

        }else{
            $messsages = array(            
                'gambar.required'=>'Field Gambar Perlu di Isi',
                'gambar.max'=>'Ukuran Gambar Max 10mb',
                'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                'lokasi.required'=>'Field Nama Lokasi Perlu di Isi', 
                'deskripsi.required'=>'Field Deskripsi Perlu di Isi',        
            );
            $validator = Validator::make($request->all(),[
                'lokasi' => 'required',
                'deskripsi'=> 'required',],$messsages
            );
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{              
                $galeri = Galeri::find($request->id);   
                $galeri->locations()->detach(Lokasi::where('id', $galeri->lokasi)->first());       
                $galeri->deskripsi = $request->deskripsi; 
                $galeri->locations()->detach(Lokasi::where('id', $galeri->lokasi)->first());                    
                $galeri->save();
                $galeri->locations()->attach(Lokasi::where('id', $request->lokasi)->first());
                return redirect('/dashboard/galeri/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Galeri ']);
             }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $galeri = Galeri::find($id);          
            File::Delete($galeri->gambar);
            $galeri->delete();
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
