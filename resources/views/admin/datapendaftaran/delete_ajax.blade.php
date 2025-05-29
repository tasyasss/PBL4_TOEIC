<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan!</strong> Data yang sudah dihapus tidak dapat dikembalikan.
                </div>
                
                <p class="mb-3">Apakah Anda yakin ingin menghapus data pendaftaran berikut?</p>
                
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" onclick="hapusData({{ $pendaftaran->id }})">
                    <i class="fas fa-trash"></i> Ya, Hapus Data
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function hapusData(id) {
    // Tampilkan loading
    Swal.fire({
        title: 'Menghapus Data...',
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '/admin/pendaftaran/' + id + '/destroy',
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#detailModal').modal('hide');
            
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Reload DataTable
                    $('#table_pendaftaran').DataTable().ajax.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message
                });
            }
        },
        error: function(xhr) {
            $('#detailModal').modal('hide');
            
            let errorMessage = 'Terjadi kesalahan saat menghapus data';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage
            });
        }
    });
}
</script>

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
    
    .alert-warning {
        border-left: 4px solid #ffc107;
    }
</style>
