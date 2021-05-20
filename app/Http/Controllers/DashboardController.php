<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Berita;
use App\Models\User;
class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('admin')) {         
            $jumlah = array('kategori'=> Kategori::count(),'lokasi'=> Lokasi::count(),'berita'=> Berita::count(),'user'=> User::count());
            return view('admin.homeAdmin',['jumlah'=>$jumlah]);
        } else {
            return redirect('/');
        } 
    }

    public function DataTotal()
    {
       $labels = array('Lokasi','Berita','Kategori','User');
       $data = array(Lokasi::count(),Berita::count(),Kategori::count(),User::count());
       return response()->json([
        "labels" => $labels,
        "data" => $data,
        ]);
    }
}
