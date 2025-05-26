<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\MahasiswaModel;

class DataMahasiswaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Mahasiswa',
            'list' => ['Home', 'Data Mahasiswa'],
        ];

        $page = (object) [
            'title' => 'Halaman Data Mahasiswa',
        ];

        $activeMenu = 'mahasiswa'; // Should match your sidebar menu item

        return view('admin.datamahasiswa.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        $mahasiswa = MahasiswaModel::select(
            'id', 
            'mahasiswa_nim', 
            'mahasiswa_nama', 
            'alamat', 
            'no_telp', 
            'email', 
            'file_ktm', 
            'file_ktp', 
            'file_pas_foto', 
            'prodi_id'
        )->with('prodi');

        // filter data berdasarkan prodi_id
        if ($request->prodi_id) {
            $mahasiswa->where('prodi_id', $request->prodi_id);
        }

        return DataTables::of($mahasiswa)
            // menambahkan kolom index
            ->addIndexColumn()
            ->addColumn('aksi', function ($mhs) {
                $btn =  '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/show_ajax') . '\')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i>   Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
