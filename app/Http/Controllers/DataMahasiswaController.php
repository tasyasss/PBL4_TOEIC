<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

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
                $btn =  '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/show_ajax') . '\')" class="btn btn-outline-info btn-sm"><i class="fas fa-info"></i>   Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/edit_ajax') . '\')" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/' . $mhs->id . '/delete_ajax') . '\')" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button> ';

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

    public function store_ajax(Request $request)
    {
        $rules = [
            'mahasiswa_nim' => 'required|string|max:10|unique:mahasiswa,mahasiswa_nim',
            'mahasiswa_nama'=> 'required|string|max:100',
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
}
