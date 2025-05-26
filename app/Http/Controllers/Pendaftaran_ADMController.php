<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\PendaftaranModel;

class Pendaftaran_ADMController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pendaftaran',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Halaman Pendaftaran',
        ];
        $activeMenu = 'pendaftaran';

        return view('admin.datapendaftaran.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        $pendaftaran = PendaftaranModel::select(
            'id',
            'tanggal_pendaftaran',
            'mahasiswa_id',
            'jadwal_id',
            'status_id'
        )->with('mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status');

        // filter data berdasarkan jadwal_id
        if ($request->jadwal_id) {
            $pendaftaran->where('jadwal_id', $request->jadwal_id);
        }

        // filter data berdasarkan status_id
        if ($request->status_id) {
            $pendaftaran->where('status_id', $request->status_id);
        }

        return DataTables::of($pendaftaran)
            // menambahkan kolom index
            ->addIndexColumn()
            ->addColumn('aksi', function ($dft) {
                $btn =  '<button onclick="modalAction(\'' . url('/admin/' . $dft->id . '/validasi_ajax') . '\')" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i>   Validasi</button> ';
                $btn .=  '<button onclick="modalAction(\'' . url('/admin/' . $dft->id . '/show_ajax') . '\')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i>   Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $dft->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $dft->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
            return view('admin.datapendaftaran.index', compact('breadcrumb', 'activeMenu', 'page'));
    }
}
