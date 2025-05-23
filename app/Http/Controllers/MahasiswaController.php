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
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar mahasiswa',
            'list' => ['Home', 'mahasiswa'],
        ];

        $page = (object) [
            'title' => 'Daftar mahasiswa yang terdaftar dalam sistem',
        ];

        $activeMenu = 'mahasiswa';

        return view('mahasiswa.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu, 'page' => $page]);
    }

    public function list()
    {
        $mahasiswa = MahasiswaModel::select('user_id', 'mahasiswa_nim', 'mahasiswa_nama', 'alamat', 'no_telp', 'email', 'file_ktm', 'file_ktp', 'file_pas_foto', 'prodi_id')
            ->with('user')
            ->with('prodi')
            ->get();

        return DataTables::of($mahasiswa)
            ->addIndexColumn() // Menambahkan kolom index
            ->addColumn('action', function ($row) { // Menambahkan kolom aksi
                // Tombol edit dan delete
                $btn .= '<a href="' . url('/mahasiswa/' . $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                $btn = '<a href="' . url('/mahasiswa/' . $row->id) . '" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
                
            })
            ->make(true);
    }
}