@extends('layouts_admin.template')

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Tabel Jadwal & Kuota -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Jadwal & Kuota</h6>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDataModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="table_jadwal" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Pelaksanaan</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Jam Pelaksanaan</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Total Kuota</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Kuota Terisi</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Kuota Tersisa</th>
                                        <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">1</td>
                                    <td class="py-4">15 Juni 2024, 08:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-info px-3 py-2 badge-rounded">50</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">35</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">15</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">2</td>
                                    <td class="py-4">20 Juni 2024, 10:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-info px-3 py-2 badge-rounded">40</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">40</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-secondary px-3 py-2 badge-rounded">0</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">3</td>
                                    <td class="py-4">25 Juni 2024, 14:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-info px-3 py-2 badge-rounded">30</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">18</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">12</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">4</td>
                                    <td class="py-4">30 Juni 2024, 09:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-info px-3 py-2 badge-rounded">60</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">45</span>
                                    </td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">15</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1">
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Jadwal & Kuota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="tanggalUjian">Tanggal Pelaksanaan Ujian</label>
                            <input type="datetime-local" class="form-control" id="tanggalUjian" required>
                        </div>
                        <div class="form-group">
                            <label for="totalKuota">Total Kuota</label>
                            <input type="number" class="form-control" id="totalKuota" placeholder="Masukkan total kuota"
                                min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="kuotaTerisi">Kuota Terisi</label>
                            <input type="number" class="form-control" id="kuotaTerisi" placeholder="Masukkan kuota terisi"
                                min="0" value="0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
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
@endsection

@push('js')
    <script>
        // ------ UNTUK DATATABLES ------
        $(document).ready(function() {
            var dataJadwal = $('#table_jadwal').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('admin/jadwal/list') }}",
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
                        data: "tanggal_pelaksanaan",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "jam_pelaksanaan",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "kuota",
                        className: "text-center",
                        orderable: false
                    }, {
                        data: "kuota_terisi",
                        className: "text-center",
                        orderable: false
                    }, {
                        data: "kuota_tersisa",
                        className: "text-center",
                        orderable: false
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
