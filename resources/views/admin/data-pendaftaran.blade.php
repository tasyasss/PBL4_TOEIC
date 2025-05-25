@extends('layouts_admin.template')

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
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Kode Pendaftaran</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Nama</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Pelaksanaan</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Prodi</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Validasi</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">1</td>
                                    <td class="py-4 font-weight-bold">REG-001</td>
                                    <td class="py-4">Titonia Aurellia</td>
                                    <td class="py-4">25 Mei 2025</td>
                                    <td class="py-4">Teknologi Informasi</td>
                                    <td class="py-4">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-sm btn-rounded">Terima</button>
                                            <button class="btn btn-danger btn-sm btn-rounded">Tolak</button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Hapus</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">2</td>
                                    <td class="py-4 font-weight-bold">REG-002</td>
                                    <td class="py-4">An Nastasya</td>
                                    <td class="py-4">26 Mei 2025</td>
                                    <td class="py-4">Teknologi Informasi</td>
                                    <td class="py-4">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-sm btn-rounded">Terima</button>
                                            <button class="btn btn-danger btn-sm btn-rounded">Tolak</button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Hapus</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">3</td>
                                    <td class="py-4 font-weight-bold">REG-003</td>
                                    <td class="py-4">Vera Eita H. P.</td>
                                    <td class="py-4">27 Mei 2025</td>
                                    <td class="py-4">Teknologi Informasi</td>
                                    <td class="py-4">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-sm btn-rounded">Terima</button>
                                            <button class="btn btn-danger btn-sm btn-rounded">Tolak</button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Hapus</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">4</td>
                                    <td class="py-4 font-weight-bold">REG-004</td>
                                    <td class="py-4">jak</td>
                                    <td class="py-4">28 Mei 2025</td>
                                    <td class="py-4">Sistem Informasi</td>
                                    <td class="py-4">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-sm btn-rounded">Terima</button>
                                            <button class="btn btn-danger btn-sm btn-rounded">Tolak</button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Hapus</button>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">5</td>
                                    <td class="py-4 font-weight-bold">REG-005</td>
                                    <td class="py-4">ipan</td>
                                    <td class="py-4">29 Mei 2025</td>
                                    <td class="py-4">Teknik Komputer</td>
                                    <td class="py-4">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-success btn-sm btn-rounded">Terima</button>
                                            <button class="btn btn-danger btn-sm btn-rounded">Tolak</button>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-danger btn-sm btn-rounded">Hapus</button>
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
