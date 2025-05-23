<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat datang',
            'list' => ['Home', 'Welcome'],
        ];

        $page = (object) [
            'title' => 'Selamat datang di aplikasi kami',
        ];

        $activeMenu = 'dashboard';

        return view('welcome', compact('breadcrumb', 'activeMenu', 'page'));
    }
}