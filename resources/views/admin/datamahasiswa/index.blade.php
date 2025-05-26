@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Mahasiswa -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahMahasiswaModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_mahasiswa" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">NIM</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Nama</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Alamat</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No. Telepon</th>
                                        {{-- <th class="border-0 font-weight-bold text-gray-700 py-3">Email</th> --}}
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Program Studi</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                <!-- Example Data Row 1 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">1</td>
                                    <td class="py-4">20220001</td>
                                    <td class="py-4">John Doe</td>
                                    <td class="py-4">Jl. Contoh No. 123</td>
                                    <td class="py-4">081234567890</td>
                                    <td class="py-4">john@example.com</td>
                                    <td class="py-4">Teknik Informatika</td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editMahasiswaModal" data-id="1">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <!-- Example Data Row 2 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">2</td>
                                    <td class="py-4">20220002</td>
                                    <td class="py-4">Jane Smith</td>
                                    <td class="py-4">Jl. Sample No. 456</td>
                                    <td class="py-4">081298765432</td>
                                    <td class="py-4">jane@example.com</td>
                                    <td class="py-4">Sistem Informasi</td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editMahasiswaModal" data-id="2">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" role="dialog"
        aria-labelledby="tambahMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMahasiswa">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim">NIM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        placeholder="Masukkan NIM" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="noTelp">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="noTelp" name="noTelp"
                                        placeholder="Masukkan nomor telepon" maxlength="15" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email" required>
                                </div>
                                <div class="form-group">
                                    <label for="programStudi">Program Studi <span class="text-danger">*</span></label>
                                    <select class="form-control" id="programStudi" name="programStudi" required>
                                        <option value="">Pilih Program Studi</option>
                                        <option value="1">Teknik Informatika</option>
                                        <option value="2">Sistem Informasi</option>
                                        <option value="3">Teknik Komputer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fileKTM">File KTM</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileKTM" name="fileKTM">
                                        <label class="custom-file-label" for="fileKTM">Pilih file...</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fileKTP">File KTP</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileKTP" name="fileKTP">
                                        <label class="custom-file-label" for="fileKTP">Pilih file...</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="filePasFoto">Pas Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="filePasFoto"
                                            name="filePasFoto">
                                        <label class="custom-file-label" for="filePasFoto">Pilih file...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mahasiswa -->
    <div class="modal fade" id="editMahasiswaModal" tabindex="-1" role="dialog"
        aria-labelledby="editMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMahasiswaModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditMahasiswa">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_nim">NIM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_nim" name="nim"
                                        placeholder="Masukkan NIM" maxlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_nama">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_nama" name="nama"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_alamat">Alamat <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" placeholder="Masukkan alamat"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_noTelp">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_noTelp" name="noTelp"
                                        placeholder="Masukkan nomor telepon" maxlength="15" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="edit_email" name="email"
                                        placeholder="Masukkan email" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_programStudi">Program Studi <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="edit_programStudi" name="programStudi" required>
                                        <option value="">Pilih Program Studi</option>
                                        <option value="1">Teknik Informatika</option>
                                        <option value="2">Sistem Informasi</option>
                                        <option value="3">Teknik Komputer</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit_fileKTM">File KTM</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_fileKTM"
                                            name="fileKTM">
                                        <label class="custom-file-label" for="edit_fileKTM">Pilih file...</label>
                                    </div>
                                    <small class="form-text text-muted" id="currentKTM"></small>
                                </div>
                                <div class="form-group">
                                    <label for="edit_fileKTP">File KTP</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_fileKTP"
                                            name="fileKTP">
                                        <label class="custom-file-label" for="edit_fileKTP">Pilih file...</label>
                                    </div>
                                    <small class="form-text text-muted" id="currentKTP"></small>
                                </div>
                                <div class="form-group">
                                    <label for="edit_filePasFoto">Pas Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_filePasFoto"
                                            name="filePasFoto">
                                        <label class="custom-file-label" for="edit_filePasFoto">Pilih file...</label>
                                    </div>
                                    <small class="form-text text-muted" id="currentPasFoto"></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnUpdate">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include CSS dan JS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Tampilkan nama file yang dipilih
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Handler untuk tombol edit
            $('#editMahasiswaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                // Contoh data - dalam aplikasi nyata, ini akan diambil via AJAX
                var data = {
                    '1': {
                        nim: '20220001',
                        nama: 'John Doe',
                        alamat: 'Jl. Contoh No. 123',
                        noTelp: '081234567890',
                        email: 'john@example.com',
                        programStudi: '1',
                        fileKTM: 'ktm_john.jpg',
                        fileKTP: 'ktp_john.jpg',
                        filePasFoto: 'foto_john.jpg'
                    },
                    '2': {
                        nim: '20220002',
                        nama: 'Jane Smith',
                        alamat: 'Jl. Sample No. 456',
                        noTelp: '081298765432',
                        email: 'jane@example.com',
                        programStudi: '2',
                        fileKTM: 'ktm_jane.jpg',
                        fileKTP: 'ktp_jane.jpg',
                        filePasFoto: 'foto_jane.jpg'
                    }
                };

                // Isi form dengan data yang sesuai
                var studentData = data[id];
                $('#edit_id').val(id);
                $('#edit_nim').val(studentData.nim);
                $('#edit_nama').val(studentData.nama);
                $('#edit_alamat').val(studentData.alamat);
                $('#edit_noTelp').val(studentData.noTelp);
                $('#edit_email').val(studentData.email);
                $('#edit_programStudi').val(studentData.programStudi);
                $('#currentKTM').text('File saat ini: ' + studentData.fileKTM);
                $('#currentKTP').text('File saat ini: ' + studentData.fileKTP);
                $('#currentPasFoto').text('File saat ini: ' + studentData.filePasFoto);
            });

            // Handler untuk tombol simpan (tambah data)
            $('#btnSimpan').click(function() {
                if ($('#formTambahMahasiswa')[0].checkValidity()) {
                    // Lakukan AJAX submit di sini
                    alert('Data mahasiswa berhasil ditambahkan!');
                    $('#tambahMahasiswaModal').modal('hide');
                } else {
                    $('#formTambahMahasiswa')[0].reportValidity();
                }
            });

            // Handler untuk tombol update (edit data)
            $('#btnUpdate').click(function() {
                if ($('#formEditMahasiswa')[0].checkValidity()) {
                    // Lakukan AJAX submit di sini
                    alert('Data mahasiswa berhasil diperbarui!');
                    $('#editMahasiswaModal').modal('hide');
                } else {
                    $('#formEditMahasiswa')[0].reportValidity();
                }
            });
        });
    </script>
@endsection

@push('js')
    <script> // ------ UNTUK DATATABLES ------
        $(document).ready(function() {
            var dataMahasiswa = $('#table_mahasiswa').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('admin/mahasiswa/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "mahasiswa_nim",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "mahasiswa_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "alamat",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "no_telp",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    // mengambil data level hasil dari ORM berelasi
                    data: "prodi.prodi_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endpush
