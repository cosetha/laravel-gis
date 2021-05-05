<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use DB;
use Str;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::orderBy('created_at','desc')->get();
        $one = Berita::first();
        return view('admin.berita.index',['berita' => $berita ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->judul,'-');
        $messsages = array(
            'judul.required'=>'Field Judul Perlu di Isi',
            'gambar.required'=>'Field Gambar Perlu di Isi',
            'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
            'deskripsi.required'=>'Field Deskripsi Perlu di Isi',
            'slug.unique'=>'Judul Berita telah di pakai',
        );
        $validator = Validator::make($request->all(),[
            'judul' => 'required',            
            'deskripsi' => 'required|',
            'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'slug' => 'unique:berita',
            ],$messsages);
        if ($validator->fails()) {
            $error = $validator->errors();
            return back()->withInput()->withErrors($error);
         }else{
            
                if($request->hasFile('gambar')){
                    $directory = 'assets/upload/thumbnail';
                    $file = request()->file('gambar');
                    $nama = time().$file->getClientOriginalName();
                    $file->name = $nama;
                    $file->move($directory, $file->name);
                    $berita = new Berita;
                    $berita->judul = $request->judul;
                    $berita->deskripsi = $request->deskripsi;                   
                    $berita->slug = Str::slug($request->judul,'-');
                    $berita->user_id = $request->penulis;
                    if($request->status == "on"){
                        DB::table('berita')->update(array('headline' => 'off'));
                    }                                        
                    $berita->headline = $request->status;
                    $berita->gambar= $directory."/".$nama;
                    $berita->save();
                    return redirect('/dashboard/berita/create')->with(['success' => ' Berhasil menambahkan Berita '.$berita->judul]);
                }
            
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::where('id',$id)->first();       
        
        return view('admin.berita.edit',['berita'=>$berita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $berita = Berita::find($request->id);
        $request['slug'] = Str::slug($request->judul,'-');
        if($request->hasFile('gambar')){

            if($berita->slug != $request['slug'] ){
                $messsages = array(
                    'judul.required'=>'Field Judul Perlu di Isi',
                    'gambar.required'=>'Field Gambar Perlu di Isi',
                    'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                    'deskripsi.required'=>'Field Deskripsi Perlu di Isi',
                    'slug.unique'=>'Judul Berita telah di pakai',
                );
                $validator = Validator::make($request->all(),[
                    'judul' => 'required',            
                    'deskripsi' => 'required|',
                    'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                    'slug' => 'unique:berita',
                    ],$messsages);            
            }else{
                $messsages = array(
                    'judul.required'=>'Field Judul Perlu di Isi',
                    'gambar.required'=>'Field Gambar Perlu di Isi',
                    'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                    'deskripsi.required'=>'Field Deskripsi Perlu di Isi',                    
                );
                $validator = Validator::make($request->all(),[
                    'judul' => 'required',            
                    'deskripsi' => 'required|',
                    'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',                    
                    ],$messsages);            
            }
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{
                File::Delete($berita->gambar);
                $directory = 'assets/upload/thumbnail';
                $file = request()->file('gambar');
                $nama = time().$file->getClientOriginalName();
                $file->name = $nama;
                $file->move($directory, $file->name);               
                $berita->judul = $request->judul;
                $berita->deskripsi = $request->deskripsi;                   
                $berita->slug = Str::slug($request->judul,'-');
                $berita->user_id = $request->penulis;
                if($request->status == "on"){
                    DB::table('berita')->update(array('headline' => 'off'));
                }                                        
                $berita->headline = $request->status;
                $berita->gambar= $directory."/".$nama;
                $berita->save();
                return redirect('/dashboard/berita/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Berita '.$berita->judul]);
             }

        }else{

            if($berita->slug != $request['slug'] ){
                $messsages = array(
                    'judul.required'=>'Field Judul Perlu di Isi',
                    'slug.unique'=>'Judul Berita telah di pakai',
                );
                $validator = Validator::make($request->all(),[
                    'judul' => 'required',            
                    'deskripsi' => 'required|',                    
                    'slug' => 'unique:berita',
                    ],$messsages);            
            }else{
                $messsages = array(
                    'judul.required'=>'Field Judul Perlu di Isi',
                    'deskripsi.required'=>'Field Deskripsi Perlu di Isi',                    
                );
                $validator = Validator::make($request->all(),[
                    'judul' => 'required',            
                    'deskripsi' => 'required|',                    
                    ],$messsages);            
            }
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{       
                $berita->judul = $request->judul;
                $berita->deskripsi = $request->deskripsi;                   
                $berita->slug = Str::slug($request->judul,'-');
                $berita->user_id = $request->penulis;
                if($request->status == "on"){
                    DB::table('berita')->update(array('headline' => 'off'));
                }                                        
                $berita->headline = $request->status;
                $berita->save();
                return redirect('/dashboard/berita/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Berita '.$berita->judul]);
             }

        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::find($id);          
            File::Delete($berita->gambar);
            $berita->delete();
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

    public function FunctionName(Type $var = null)
    {
        DB::table('semester')->update(array('status' => 'nonaktif'));

        $s = Semester::find($id);       

        $s->status = "aktif";
        $s->save();

        return response([
            'message' => 'sukses'
        ]);
    }
}
