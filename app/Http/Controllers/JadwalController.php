<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function jadwal()
    {
        $breadcrumb = (object) [
            'title' => 'Jadwal & Kuota',
            'list' => ['Home', 'Jadwal & Kuota'],
        ];

        $page = (object) [
            'title' => 'Halaman Jadwal & Kuota',
        ];

        $activeMenu = 'jadwal'; // Should match your sidebar menu item

        return view('admin.jadwal', compact('breadcrumb', 'activeMenu', 'page'));
    }
}
