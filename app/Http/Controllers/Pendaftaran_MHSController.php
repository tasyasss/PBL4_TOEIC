<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pendaftaran_MHSController extends Controller
{
    
    public function index()
    {      
        $breadcrumb = (object) [
            'title' => ' Pendaftaran',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran'; // Should match your sidebar menu item

        return view('mahasiswa.datapendaftaran.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}