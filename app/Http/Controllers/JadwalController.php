<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use App\Models\JadwalModel;
use App\Models\Pendaftaran_ADMModel;

class JadwalController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Jadwal & Kuota',
            'list' => ['Home', 'Jadwal & Kuota'],
        ];

        $page = (object) [
            'title' => 'Halaman Jadwal & Kuota',
        ];

        $activeMenu = 'jadwal'; // Should match your sidebar menu item

        return view('admin.jadwal.index', compact('breadcrumb', 'activeMenu', 'page'));
    }

    public function list(Request $request)
    {
        $jadwal = JadwalModel::select(
            'jadwal.id',
            DB::raw("DATE(jadwal.tanggal) as tanggal_pelaksanaan"),
            DB::raw("TIME(jadwal.tanggal) as jam_pelaksanaan"),
            'jadwal.kuota',
            DB::raw("(
                SELECT COUNT(*) 
                FROM pendaftaran 
                WHERE pendaftaran.jadwal_id = jadwal.id 
                AND pendaftaran.status_id = 2
            ) as kuota_terisi"),
            DB::raw("(
                jadwal.kuota - (
                    SELECT COUNT(*) 
                    FROM pendaftaran 
                    WHERE pendaftaran.jadwal_id = jadwal.id 
                    AND pendaftaran.status_id = 2
                )
            ) as kuota_tersisa")
        );

        return DataTables::of($jadwal)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jdl) {
                $btn = '<button onclick="modalAction(\'' . url('/admin/' . $jdl->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $jdl->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
