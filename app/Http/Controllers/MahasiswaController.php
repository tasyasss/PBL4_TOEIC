<?php

namespace App\Http\Controllers;
use App\Models\MahasiswaModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function dashboard()
    {
        return view('mahasiswa.dashboard_mahasiswa');
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

        return view('mahasiswa.help', compact('breadcrumb', 'activeMenu', 'page'));
    }
}