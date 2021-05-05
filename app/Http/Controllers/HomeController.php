<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\Berita;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->hasRole('user')) {
            return redirect('user/home');
        }

        if ($request->user()->hasRole('admin')){
            return redirect('dashboard/home');
        }
        
    }
    public function home()
    {
        $lokasi = Lokasi::inRandomOrder()->limit(2)->get();
        $berita = Berita::where('headline','on')->orderBy('id','desc')->first();

        return view('home',['lokasi' => $lokasi,'berita' => $berita ]);
    }
}
