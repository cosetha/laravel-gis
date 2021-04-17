<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            return view('admin.homeAdmin');
        } else {
            return redirect('/');
        } 
    }
}
