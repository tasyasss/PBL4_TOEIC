<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard'],
        ];

        $page = (object) [
            'title' => 'Dashboard',
        ];

        $activeMenu = 'dashboard'; // Should match your sidebar menu item

        return view('admin.dashboard_admin', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function help()
    {
        $breadcrumb = (object) [
            'title' => 'Bantuan',
            'list' => ['Home', 'Bantuan'],
        ];

        $page = (object) [
            'title' => 'Halaman Bantuan',
        ];

        $activeMenu = 'bantuan'; // Should match your sidebar menu item

        return view('admin.help', compact('breadcrumb', 'activeMenu', 'page'));
    }
}