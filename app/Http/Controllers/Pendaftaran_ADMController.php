<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\PendaftaranModel;
use App\Models\JadwalModel;
use App\Models\JurusanModel;
use App\Models\KampusModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;
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
                $btn =  '<a href="' . url('/admin/pendaftaran/validasi/' . $dft->id) . '" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Validasi </a> ';
                // $btn =  '<button onclick="modalAction(\'' . url('/admin/pendaftaran/validasi_ajax/' . $dft->id) . '\')" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i> Validasi</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/pendaftaran/show_ajax/' . $dft->id) . '\')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/pendaftaran/edit_ajax/' . $dft->id) . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="showDeleteModal(' . $dft->id . ')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>';
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
        $mahasiswa = MahasiswaModel::all();
        $jadwal = JadwalModel::all();
        $status = StatusModel::all();
        $pendaftaran = PendaftaranModel::with([
            'mahasiswa.prodi',
            'mahasiswa.jurusan',
            'mahasiswa.kampus',
            'status',
            'jadwal'
        ])->findOrFail($id);

        return view('admin.datapendaftaran.show_ajax', compact('pendaftaran', 'mahasiswa', 'jadwal', 'status'));
    }

    public function edit_ajax($id)
    {
        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'jadwal'])
            ->where('id', $id)
            ->firstOrFail();

        $prodi = ProdiModel::all();
        $jurusan = JurusanModel::all();
        $kampus = KampusModel::all();
        $status = StatusModel::all();

        return view('admin.datapendaftaran.edit_ajax', compact(
            'pendaftaran',
            'prodi',
            'jurusan',
            'kampus',
            'status'
        ));
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'mahasiswa_nim' => 'required|min:3|max:10',
            'mahasiswa_nama' => 'required|max:100',
            'alamat' => 'required|max:225',
            'no_telp' => 'required|max:15',
            'nik' => 'required|max:15',
            'emai' => 'required|email|max:100',
            'prodi_id' => 'required|numeric',
            'jurusan_id' => 'required|numeric',
            'kampus_id' => 'required|numeric',

            'tanggal' => 'required|date',
            'tanggal_pendaftaran' => 'required|date',
            'status_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $pendaftaran = PendaftaranModel::with('mahasiswa', 'jadwal')->findOrFail($id);

            // Update Mahasiswa
            $pendaftaran->mahasiswa->update([
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'mahasiswa_nama' => $request->mahasiswa_nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'nik' => $request->nik,
                'emai' => $request->emai,
                'prodi_id' => $request->prodi_id,
                'jurusan_id' => $request->jurusan_id,
                'kampus_id' => $request->kampus_id,
            ]);

            // Update Jadwal
            $pendaftaran->jadwal->update([
                'tanggal' => $request->tanggal,
            ]);

            // Update Pendaftaran
            $pendaftaran->update([
                'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
                'status_id' => $request->status_id,
            ]);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data.']);
        }
    }

    public function delete_ajax($id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        return view('admin.datapendaftaran.delete_ajax', compact('pendaftaran'));
    }


    public function destroy($id)
    {
        try {
            $data = PendaftaranModel::findOrFail($id);
            $data->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    // public function validasi(string $id)
    // {
    //     $mahasiswa = MahasiswaModel::all();
    //     $jadwal = JadwalModel::all();
    //     $status = StatusModel::all();
    //     $pendaftaran = PendaftaranModel::with([
    //         'mahasiswa.prodi',
    //         'mahasiswa.jurusan',
    //         'mahasiswa.kampus',
    //         'status',
    //         'jadwal'
    //     ])->findOrFail($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Edit Barang',
    //         'list'  => ['Home', 'Barang', 'Edit']
    //     ];

    //     $page = (object) [
    //         'title' => 'Edit barang'
    //     ];

    //     $activeMenu = 'barang'; // set menu yang sedang aktif

    //     return view('admin.datapendaftaran.validasi', compact('breadcrumb', 'activeMenu', 'page'));
    // }

    public function validasi($id)
    {
        $pendaftaran = PendaftaranModel::with(['mahasiswa.prodi', 'mahasiswa.jurusan', 'mahasiswa.kampus', 'jadwal', 'status'])->find($id);

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan!');
        }


        $breadcrumb = (object) [
            'title' => 'Validasi Pendaftaran',
            'list'  => ['Home', 'Validasi Pendaftaran', 'Validasi']
        ];

        $page = (object) [
            'title' => 'Validasi Pendaftaran'
        ];

        $activeMenu = 'validasi';

        return view('admin.datapendaftaran.validasi', compact('pendaftaran', 'breadcrumb', 'activeMenu', 'page'));
    }

    public function validasi_proses(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|in:2,3', // 2 = diterima, 3 = ditolak
        ]);

        $pendaftaran = PendaftaranModel::findOrFail($id);
        $pendaftaran->status_id = $request->status_id;
        $pendaftaran->save();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
