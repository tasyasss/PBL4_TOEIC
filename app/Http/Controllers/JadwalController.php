<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function jadwalKuota()
    {
        // Ganti 'admin.jadwal-kuota' dengan nama view yang sesuai
        return view('admin.jadwal-kuota');
    }
}
