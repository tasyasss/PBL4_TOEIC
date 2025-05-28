<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile_ADMController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile Admin',
            'list' => ['Home', 'Profile Admin'],
        ];

        $page = (object) [
            'title' => 'Halaman Profile Admin',
        ];
        $activeMenu = 'profile';

        return view('admin.profile.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function showProfile()
    {
        $user = auth()->user();

        $admin = $user->admin;

        return view('admin.profile', [
            'admin' => $admin
        ]);
    }
}
