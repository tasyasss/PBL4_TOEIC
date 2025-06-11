<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\UsersModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

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
                $btn = '<button onclick="showDetail(' . $mhs->id . ')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('admin/mahasiswa/edit_ajax/' . $mhs->id) . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="deleteConfirm(\'' . url('admin/mahasiswa/delete_ajax/' . $mhs->id) . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $prodi = ProdiModel::select('id', 'prodi_nama')->get();
        return view('admin.datamahasiswa.create_ajax')->with('prodi', $prodi);
    }

    public function edit_ajax($id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);
        $prodi = ProdiModel::select('id', 'prodi_nama')->get();

        return view('admin.datamahasiswa.edit_ajax', compact('mahasiswa', 'prodi'));
    }

    public function update_ajax(Request $request, $id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);

        $rules = [
            'mahasiswa_nim'   => 'required|string|max:10|unique:mahasiswa,mahasiswa_nim,' . $id,
            'mahasiswa_nama'  => 'required|string|max:100',
            'alamat'          => 'required|string',
            'no_telp'         => 'string|max:15',
            'email'           => 'required|email|max:100',
            'file_ktm'        => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_ktp'        => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_pas_foto'   => 'file|mimes:jpg,jpeg,png|max:2048',
            'prodi_id'        => 'integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        $nim = $request->mahasiswa_nim;
        $data = $request->except(['fileKTM', 'fileKTP', 'filePasFoto']);

        // File KTM
        if ($request->hasFile('fileKTM')) {
            $oldPath = public_path('uploads/ktm_mahasiswa/' . $mahasiswa->file_ktm);
            if ($mahasiswa->file_ktm && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $fileKTM = $request->file('fileKTM');
            $fileNameKTM = 'ktm_' . $nim . '.' . $fileKTM->getClientOriginalExtension();
            $fileKTM->move(public_path('uploads/ktm_mahasiswa'), $fileNameKTM);
            $data['file_ktm'] = $fileNameKTM;
        }

        // File KTP
        if ($request->hasFile('fileKTP')) {
            $oldPath = public_path('uploads/ktp_mahasiswa/' . $mahasiswa->file_ktp);
            if ($mahasiswa->file_ktp && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $fileKTP = $request->file('fileKTP');
            $fileNameKTP = 'ktp_' . $nim . '.' . $fileKTP->getClientOriginalExtension();
            $fileKTP->move(public_path('uploads/ktp_mahasiswa'), $fileNameKTP);
            $data['file_ktp'] = $fileNameKTP;
        }

        // File Pas Foto
        if ($request->hasFile('filePasFoto')) {
            $oldPath = public_path('uploads/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto);
            if ($mahasiswa->file_pas_foto && file_exists($oldPath)) {
                unlink($oldPath);
            }

            $filePasFoto = $request->file('filePasFoto');
            $fileNamePasFoto = 'pas_foto_' . $nim . '.' . $filePasFoto->getClientOriginalExtension();
            $filePasFoto->move(public_path('uploads/pas_foto_mahasiswa'), $fileNamePasFoto);
            $data['file_pas_foto'] = $fileNamePasFoto;
        }

        $mahasiswa->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil diperbarui'
        ]);
    }


    public function delete_ajax($id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);

        // Hapus file KTM
        $pathKTM = public_path('uploads/ktm_mahasiswa/' . $mahasiswa->file_ktm);
        if ($mahasiswa->file_ktm && file_exists($pathKTM)) {
            unlink($pathKTM);
        }

        // Hapus file KTP
        $pathKTP = public_path('uploads/ktp_mahasiswa/' . $mahasiswa->file_ktp);
        if ($mahasiswa->file_ktp && file_exists($pathKTP)) {
            unlink($pathKTP);
        }

        // Hapus file Pas Foto
        $pathFoto = public_path('uploads/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto);
        if ($mahasiswa->file_pas_foto && file_exists($pathFoto)) {
            unlink($pathFoto);
        }

        // Hapus data dari database
        $mahasiswa->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ]);
    }


    public function store_ajax(Request $request)
    {
        $rules = [
            'mahasiswa_nim' => 'required|string|max:10|unique:mahasiswa,mahasiswa_nim',
            'mahasiswa_nama' => 'required|string|max:100',
            'alamat'        => 'required|string',
            'no_telp'       => 'string|max:15',
            'email'         => 'required|email|max:100',
            'file_ktm'      => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_ktp'      => 'file|mimes:jpg,jpeg,png|max:2048',
            'file_pas_foto' => 'file|mimes:jpg,jpeg,png|max:2048',
            'prodi_id'      => 'integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }



        $nim = $request->mahasiswa_nim; // Ambil NIM untuk nama file
        $data = $request->except(['fileKTM', 'fileKTP', 'filePasFoto']);
        $data['users_id'] = auth()->user()->id; // Ambil ID user yang sedang login

        // Simpan file KTM
        if ($request->hasFile('fileKTM')) {
            $fileKTM = $request->file('fileKTM');
            $fileNameKTM = 'ktm_' . $nim . '.' . $fileKTM->getClientOriginalExtension();
            $fileKTM->storeAs('public/ktm_mahasiswa', $fileNameKTM); // Simpan di storage/app/public/ktm_mahasiswa
            $data['file_ktm'] = $fileNameKTM;
        }

        // Simpan file KTP
        if ($request->hasFile('fileKTP')) {
            $fileKTP = $request->file('fileKTP');
            $fileNameKTP = 'ktp_' . $nim . '.' . $fileKTP->getClientOriginalExtension();
            $fileKTP->storeAs('public/ktp_mahasiswa', $fileNameKTP);
            $data['file_ktp'] = $fileNameKTP;
        }

        // Simpan file Pas Foto
        if ($request->hasFile('filePasFoto')) {
            $filePasFoto = $request->file('filePasFoto');
            $fileNamePasFoto = 'pas_foto_' . $nim . '.' . $filePasFoto->getClientOriginalExtension();
            $filePasFoto->storeAs('public/pas_foto_mahasiswa', $fileNamePasFoto);
            $data['file_pas_foto'] = $fileNamePasFoto;
        }

        MahasiswaModel::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil disimpan'
        ]);
    }
    public function show_ajax($id)
    {
        $mahasiswa = MahasiswaModel::with(['user', 'prodi'])->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ]);
        }

        return view('admin.datamahasiswa.detail', compact('mahasiswa'));
    }

    // Reset Password AJAX
    public function resetPassword($id)
    {
        try {
            $mahasiswa = MahasiswaModel::findOrFail($id);

            // Update password user terkait
            $mahasiswa->user()->update([
                'password' => bcrypt('12345')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset ke 12345'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function import(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Maksimal 10MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'File tidak valid. Harap upload file excel atau csv.',
            ]);
        }

        // Ambil file yang di-upload
        $file = $request->file('file');

        try {
            // Membaca file excel menggunakan PhpSpreadsheet
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();

            // Ambil data dari sheet (dalam bentuk array)
            $data = [];
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                if ($rowIndex == 1) continue; // Skip header row

                // Tentukan default file jika tidak ada foto yang diunggah
                $defaultFile = 'default_image.jpg'; // Gantilah dengan file default yang ada di server

                // Membuat pengguna baru untuk setiap mahasiswa
                $user = UsersModel::create([
                    'username' => 'mhs' . $sheet->getCell('A' . $rowIndex)->getValue(), // Gunakan NIM sebagai username
                    'password' => Hash::make('12345'), // Password default, bisa Anda ubah
                    'roles_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Menambahkan data mahasiswa ke array
                $data[] = [
                    'mahasiswa_nim' => $sheet->getCell('A' . $rowIndex)->getValue(),
                    'mahasiswa_nama' => $sheet->getCell('B' . $rowIndex)->getValue(),
                    'alamat' => $sheet->getCell('C' . $rowIndex)->getValue(),
                    'no_telp' => $sheet->getCell('D' . $rowIndex)->getValue(),
                    'email' => $sheet->getCell('E' . $rowIndex)->getValue(),
                    'prodi_id' => ProdiModel::where('prodi_nama', $sheet->getCell('F' . $rowIndex)->getValue())->first()->id, // Mendapatkan prodi_id berdasarkan nama prodi
                    'users_id' => $user->id, // Menggunakan users_id yang baru saja dibuat
                    'file_ktm' => $defaultFile, // Menggunakan file default jika tidak ada file yang diunggah
                    'file_ktp' => $defaultFile, // Menggunakan file default jika tidak ada file yang diunggah
                    'file_pas_foto' => $defaultFile, // Menggunakan file default jika tidak ada file yang diunggah
                ];
            }

            // Simpan data mahasiswa ke database
            MahasiswaModel::insert($data);

            return response()->json([
                'status' => true,
                'message' => 'Data mahasiswa berhasil diimport!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage(),
            ]);
        }
    }
}
