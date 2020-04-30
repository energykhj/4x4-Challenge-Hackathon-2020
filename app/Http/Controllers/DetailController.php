<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('detail');
    }

    // public function index($postnumber)
    // {
    //     dd($postnumber);
    //     return view('detail');
    // }
}
