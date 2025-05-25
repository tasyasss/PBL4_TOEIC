<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    
    public function Pendaftaran()
    {      
        $breadcrumb = (object) [
            'title' => ' Pendaftaran',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran'; // Should match your sidebar menu item

        return view('mahasiswa.pendaftaran', compact('breadcrumb', 'page', 'activeMenu'));
    }
}