<!-- Modal Detail Pendaftaran -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-info-circle"></i> Detail Pendaftaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0 text-primary">
                                    <i class="fas fa-user"></i> Data Mahasiswa
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-2">
                                    <label class="col-sm-4 col-form-label font-weight-bold">NIM:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-plaintext">{{ $pendaftaran->mahasiswa->mahasiswa_nim ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Nama:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-plaintext">{{ $pendaftaran->mahasiswa->mahasiswa_nama ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-4 col-form-label font-weight-bold">Program Studi:</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-plaintext">{{ $pendaftaran->mahasiswa->prodi->prodi_nama ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0 text-primary">
                                    <i class="fas fa-clipboard-list"></i> Data Pendaftaran
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-2">
                                    <label class="col-sm-5 col-form-label font-weight-bold">Tanggal:</label>
                                    <div class="col-sm-7">
                                        <p class="form-control-plaintext">
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-5 col-form-label font-weight-bold">Jadwal:</label>
                                    <div class="col-sm-7">
                                        <p class="form-control-plaintext">{{ $pendaftaran->jadwal->jadwal_nama ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-sm-5 col-form-label font-weight-bold">Status:</label>
                                    <div class="col-sm-7">
                                        <p class="form-control-plaintext">
                                            @if($pendaftaran->status)
                                                @php
                                                    $statusClass = '';
                                                    switch($pendaftaran->status->status_nama) {
                                                        case 'Diterima':
                                                            $statusClass = 'badge-success';
                                                            break;
                                                        case 'Ditolak':
                                                            $statusClass = 'badge-danger';
                                                            break;
                                                        case 'Diproses':
                                                            $statusClass = 'badge-warning';
                                                            break;
                                                        default:
                                                            $statusClass = 'badge-secondary';
                                                    }
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-3 py-2">
                                                    {{ $pendaftaran->status->status_nama }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary px-3 py-2">-</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0 text-primary">
                            <i class="fas fa-info"></i> Informasi Tambahan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">ID Pendaftaran: <strong>{{ $pendaftaran->id }}</strong></small>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <small class="text-muted">
                                    Dibuat: {{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d M Y H:i') : '-' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-plaintext {
        padding-left: 0;
        padding-right: 0;
        border: none;
        background: transparent;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    @media print {
        .modal-header, .modal-footer {
            display: none !important;
        }
        .modal-body {
            padding: 0 !important;
        }
    }
</style>
