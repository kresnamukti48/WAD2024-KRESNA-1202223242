<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();

        $widget = [
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
            //...
        ];

        return view('home', compact('widget'));
    }
}
