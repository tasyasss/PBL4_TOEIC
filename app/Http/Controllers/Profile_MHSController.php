<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile_MHSController extends Controller
{
    // Menampilkan halaman profile
    public function index()
    {
        return view('mahasiswa.profil');  
    }

    public function profil()
    {
        $breadcrumb = 'Profil Mahasiswa';
    
        return view('mahasiswa.profil', compact('breadcrumb'));
    }

   

}
