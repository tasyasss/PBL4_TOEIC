<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran_ADMModel;
use Illuminate\Support\Facades\Validator;

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
            $btn = '<button onclick="modalAction(\'' . url('/admin/jadwal/' . $jdl->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/admin/jadwal/' . $jdl->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';
            return $btn;
        })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        return view('admin.jadwal.create');
    }

    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'kuota' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jadwal = JadwalModel::updateOrCreate(
            ['id' => $request->id],
            [
                'tanggal' => $request->tanggal,
                'kuota' => $request->kuota,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Jadwal berhasil disimpan.',
            'data' => $jadwal,
            'redirect_url' => url('/jadwal')
        ]);
    }

    public function edit_ajax($id)
    {
        $jadwal = JadwalModel::findOrFail($id);
        return view('admin.jadwal.edit', ['jadwal' => $jadwal]);
    }

    public function update_ajax(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'kuota' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $jadwal = JadwalModel::find($id);
        if ($jadwal) {
            $jadwal->update([
                'tanggal' => $request->tanggal,
                'kuota' => $request->kuota,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Jadwal berhasil diperbarui.',
                'redirect_url' => url('/admin/jadwal')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Jadwal tidak ditemukan'
        ], 404);
    }

    public function confirm_ajax($id)
    {
        $jadwal = JadwalModel::find($id);

        if (!$jadwal) {
            abort(404, 'Data jadwal tidak ditemukan.');
        }

        return view('admin.jadwal.confirm', [
            'jadwal' => $jadwal,
            'id' => $id
        ]);
    }

    public function delete_ajax($id)
    {
        $jadwal = JadwalModel::find($id);
        if ($jadwal) {
            $jadwal->delete();
            return response()->json([
                'status' => true,
                'message' => 'Jadwal berhasil dihapus.',
                'redirect_url' => url('/admin/jadwal')
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Jadwal tidak ditemukan'
        ], 404);
    }
}