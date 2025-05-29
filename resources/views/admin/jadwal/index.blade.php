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
                        <button onclick="modalAction('{{ route('admin.jadwal.create_ajax') }}')"
                            class="btn btn-primary btn-sm">Tambah Data </button>
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
                            </table>
                        </div>
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

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
@endsection

@push('css')
@endpush

@push('js')
    <script>
        // ------ UNTUK DATATABLES ------
        function modalAction(url = ''){
            $('#myModal').load(url,function(){
                $('#myModal').modal('show');
            });
        }
        var dataJadwal;
        $(document).ready(function() {
            dataJadwal = $('#table_jadwal').DataTable({
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
                }]
            });
        });
    </script>
@endpush