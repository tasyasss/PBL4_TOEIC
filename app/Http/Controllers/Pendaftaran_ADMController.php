<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\StatusModel;

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
                $btn =  '<button onclick="modalAction(\'' . url('/admin/pendaftaran/' . $dft->id . '/validasi_ajax') . '\')" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Validasi</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/admin/pendaftaran/'.$dft->id.'/show_ajax').'\')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/pendaftaran/' . $dft->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/pendaftaran/' . $dft->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store_ajax(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'tanggal_pendaftaran' => 'required|date',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'jadwal_id' => 'required|exists:jadwal,id',
            'status_id' => 'required|exists:status,id',
        ]);

        // Membuat data pendaftaran baru
        $pendaftaran = new PendaftaranModel();
        $pendaftaran->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $pendaftaran->mahasiswa_id = $request->mahasiswa_id;
        $pendaftaran->jadwal_id = $request->jadwal_id;
        $pendaftaran->status_id = $request->status_id;
        $pendaftaran->save();

        // Mengembalikan response JSON jika berhasil
        return response()->json([
            'status' => true,
            'message' => 'Pendaftaran berhasil ditambahkan!'
        ]);
    }

    public function show_ajax($id)
    {
        try {
            $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
                              ->findOrFail($id);
            
            return view('admin.datapendaftaran.show_ajax', compact('pendaftaran'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function delete_ajax($id)
    {
        try {
            $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
                              ->findOrFail($id);
            
            return view('admin.datapendaftaran.delete_ajax', compact('pendaftaran'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function destroy_ajax($id)
    {
        try {
            $pendaftaran = PendaftaranModel::findOrFail($id);
            $pendaftaran->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data pendaftaran berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false, 
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}