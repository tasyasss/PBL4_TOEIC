<?php

namespace App\Http\Controllers;
use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard_admin');
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

    // public function dashboard()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Dashboard',
    //         'list' => ['Home', 'Dashboard'],
    //     ];

    //     $page = (object) [
    //         'title' => 'Dashboard',
    //     ];

    //     $activeMenu = 'dashboard';

    //     return view('admin.dashboard', compact('breadcrumb', 'activeMenu', 'page'));
    // }

    // public function list()
    // {
    //     $admins = AdminModel::select('user_id', 'admin_nama', 'alamat', 'no_telp', 'email', 'file_ktm', 'file_ktp', 'file_pas_foto')
    //         ->with('user')
    //         ->get();
    //     return DataTables::of($admins)
    //         ->addIndexColumn() // Menambahkan kolom index
    //         ->addColumn('action', function ($admin) { // Menambahkan kolom aksi
    //             // Tombol edit dan delete
    //             $btn .= '<a href="' . url('/admin/' . $admin->id) . '" class="btn btn-primary btn-sm">Edit</a>';
    //             $btn .= '<form class="d-inline"  method="POST"  action="' . url('/admin/' . $admin->id) . '">'
    //                 . csrf_field() . method_field('DELETE') . 
    //                 '<button type="submit" class="btn btn-danger btn-sm"
    //                 onclick="return confirm(\'Apakah anda yakin ingin menghapus data 
    //                 ini?\')">Delete</button>';
    //             return $btn;
    //         })
    //         ->rawColumns(['action']) // Menandai kolom aksi
    //         ->make(true);
    // }
}