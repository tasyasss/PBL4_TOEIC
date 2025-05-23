@extends('layouts_mahasiswa.template')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <!-- Kartu Statistik -->
    <div class="row">
        <!-- Kartu 1: Data Terverifikasi -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Terverifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                            <div class="text-xs text-success">+5%</div>
                        </div>
                        <div class="col-auto">
                            <canvas id="chart1" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 2: Data dalam Proses -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data dalam Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                            <div class="text-xs text-warning">+8%</div>
                        </div>
                        <div class="col-auto">
                            <canvas id="chart2" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Data Tertolak -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Data Tertolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                            <div class="text-xs text-danger">-5%</div>
                        </div>
                        <div class="col-auto">
                            <canvas id="chart3" width="100" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Garis -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Verifikasi</h6>
                </div>
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran</h6>
                    <button class="btn btn-outline-secondary btn-sm">
                        May <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">ID Pendaftaran</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Keterangan</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Edit</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">0012</td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">Terverifikasi</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded">Edit</button>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Delete</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">0015</td>
                                    <td class="py-4">
                                        <span class="badge badge-danger px-3 py-2 badge-rounded">Ditolak</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded">Edit</button>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Delete</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">0020</td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">Proses</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-primary btn-sm btn-rounded">Edit</button>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
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
@endsection