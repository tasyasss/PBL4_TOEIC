@extends('layouts_admin.template')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <!-- Selamat Datang -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-5">
        <h2 class="text-xl font-semibold text-gray-800">Selamat datang, {{ $admin->admin_nama ?? 'Admin' }}!</h2>
        <p class="text-sm text-gray-600 mt-1">Semoga harimu menyenangkan dan produktif.</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="row mb-4">
        {{-- total data --}}
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <h5>Total Pendaftaran</h5>
                    <h3>{{ $totalPendaftaran }}</h3>
                </div>
            </div>
        </div>

        {{-- data diproses --}}
        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <h5>Diproses</h5>
                    <h3>{{ $totalDiproses }}</h3>
                </div>
            </div>
        </div>

        {{-- data diterima --}}
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <h5>Diterima</h5>
                    <h3>{{ $totalDiterima }}</h3>
                </div>
            </div>
        </div>

        {{-- data ditolak --}}
        <div class="col-md-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <h5>Ditolak</h5>
                    <h3>{{ $totalDitolak }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <table id="pendaftaran-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jadwal</th>
                <th>Status</th>
            </tr>
        </thead>
        {{-- <tbody>
            @foreach($pendaftaranDiproses as $data)
            <tr>
                <td>{{ $data->user->nama }}</td>
                <td>{{ $data->user->email }}</td>
                <td>{{ $data->jadwal->tanggal }}</td>
                <td><span class="badge bg-warning text-dark">{{ ucfirst($data->status) }}</span></td>
            </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>

<!-- JavaScript untuk Grafik dan Tabel -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
// Inisialisasi DataTable
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>   
@endsection