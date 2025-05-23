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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>234178012</td>
                                    <td>Titonia Aurellia</td>
                                    <td>Teknologi Informasi</td>
                                    <td><span class="badge badge-success">Terverifikasi</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Terima</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2341760131</td>
                                    <td>An Nastasya</td>
                                    <td>Teknologi Informasi</td>
                                    <td><span class="badge badge-danger">Ditolak</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Terima</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2341760047</td>
                                    <td>Vera Eita H. P.</td>
                                    <td>Teknologi Informasi</td>
                                    <td><span class="badge badge-warning">Proses</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Terima</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>2341760047</td>
                                    <td>Vera Eita H. P.</td>
                                    <td>Teknologi Informasi</td>
                                    <td><span class="badge badge-warning">Proses</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Terima</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>2341760047</td>
                                    <td>Vera Eita H. P.</td>
                                    <td>Teknologi Informasi</td>
                                    <td><span class="badge badge-warning">Proses</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Terima</button>
                                        <button class="btn btn-danger btn-sm">Tolak</button>
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

<!-- JavaScript untuk Grafik dan Tabel -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
// Diagram Lingkaran 1 (Data Terverifikasi)
new Chart(document.getElementById('chart1'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [95, 5],
            backgroundColor: ['#1cc88a', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Diagram Lingkaran 2 (Data dalam Proses)
new Chart(document.getElementById('chart2'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [92, 8],
            backgroundColor: ['#f6c23e', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Diagram Lingkaran 3 (Data Tertolak)
new Chart(document.getElementById('chart3'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [95, 5],
            backgroundColor: ['#e74a3b', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Grafik Garis
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Verifikasi',
            data: [10, 15, 20, 12, 18, 25, 22, 30, 28, 35, 40, 38],
            borderColor: '#4e73df',
            fill: true,
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});

// Inisialisasi DataTable
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>   
@endsection