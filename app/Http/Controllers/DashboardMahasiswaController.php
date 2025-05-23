<?php

namespace App\Http\Controllers;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Selamat Datang']
        ];

        $activeMenu = 'dashboard';

        return view('mahasiswa.dashboard_mahasiswa', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
