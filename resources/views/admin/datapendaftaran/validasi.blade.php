@extends('layouts_admin.template')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@section('content')
    <div class="container-fluid">
        <div class="card-body">
            @if ($pendaftaran)
                <form id="form-validasi" action="{{ route('admin.pendaftaran.validasi_proses', $pendaftaran->id) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="status_id" name="status_id" value="">
                    <div class="row">
                        <!-- Kolom Kiri: Data Mahasiswa -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-user-graduate"></i> Data Mahasiswa
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row align-items-center">
                                        <label for="mahasiswa_nim" class="col-md-3 col-form-label font-weight-bold">NIM :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="mahasiswa_nim"
                                                name="mahasiswa_nim" maxlength="15"
                                                value="{{ $mahasiswa->mahasiswa_nim ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="mahasiswa_nim_checkbox"
                                                    name="mahasiswa_nim_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="nik" class="col-md-3 col-form-label font-weight-bold">NIK :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="nik"
                                                name="nik" maxlength="15" value="{{ $mahasiswa->nik ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="nik_checkbox"
                                                    name="nik_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="mahasiswa_nama" class="col-md-3 col-form-label font-weight-bold">Nama
                                            Lengkap : </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="mahasiswa_nama"
                                                name="mahasiswa_nama" maxlength="15"
                                                value="{{ $mahasiswa->mahasiswa_nama ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="mahasiswa_nama_checkbox"
                                                    name="mahasiswa_nama_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="no_telp" class="col-md-3 col-form-label font-weight-bold">Nomor Telepon
                                            :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="text" class="form-control flex-grow-1 mr-2" id="no_telp"
                                                name="no_telp" maxlength="15" value="{{ $mahasiswa->no_telp ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="no_telp_checkbox"
                                                    name="no_telp_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="email" class="col-md-3 col-form-label font-weight-bold">Email :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="email" class="form-control flex-grow-1 mr-2" id="email"
                                                name="email" maxlength="15" value="{{ $mahasiswa->email ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="email_checkbox"
                                                    name="email_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="text" class="col-md-3 col-form-label font-weight-bold">Alamat :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="alamat" class="form-control flex-grow-1 mr-2" id="alamat"
                                                name="alamat" maxlength="15" value="{{ $mahasiswa->alamat ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="alamat_checkbox"
                                                    name="alamat_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="prodi" class="col-md-3 col-form-label font-weight-bold">Program
                                            Studi :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="prodi" class="form-control flex-grow-1 mr-2" id="prodi"
                                                name="prodi" maxlength="15"
                                                value="{{ $mahasiswa->prodi->prodi_nama ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="prodi_checkbox"
                                                    name="prodi_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="jurusan" class="col-md-3 col-form-label font-weight-bold">Jurusan :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="jurusan" class="form-control flex-grow-1 mr-2" id="jurusan"
                                                name="jurusan" maxlength="15"
                                                value="{{ $mahasiswa->jurusan->jurusan_nama ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="jurusan_checkbox"
                                                    name="jurusan_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="kampus" class="col-md-3 col-form-label font-weight-bold">Kampus :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="kampus" class="form-control flex-grow-1 mr-2" id="kampus"
                                                name="kampus" maxlength="15"
                                                value="{{ $mahasiswa->kampus->kampus_nama ?? '' }}">
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="kampus_checkbox"
                                                    name="kampus_checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="button" id="btn-simpan" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Jadwal + Dokumen -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-calendar-check"></i> Jadwal Ujian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @php $jadwal = $pendaftaran->jadwal; @endphp
                                    <div class="form-group row align-items-center">
                                        <label for="tanggal" class="col-md-3 col-form-label font-weight-bold">Tanggal :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="tanggal" class="form-control flex-grow-1 mr-2" id="tanggal"
                                                name="tanggal" maxlength="15"
                                                value="{{ $jadwal && $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label for="jam" class="col-md-3 col-form-label font-weight-bold">Jam :
                                        </label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <input type="jam" class="form-control flex-grow-1 mr-2" id="jam"
                                                name="jam" maxlength="15"
                                                value="{{ $jadwal && $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('H:i') : '-' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-file-alt"></i> Dokumen Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-id-card fa-3x text-primary mb-2"></i>
                                            <p class="font-weight-bold mb-1">KTM</p>
                                            {{-- @if ($pendaftaran->$mahasiswa && $pendaftaran->$mahasiswa->file_ktm)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . $pendaftaran->$mahasiswa->file_ktm) }}"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="ktm_checkbox"
                                                            name="ktm_checkbox">
                                                    </div>
                                                </div>
                                            @else --}}
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_ktm)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . $pendaftaran->mahasiswa->file_ktm) }}"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="ktm_checkbox"
                                                            name="ktm_checkbox">
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>

                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-address-card fa-3x text-success mb-2"></i>
                                            <p class="font-weight-bold mb-1">KTP</p>
                                            {{-- @if ($pendaftaran->$mahasiswa && $pendaftaran->$mahasiswa->file_ktp)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . $pendaftaran->$mahasiswa->file_ktp) }}"
                                                        class="btn btn-sm btn-outline-success view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="ktp_checkbox"
                                                            name="ktp_checkbox">
                                                    </div>
                                                </div>
                                            @else --}}
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_ktp)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . $pendaftaran->mahasiswa->file_ktp) }}"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="ktp_checkbox"
                                                            name="ktp_checkbox">
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>

                                        <div class="col-md-4 text-center mb-3">
                                            <i class="fas fa-camera fa-3x text-info mb-2"></i>
                                            <p class="font-weight-bold mb-1">Pas Foto</p>
                                            {{-- @if ($pendaftaran->$mahasiswa && $pendaftaran->$mahasiswa->file_pas_foto)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $pendaftaran->$mahasiswa->file_pas_foto) }}"
                                                        class="btn btn-sm btn-outline-info view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="pas_foto_checkbox" name="pas_foto_checkbox">
                                                    </div>
                                                </div>
                                            @else --}}
                                            @if ($pendaftaran->mahasiswa && $pendaftaran->mahasiswa->file_pas_foto)
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $pendaftaran->mahasiswa->file_pas_foto) }}"
                                                        class="btn btn-sm btn-outline-primary view-document mr-2"
                                                        target="_blank">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="pas_foto_checkbox" name="pas_foto_checkbox">
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diupload</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-history"></i> Timeline Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-point timeline-point-primary">
                                                <i class="fas fa-calendar-plus"></i>
                                            </div>
                                            <div class="timeline-event">
                                                <div class="timeline-heading">
                                                    <h6>Pendaftaran Dibuat</h6>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>{{ $pendaftaran->created_at->translatedFormat('l, d F Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($pendaftaran->status)
                                            @php
                                                $status = $pendaftaran->status->status_nama;
                                                $statusClass = match ($status) {
                                                    'Diterima' => 'success',
                                                    'Ditolak' => 'danger',
                                                    'Diproses' => 'warning',
                                                    'Belum Bayar' => 'secondary',
                                                    'Sudah Bayar' => 'primary',
                                                    default => 'light',
                                                };
                                            @endphp
                                            <div class="timeline-item">
                                                <div class="timeline-point timeline-point-{{ $statusClass }}">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="timeline-event">
                                                    <div class="timeline-heading">
                                                        <h6>Status Diperbarui</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>Status:
                                                            <span class="badge badge-{{ $statusClass }}">
                                                                {{ $status }}
                                                            </span>
                                                        </p>
                                                        <small class="text-muted">
                                                            Terakhir diperbarui:
                                                            {{ $pendaftaran->updated_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> Data pendaftaran tidak ditemukan!
                </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            console.log("READY!");
            $('#btn-simpan').click(function(e) {
                console.log("Tombol diklik!"); 
                e.preventDefault();

                const checkboxes = $('.form-check-input[type="checkbox"]');
                const checkedBoxes = $('.form-check-input[type="checkbox"]:checked');

                // Jika tidak ada checkbox sama sekali
                if (checkboxes.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada data yang divalidasi',
                        text: 'Silakan tambahkan field yang perlu divalidasi.',
                    });
                    return;
                }

                // Jika tidak ada yang dicentang
                if (checkedBoxes.length === 0) {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Anda belum mencentang data yang divalidasi. Yakin ingin melanjutkan?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak Pendaftaran',
                        cancelButtonText: 'Kembali'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(3); // ditolak
                            $('#form-validasi').submit();
                        }
                    });
                    return;
                }

                // Jika semua dicentang
                if (checkedBoxes.length === checkboxes.length) {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Semua data sudah divalidasi. Terima pendaftaran?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Terima Pendaftaran',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(2); // diterima
                            $('#form-validasi').submit();
                        }
                    });
                }
                // Jika hanya sebagian dicentang
                else {
                    Swal.fire({
                        title: 'Validasi Data',
                        text: "Hanya sebagian data yang divalidasi. Apa pendaftaran akan ditolak?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak Pendaftaran',
                        cancelButtonText: 'Kembali'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#status_id').val(3); // ditolak
                            $('#form-validasi').submit();
                        }
                    });
                }
            });
        });
    </script>
@endpush
