<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\PendaftaranModel;
use Illuminate\Support\Facades\Auth;
use App\Models\MahasiswaModel;
use App\Models\JadwalModel;
use App\Models\StatusModel;

class Pendaftaran_MHSController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pendaftaran',
            'list' => ['Home', 'Pendaftaran'],
        ];

        $page = (object) [
            'title' => 'Pendaftaran',
        ];

        $activeMenu = 'pendaftaran';

        return view('mahasiswa.datapendaftaran.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // public function list(Request $request)
    // {
    //     $mahasiswa_id = Auth::user()->mahasiswa->id;

    //     $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
    //         ->where('mahasiswa_id', $mahasiswa_id);

    //     if ($request->jadwal_id) {
    //         $pendaftaran->where('jadwal_id', $request->jadwal_id);
    //     }
    //     if ($request->status_id) {
    //         $pendaftaran->where('status_id', $request->status_id);
    //     }

    //     return DataTables::of($pendaftaran)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($dft) {
    //             $btn = '<button class="btn btn-outline-info btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.show_ajax', $dft->id) . '\')"><i class="fas fa-info"></i> Detail</button> ';
    //             $btn .= '<button class="btn btn-outline-warning btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.edit_ajax', $dft->id) . '\')"><i class="fas fa-edit"></i> Edit</button> ';
    //             $btn .= '<button class="btn btn-outline-danger btn-sm" onclick="deleteConfirm(\'' . route('mahasiswa.pendaftaran.delete_ajax', $dft->id) . '\')"><i class="fas fa-trash"></i> Hapus</button> ';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    public function list(Request $request)
    {
        $mahasiswa_id = Auth::user()->mahasiswa->id;

        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
            ->where('mahasiswa_id', $mahasiswa_id);

        if ($request->jadwal_id) {
            $pendaftaran->where('jadwal_id', $request->jadwal_id);
        }
        if ($request->status_id) {
            $pendaftaran->where('status_id', $request->status_id);
        }

        return DataTables::of($pendaftaran)
            ->addIndexColumn()
            ->addColumn('aksi', function ($dft) {
                $btn = '<button class="btn btn-outline-info btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.show_ajax', $dft->id) . '\')"><i class="fas fa-info"></i> Detail</button> ';

                // Edit button based on status
                if (in_array($dft->status_id, [1, 3, 4])) {
                    $btn .= '<button class="btn btn-outline-warning btn-sm" onclick="modalAction(\'' . route('mahasiswa.pendaftaran.edit_ajax', $dft->id) . '\')"><i class="fas fa-edit"></i> Edit</button> ';
                } else {
                    $btn .= '<button class="btn btn-outline-dark btn-sm" disabled title="Tidak bisa edit dengan status ini"><i class="fas fa-edit"></i> Edit</button> ';
                }

                // Delete button based on status
                if (in_array($dft->status_id, [1, 4])) {
                    $btn .= '<button class="btn btn-outline-danger btn-sm" onclick="deleteConfirm(\'' . route('mahasiswa.pendaftaran.delete_ajax', $dft->id) . '\')"><i class="fas fa-trash"></i> Hapus</button> ';
                } else {
                    $btn .= '<button class="btn btn-outline-dark btn-sm" disabled title="Tidak bisa hapus dengan status ini"><i class="fas fa-trash"></i> Hapus</button> ';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function show_ajax($id)
    {
        $pendaftaran = PendaftaranModel::with(['mahasiswa', 'mahasiswa.prodi', 'jadwal', 'status'])
            ->findOrFail($id);

        if ($pendaftaran->mahasiswa_id != Auth::user()->mahasiswa->id) {
            abort(403, 'Unauthorized');
        }

        return view('mahasiswa.datapendaftaran.show_ajax', compact('pendaftaran'));
    }

    // public function delete_ajax($id)
    // {
    //     $pendaftaran = PendaftaranModel::findOrFail($id);

    //     if ($pendaftaran->mahasiswa_id != Auth::user()->mahasiswa->id) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     $pendaftaran->delete();

    //     return response()->json(['success' => 'Data berhasil dihapus']);
    // }

    // public function create_ajax()
    // {
    //     $mahasiswa = MahasiswaModel::select('*')->get();
    //     $jadwal = JadwalModel::select('*')->get();
    //     $status = StatusModel::select('*')->get();
    //     return view('mahasiswa.datapendaftaran.create_ajax')
    //         ->with('mahasiswa', $mahasiswa)
    //         ->with('jadwal', $jadwal)
    //         ->with('status', $status);
    // }

    public function create_ajax()
    {
        $mahasiswa = Auth::user()->mahasiswa; // Ambil data mahasiswa yang login
        $jadwal = JadwalModel::where('tanggal', '>=', now())->orderBy('tanggal')->get();
        $status = StatusModel::all();

        return view('mahasiswa.datapendaftaran.create_ajax', [
            'mahasiswa' => $mahasiswa,
            'jadwal' => $jadwal,
            'status' => $status,
        ]);
    }

    public function store_ajax(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Validasi dokumen lengkap
        if (!$mahasiswa->file_ktm || !$mahasiswa->file_ktp || !$mahasiswa->file_pas_foto) {
            return response()->json([
                'message' => 'Harap lengkapi semua dokumen (KTM, KTP, Pas Foto) sebelum mendaftar'
            ], 422);
        }

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        // Cek apakah mahasiswa sudah pernah diterima sebelumnya
        $hasAcceptedRegistration = PendaftaranModel::where('mahasiswa_id', $mahasiswa->id)
            ->where('status_id', 2) // Status Diterima
            ->exists();

        // Set status_id berdasarkan kondisi
        $status_id = $hasAcceptedRegistration ? 4 : 1; // 4 = Menunggu (jika sudah pernah diterima), 1 = Baru (jika belum)

        // Buat data pendaftaran
        $pendaftaran = PendaftaranModel::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'jadwal_id' => $request->jadwal_id,
            'status_id' => $status_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil disimpan',
            'data' => $pendaftaran
        ]);
    }

    // public function store_ajax(Request $request)
    // {
    //     $mahasiswa = Auth::user()->mahasiswa;

    //     if (!$mahasiswa->file_ktm || !$mahasiswa->file_ktp || !$mahasiswa->file_pas_foto) {
    //         return back()->withErrors([
    //             'message' => 'Harap lengkapi semua dokumen (KTM, KTP, Pas Foto) sebelum mendaftar'
    //         ]);
    //     }

    //     $request->validate([
    //         'mahasiswa_id' => 'required|exists:mahasiswa,id',
    //         'jadwal_id' => 'required|exists:jadwal,id',
    //         'status_id' => 'required|exists:status,id',
    //         'tanggal_pendaftaran' => 'required|date',
    //     ]);

    //     PendaftaranModel::create($request->all());

    //     return response()->json(['message' => 'Pendaftaran berhasil disimpan']);
    // }

    // // ------------------- INI BISA --------------------
    // public function edit_ajax($id)
    // {
    //     $pendaftaran = PendaftaranModel::findOrFail($id);
    //     $mahasiswa = Auth::user()->mahasiswa;

    //     // Check if the logged in user owns this registration
    //     if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
    //         return response()->json([
    //             'message' => 'Unauthorized access to this registration'
    //         ], 403);
    //     }

    //     $jadwal = JadwalModel::where('tanggal', '>=', now())->orderBy('tanggal')->get();
    //     $status = StatusModel::all();

    //     return response()->json([
    //         'pendaftaran' => $pendaftaran,
    //         'jadwal' => $jadwal,
    //         'status' => $status
    //     ]);
    // }

    // // ------------------- INI BISA --------------------
    // public function update_ajax(Request $request, $id)
    // {
    //     $pendaftaran = PendaftaranModel::findOrFail($id);
    //     $mahasiswa = Auth::user()->mahasiswa;

    //     // Check if the logged in user owns this registration
    //     if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
    //         return response()->json([
    //             'message' => 'Unauthorized access to this registration'
    //         ], 403);
    //     }

    //     // Check status restrictions
    //     if (in_array($pendaftaran->status_id, [1, 2, 4])) {
    //         return response()->json([
    //             'message' => 'Tidak dapat mengedit pendaftaran dengan status ini'
    //         ], 422);
    //     }

    //     $request->validate([
    //         'jadwal_id' => 'required|exists:jadwal,id',
    //         'tanggal_pendaftaran' => 'required|date',
    //     ]);

    //     $pendaftaran->update([
    //         'jadwal_id' => $request->jadwal_id,
    //         'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
    //     ]);

    //     return response()->json([
    //         'message' => 'Pendaftaran berhasil diperbarui',
    //         'data' => $pendaftaran
    //     ]);
    // }

    // // ------------------- INI BISA --------------------
    // public function delete_ajax($id)
    // {
    //     $pendaftaran = PendaftaranModel::findOrFail($id);
    //     $mahasiswa = Auth::user()->mahasiswa;

    //     // Check if the logged in user owns this registration
    //     if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
    //         return response()->json([
    //             'message' => 'Unauthorized access to this registration'
    //         ], 403);
    //     }

    //     // Check status restrictions
    //     if (in_array($pendaftaran->status_id, [2])) {
    //         return response()->json([
    //             'message' => 'Tidak dapat menghapus pendaftaran dengan status Diterima'
    //         ], 422);
    //     }

    //     $pendaftaran->delete();

    //     return response()->json([
    //         'message' => 'Pendaftaran berhasil dihapus'
    //     ]);
    // }

    public function edit_ajax($id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        $jadwal = JadwalModel::where('tanggal', '>=', now())->orderBy('tanggal')->get();
        $status = StatusModel::all();

        return response()->json([
            'pendaftaran' => $pendaftaran,
            'jadwal' => $jadwal,
            'status' => $status
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        // Status validation for editing
        if (!in_array($pendaftaran->status_id, [1, 3, 4])) {
            return response()->json([
                'message' => 'Tidak dapat mengedit pendaftaran dengan status ini'
            ], 422);
        }

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $pendaftaran->update([
            'jadwal_id' => $request->jadwal_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil diperbarui',
            'data' => $pendaftaran
        ]);
    }

    public function delete_ajax($id)
    {
        $pendaftaran = PendaftaranModel::findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        // Authorization check
        if ($pendaftaran->mahasiswa_id != $mahasiswa->id) {
            return response()->json([
                'message' => 'Unauthorized access to this registration'
            ], 403);
        }

        // Status validation for deletion
        if (!in_array($pendaftaran->status_id, [1, 4])) {
            return response()->json([
                'message' => 'Tidak dapat menghapus pendaftaran dengan status ini'
            ], 422);
        }

        $pendaftaran->delete();

        return response()->json([
            'message' => 'Pendaftaran berhasil dihapus'
        ]);
    }
}
