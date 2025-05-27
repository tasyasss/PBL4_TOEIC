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

                        <button class="btn btn-primary btn-sm" onclick="modalAction('{{ url('admin/mahasiswa/create_ajax') }}')">
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
                            </table>
                        </div>
                    </div>
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


    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        // ------ UNTUK DATATABLES ------
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataMahasiswa;
        $(document).ready(function() {
            dataMahasiswa = $('#table_mahasiswa').DataTable({
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
