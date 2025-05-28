<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile_MHSController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile Mahasiswa',
            'list' => ['Home', 'Profile Mahasiswa'],
        ];

        $page = (object) [
            'title' => 'Halaman Profile Mahasiswa',
        ];
        $activeMenu = 'profile';

        return view('Mahasiswa.profile.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function showProfile()
    {
        $user = auth()->user();

        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.profile', [
            'mahasiswa' => $mahasiswa
        ]);
    }
}
