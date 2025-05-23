<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolesModel;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;   

class RolesController extends Controller
{
    // 
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar roles',
            'list' => ['Home', 'roles'],
        ];

        $page = (object) [
            'title' => 'Daftar roles yang terdaftar dalam sistem',
        ];

        $activeMenu = 'roles';

        $roles = RolesModel::all(); // ambil semua data roles

        return view('roles.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page, 'roles' => $roles]);
    }
}