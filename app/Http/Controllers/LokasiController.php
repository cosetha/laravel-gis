<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;
Use Str;
use Illuminate\Support\Facades\File; 

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = Lokasi::orderBy('created_at','desc')->get();
        return view('admin.lokasi.index',['lokasi' => $lokasi ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request->nama,'-');
        $messsages = array(
            'keterangan.required'=>'Field Keterangan Perlu di Isi',
            'long.required'=>'Field Longitude Perlu di Isi',
            'lat.required'=>'Field Latitude Perlu di Isi',
            'lokasi.required'=>'Field Lokasi Perlu di Isi',
            'gambar.required'=>'Field Gambar Perlu di Isi',
            'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
            'nama.required'=>'Field Nama Perlu di Isi',
            'slug.unique'=>'Nama Lokasi telah di pakai'
        );
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'lokasi' => 'required|',
            'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'slug' => 'unique:lokasi',
            "keterangan" => 'required|string'],$messsages);
        if ($validator->fails()) {
            $error = $validator->errors();
            return back()->withInput()->withErrors($error);
         }else{
             try {
                if($request->hasFile('gambar')){
                    $directory = 'assets/upload/thumbnail';
                    $file = request()->file('gambar');
                    $nama = time().$file->getClientOriginalName();
                    $file->name = $nama;
                    $file->move($directory, $file->name);
                    $lokasi = new Lokasi;
                    $lokasi->nama = $request->nama;
                    $lokasi->long = $request->long;
                    $lokasi->lat = $request->lat;
                    $lokasi->keterangan = $request->keterangan;
                    $lokasi->slug = Str::slug($request->nama,'-');
                    $lokasi->lokasi = $request->lokasi;
                    $lokasi->gambar= $directory."/".$nama;
                    $lokasi->save();
                    return redirect('/dashboard/lokasi/create')->with(['success' => ' Berhasil menambahkan Lokasi '.$lokasi->nama]);
                }
             } catch (\Exception $e) {

             }
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        return view('admin.lokasi.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasi = Lokasi::where('id',$id)->first();
        
        // print_r($lokasi);
        return view('admin.lokasi.edit',['lokasi'=>$lokasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $lokasi = Lokasi::find($request->id);
        $request['slug'] = Str::slug($request->nama,'-');

        if($request->hasFile('gambar')){
            if($lokasi->slug != $request['slug'] ){
                $messsages = array(
                    'keterangan.required'=>'Field Keterangan Perlu di Isi',
                    'long.required'=>'Field Longitude Perlu di Isi',
                    'lat.required'=>'Field Latitude Perlu di Isi',
                    'lokasi.required'=>'Field Lokasi Perlu di Isi',
                    'gambar.required'=>'Field Gambar Perlu di Isi',
                    'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                    'nama.required'=>'Field Nama Perlu di Isi',
                    'slug.unique'=>'Nama Lokasi telah di pakai'
                );
                $validator = Validator::make($request->all(),[
                    'nama' => 'required',
                    'long' => 'required',
                    'lat' => 'required',
                    'lokasi' => 'required|',
                    'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                    'slug' => 'unique:lokasi',
                    "keterangan" => 'required|string'],$messsages);
                }else{
                    $messsages = array(
                        'keterangan.required'=>'Field Keterangan Perlu di Isi',
                        'long.required'=>'Field Longitude Perlu di Isi',
                        'lat.required'=>'Field Latitude Perlu di Isi',
                        'lokasi.required'=>'Field Lokasi Perlu di Isi',
                        'gambar.required'=>'Field Gambar Perlu di Isi',
                        'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                        'nama.required'=>'Field Nama Perlu di Isi',
                    );
                    $validator = Validator::make($request->all(),[
                        'nama' => 'required',
                        'long' => 'required',
                        'lat' => 'required',
                        'lokasi' => 'required|',
                        'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',                        
                        "keterangan" => 'required|string'],$messsages);
                }
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{
               
                    $directory = 'assets/upload/thumbnail';
                    $file = request()->file('gambar');
                    $nama = time().$file->getClientOriginalName();
                    $file->name = $nama;
                    $file->move($directory, $file->name);
                    
                    $image_path = url('/').$lokasi->gambar;                 
                    File::Delete($lokasi->gambar);
                    $lokasi->nama = $request->nama;
                    $lokasi->long = $request->long;
                    $lokasi->lat = $request->lat;
                    $lokasi->keterangan = $request->keterangan;
                    $lokasi->slug = Str::slug($request->nama,'-');
                    $lokasi->lokasi = $request->lokasi;
                    $lokasi->gambar= $directory."/".$nama;
                    $lokasi->save();                    
                    return redirect('/dashboard/lokasi/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Lokasi '.$lokasi->nama]);
             }
        }else{

            if($lokasi->slug != $request['slug'] ){

                $messsages = array(
                    'keterangan.required'=>'Field Keterangan Perlu di Isi',
                    'long.required'=>'Field Longitude Perlu di Isi',
                    'lat.required'=>'Field Latitude Perlu di Isi',
                    'lokasi.required'=>'Field Lokasi Perlu di Isi',
                    'gambar.required'=>'Field Gambar Perlu di Isi',
                    'gambar.mimes'=>'Field Gambar Perlu di Isi dengan Format: jpeg,jpg,png',
                    'nama.required'=>'Field Nama Perlu di Isi',
                    'slug.unique'=>'Nama Lokasi telah di pakai'
                );
                $validator = Validator::make($request->all(),[
                    'nama' => 'required',
                    'long' => 'required',
                    'lat' => 'required',
                    'lokasi' => 'required|',
                    'gambar' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                    'slug' => 'unique:lokasi',
                    "keterangan" => 'required|string'],$messsages);
                }else{
                    $messsages = array(
                        'keterangan.required'=>'Field Keterangan Perlu di Isi',
                        'long.required'=>'Field Longitude Perlu di Isi',
                        'lat.required'=>'Field Latitude Perlu di Isi',
                        'lokasi.required'=>'Field Lokasi Perlu di Isi',                    
                        'nama.required'=>'Field Nama Perlu di Isi',
                    );
                    $validator = Validator::make($request->all(),[
                        'nama' => 'required',
                        'long' => 'required',
                        'lat' => 'required',
                        'lokasi' => 'required|',                                             
                        "keterangan" => 'required|string'],$messsages);
                }
            if ($validator->fails()) {
                $error = $validator->errors();
                return back()->withInput()->withErrors($error);
             }else{
                    $lokasi->nama = $request->nama;
                    $lokasi->long = $request->long;
                    $lokasi->lat = $request->lat;
                    $lokasi->keterangan = $request->keterangan;
                    $lokasi->slug = Str::slug($request->nama,'-');
                    $lokasi->lokasi = $request->lokasi;                    
                    $lokasi->save();                                    
                    return redirect('/dashboard/lokasi/edit/'.$request->id)->with(['success' => ' Berhasil Mengedit Lokasi '.$lokasi->nama]);
             }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $lokasi = Lokasi::find($id);          
            File::Delete($lokasi->gambar);
            $lokasi->delete();
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

    public function LoadTableLokasi(){
        return view('datatable.tableLokasi');
    }

    public function LoadDataLokasi(){
        $data = Lokasi::orderBy('id','desc')->get();

            return Datatables::of($data)->addIndexColumn()
            ->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->judul.'" class="btn-edit-lokasi" style="font-size: 18pt; text-decoration: none;" class="mr-3">
                <i class="fas fa-pen-square"></i>
                </a>';
                $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->judul.'" class="btn-delete-lokasi" style="font-size: 18pt; text-decoration: none; color:red;">
                <i class="fas fa-trash"></i>
                </a>';
                $btn = $btn. '<a href="javascript:void(0)" data-id="'.$row->id.'" data-nama="'.$row->judul.'" class="btn-show-lokasi" style="font-size: 18pt; text-decoration: none; color:green;">
                <i class="fas fa-eye"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
}
