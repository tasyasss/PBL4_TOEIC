@extends('layouts_mahasiswa.template')

@section('title', 'Data Pendaftaran')

@section('content')
<!-- Main Content -->
<div class="container-fluid">
    <!-- Tabel Pendaftaran -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran</h6>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahPendaftaranModal">
                        <i class="fas fa-plus mr-1"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">No</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Pendaftaran</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Tanggal Ujian</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Status</th>
                                    <th class="border-0 font-weight-bold text-gray-700 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Data Row 1 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">1</td>
                                    <td class="py-4">10 Mei 2024</td>
                                    <td class="py-4">15 Juni 2024, 08:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">Diproses</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-info btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#detailPendaftaranModal" data-id="1">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
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
                                    <td class="py-4">12 Mei 2024</td>
                                    <td class="py-4">20 Juni 2024, 10:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-success px-3 py-2 badge-rounded">Diterima</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-info btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#detailPendaftaranModal" data-id="2">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="2">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <!-- Example Data Row 3 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">3</td>
                                    <td class="py-4">14 Mei 2024</td>
                                    <td class="py-4">25 Juni 2024, 14:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-danger px-3 py-2 badge-rounded">Ditolak</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-info btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#detailPendaftaranModal" data-id="3">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="3">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <!-- Example Data Row 4 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">4</td>
                                    <td class="py-4">16 Mei 2024</td>
                                    <td class="py-4">30 Juni 2024, 09:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-info px-3 py-2 badge-rounded">Menunggu Pembayaran</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-info btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#detailPendaftaranModal" data-id="4">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="4">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <!-- Example Data Row 5 -->
                                <tr class="border-bottom">
                                    <td class="py-4 font-weight-bold">5</td>
                                    <td class="py-4">18 Mei 2024</td>
                                    <td class="py-4">05 Juli 2024, 13:00 WIB</td>
                                    <td class="py-4">
                                        <span class="badge badge-warning px-3 py-2 badge-rounded">Diproses</span>
                                    </td>
                                    <td class="py-4">
                                        <button class="btn btn-info btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#detailPendaftaranModal" data-id="5">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-primary btn-sm btn-rounded mr-1" data-toggle="modal" data-target="#editPendaftaranModal" data-id="5">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-rounded">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
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

<!-- Modal Tambah Pendaftaran -->
<div class="modal fade" id="tambahPendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="tambahPendaftaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendaftaranModalLabel">Tambah Data Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahPendaftaran">
                    <div class="form-group">
                        <label for="tanggalPendaftaran">Tanggal Pendaftaran <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggalPendaftaran" name="tanggalPendaftaran" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggalUjian">Tanggal Ujian <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="tanggalUjian" name="tanggalUjian" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="diproses">Diproses</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pendaftaran -->
<div class="modal fade" id="editPendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="editPendaftaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPendaftaranModalLabel">Edit Data Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPendaftaran">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_tanggalPendaftaran">Tanggal Pendaftaran <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_tanggalPendaftaran" name="tanggalPendaftaran" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggalUjian">Tanggal Ujian <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="edit_tanggalUjian" name="tanggalUjian" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="diproses">Diproses</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="menunggu_pembayaran">Menunggu Pembayaran</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnUpdate">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pendaftaran -->
<div class="modal fade" id="detailPendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="detailPendaftaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPendaftaranModalLabel">Detail Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4"><strong>Tanggal Pendaftaran:</strong></div>
                    <div class="col-md-8" id="detail_tanggalPendaftaran">-</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><strong>Tanggal Ujian:</strong></div>
                    <div class="col-md-8" id="detail_tanggalUjian">-</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><strong>Status:</strong></div>
                    <div class="col-md-8" id="detail_status">-</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

<script>
$(document).ready(function() {
    // Handler untuk tombol detail
    $('#detailPendaftaranModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        // Contoh data - dalam aplikasi nyata, ini akan diambil via AJAX
        var data = {
            '1': {
                tanggalPendaftaran: '10 Mei 2024',
                tanggalUjian: '15 Juni 2024, 08:00 WIB',
                status: '<span class="badge badge-warning px-3 py-2 badge-rounded">Diproses</span>'
            },
            '2': {
                tanggalPendaftaran: '12 Mei 2024',
                tanggalUjian: '20 Juni 2024, 10:00 WIB',
                status: '<span class="badge badge-success px-3 py-2 badge-rounded">Diterima</span>'
            },
            '3': {
                tanggalPendaftaran: '14 Mei 2024',
                tanggalUjian: '25 Juni 2024, 14:00 WIB',
                status: '<span class="badge badge-danger px-3 py-2 badge-rounded">Ditolak</span>'
            },
            '4': {
                tanggalPendaftaran: '16 Mei 2024',
                tanggalUjian: '30 Juni 2024, 09:00 WIB',
                status: '<span class="badge badge-info px-3 py-2 badge-rounded">Menunggu Pembayaran</span>'
            },
            '5': {
                tanggalPendaftaran: '18 Mei 2024',
                tanggalUjian: '05 Juli 2024, 13:00 WIB',
                status: '<span class="badge badge-warning px-3 py-2 badge-rounded">Diproses</span>'
            }
        };

        // Isi modal dengan data yang sesuai
        var pendaftaranData = data[id];
        $('#detail_tanggalPendaftaran').text(pendaftaranData.tanggalPendaftaran);
        $('#detail_tanggalUjian').text(pendaftaranData.tanggalUjian);
        $('#detail_status').html(pendaftaranData.status);
    });

    // Handler untuk tombol edit
    $('#editPendaftaranModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        // Contoh data - dalam aplikasi nyata, ini akan diambil via AJAX
        var data = {
            '1': {
                tanggalPendaftaran: '2024-05-10',
                tanggalUjian: '2024-06-15T08:00',
                status: 'diproses'
            },
            '2': {
                tanggalPendaftaran: '2024-05-12',
                tanggalUjian: '2024-06-20T10:00',
                status: 'diterima'
            },
            '3': {
                tanggalPendaftaran: '2024-05-14',
                tanggalUjian: '2024-06-25T14:00',
                status: 'ditolak'
            },
            '4': {
                tanggalPendaftaran: '2024-05-16',
                tanggalUjian: '2024-06-30T09:00',
                status: 'menunggu_pembayaran'
            },
            '5': {
                tanggalPendaftaran: '2024-05-18',
                tanggalUjian: '2024-07-05T13:00',
                status: 'diproses'
            }
        };

        // Isi form dengan data yang sesuai
        var pendaftaranData = data[id];
        $('#edit_id').val(id);
        $('#edit_tanggalPendaftaran').val(pendaftaranData.tanggalPendaftaran);
        $('#edit_tanggalUjian').val(pendaftaranData.tanggalUjian);
        $('#edit_status').val(pendaftaranData.status);
    });

    // Handler untuk tombol simpan (tambah data)
    $('#btnSimpan').click(function() {
        if ($('#formTambahPendaftaran')[0].checkValidity()) {
            // Lakukan AJAX submit di sini
            alert('Data pendaftaran berhasil ditambahkan!');
            $('#tambahPendaftaranModal').modal('hide');
        } else {
            $('#formTambahPendaftaran')[0].reportValidity();
        }
    });

    // Handler untuk tombol update (edit data)
    $('#btnUpdate').click(function() {
        if ($('#formEditPendaftaran')[0].checkValidity()) {
            // Lakukan AJAX submit di sini
            alert('Data pendaftaran berhasil diperbarui!');
            $('#editPendaftaranModal').modal('hide');
        } else {
            $('#formEditPendaftaran')[0].reportValidity();
        }
    });
});
</script>
@endpush