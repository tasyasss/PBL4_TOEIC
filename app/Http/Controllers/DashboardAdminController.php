<?php

namespace App\Http\Controllers;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Selamat Datang']
        ];

        $activeMenu = 'dashboard';

        return view('admin.dashboard_admin', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
