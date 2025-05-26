@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Pendaftaran Mahasiswa -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran Mahasiswa</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPendaftaranModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_pendaftaran" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">NIM</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Nama</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Program Studi</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Pendaftaran</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Status</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                <!-- Example Data Row 1 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">1</td>
                                    <td class="py-4">20220001</td>
                                    <td class="py-4">John Doe</td>
                                    <td class="py-4">Teknik Informatika</td>
                                    <td class="py-4">15 Juni 2023</td>
                                    <td class="py-4"><span class="badge badge-success">Diterima</span></td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="1">
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
                                    <td class="py-4">Sistem Informasi</td>
                                    <td class="py-4">20 Juni 2023</td>
                                    <td class="py-4"><span class="badge badge-warning">Proses</span></td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="2">
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahPendaftaranModal" tabindex="-1" role="dialog"
        aria-labelledby="tambahPendaftaranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formTambahPendaftaran">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pendaftaran</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mahasiswa_id">Mahasiswa</label>
                            <select class="form-control" id="mahasiswa_id" name="mahasiswa_id" required>
                                <option value="">Pilih Mahasiswa</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jadwal_id">Jadwal</label>
                            <select class="form-control" id="jadwal_id" name="jadwal_id" required>
                                <option value="">Pilih Jadwal</option>
                                <option value="1">Jadwal 1</option>
                                <option value="2">Jadwal 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_id">Status</label>
                            <select class="form-control" id="status_id" name="status_id" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Diterima</option>
                                <option value="2">Proses</option>
                                <option value="3">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="editPendaftaranLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formEditPendaftaran">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pendaftaran</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_mahasiswa_id">Mahasiswa</label>
                            <select class="form-control" id="edit_mahasiswa_id" name="mahasiswa_id" required>
                                <option value="">Pilih Mahasiswa</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_pendaftaran">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" id="edit_tanggal_pendaftaran"
                                name="tanggal_pendaftaran" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_jadwal_id">Jadwal</label>
                            <select class="form-control" id="edit_jadwal_id" name="jadwal_id" required>
                                <option value="">Pilih Jadwal</option>
                                <option value="1">Jadwal 1</option>
                                <option value="2">Jadwal 2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_status_id">Status</label>
                            <select class="form-control" id="edit_status_id" name="status_id" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Belum Bayar</option>
                                <option value="2">Sudah Bayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
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
            $('#editPendaftaranModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                var data = {
                    '1': {
                        mahasiswa_id: '1',
                        tanggal_pendaftaran: '2025-05-20',
                        jadwal_id: '1',
                        status_id: '2'
                    },
                    '2': {
                        mahasiswa_id: '2',
                        tanggal_pendaftaran: '2025-05-21',
                        jadwal_id: '2',
                        status_id: '1'
                    }
                };

                var item = data[id];
                $('#edit_id').val(id);
                $('#edit_mahasiswa_id').val(item.mahasiswa_id);
                $('#edit_tanggal_pendaftaran').val(item.tanggal_pendaftaran);
                $('#edit_jadwal_id').val(item.jadwal_id);
                $('#edit_status_id').val(item.status_id);
            });

            $('#formTambahPendaftaran').on('submit', function(e) {
                e.preventDefault();
                alert('Data pendaftaran berhasil ditambahkan!');
                $('#tambahPendaftaranModal').modal('hide');
            });

            $('#formEditPendaftaran').on('submit', function(e) {
                e.preventDefault();
                alert('Data pendaftaran berhasil diperbarui!');
                $('#editPendaftaranModal').modal('hide');
            });
        });
    </script>
@endsection

@push('js')
    <script>
        // ------ UNTUK DATATABLES ------
        $(document).ready(function() {
            var dataPendaftaran = $('#table_pendaftaran').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('admin/pendaftaran/list') }}",
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
                    data: "mahasiswa.mahasiswa_nim",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "mahasiswa.mahasiswa_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "mahasiswa.prodi.prodi_nama",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tanggal_pendaftaran",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "status.status_nama",
                    className: "",
                    orderable: false,
                    searchable: false,
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
