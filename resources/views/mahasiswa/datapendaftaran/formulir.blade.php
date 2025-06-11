@extends('layouts_mahasiswa.template')

@section('content')
    <div class="container-fluid">
        @php
            $mahasiswa = Auth::user()->load('mahasiswa.pendaftaran')->mahasiswa;
            $pendaftaran = null;
            if ($mahasiswa && $mahasiswa->pendaftaran) {
                $pendaftaran = $mahasiswa->pendaftaran->whereIn('status_id', [1, 2])->first();
            }
        @endphp

        @if (!$pendaftaran)
            <div class="alert alert-warning">
                <i class="fas fa-info-circle"></i> Anda belum memiliki pendaftaran yang diterima.
            </div>
        @else
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-success">
                    <h6 class="m-0 font-weight-bold text-primary text-light">Anda Sudah Pernah Mendaftar TOEIC Yang Pertama
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri: Data Mahasiswa -->
                        <div class="col-md-6">
                            <div class="card border-left-primary mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-user-graduate"></i> Data Mahasiswa
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nim" class="col-md-4 col-form-label font-weight-bold">NIM</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="nim"
                                                value="{{ $mahasiswa->mahasiswa_nim }}" disabled>
                                            @if (!$mahasiswa->mahasiswa_nim)
                                                <small class="text-danger">NIM belum diisi</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nik" class="col-md-4 col-form-label font-weight-bold">NIK</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="nik"
                                                value="{{ $mahasiswa->nik }}" disabled>
                                            @if (!$mahasiswa->nik)
                                                <small class="text-danger">NIK belum diisi</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="col-md-4 col-form-label font-weight-bold">Nama
                                            Lengkap</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="nama"
                                                value="{{ $mahasiswa->mahasiswa_nama }}" disabled>
                                            @if (!$mahasiswa->mahasiswa_nama)
                                                <small class="text-danger">Nama belum diisi</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_telp" class="col-md-4 col-form-label font-weight-bold">No.
                                            Telepon</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="no_telp"
                                                value="{{ $mahasiswa->no_telp }}" disabled>
                                            @if (!$mahasiswa->no_telp)
                                                <small class="text-danger">No. Telepon belum diisi</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label font-weight-bold">Email</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="email"
                                                value="{{ $mahasiswa->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat"
                                            class="col-md-4 col-form-label font-weight-bold">Alamat</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="alamat"
                                                value="{{ $mahasiswa->alamat }}" disabled>
                                            @if (!$mahasiswa->alamat)
                                                <small class="text-danger">Alamat belum diisi</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="prodi" class="col-md-4 col-form-label font-weight-bold">Program
                                            Studi</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="prodi"
                                                value="{{ $mahasiswa->prodi->prodi_nama ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jurusan"
                                            class="col-md-4 col-form-label font-weight-bold">Jurusan</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="jurusan"
                                                value="{{ $mahasiswa->jurusan->jurusan_nama ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kampus"
                                            class="col-md-4 col-form-label font-weight-bold">Kampus</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="kampus"
                                                value="{{ $mahasiswa->kampus->kampus_nama ?? '-' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="https://smartcart.id/sertifikat/english-certification" class="btn btn-info">
                                    <i class="fas fa-info-circle"></i> Daftar Mandiri
                                </a>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Jadwal & Dokumen -->
                        <div class="col-md-6">
                            <!-- Dokumen Section -->
                            <div class="card border-left-primary mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-file-alt"></i> Dokumen Pendukung
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label font-weight-bold">Kartu Tanda Mahasiswa
                                            (KTM)</label>
                                        <div class="col-md-8">
                                            @if ($mahasiswa->file_ktm)
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktm_mahasiswa/' . $mahasiswa->file_ktm) }}"
                                                        target="_blank" class="btn btn-sm btn-success mr-2">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <span class="text-success">Dokumen sudah diunggah</span>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diunggah</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label font-weight-bold">Kartu Tanda Penduduk
                                            (KTP)</label>
                                        <div class="col-md-8">
                                            @if ($mahasiswa->file_ktp)
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ asset('storage/dokumen/ktp_mahasiswa/' . $mahasiswa->file_ktp) }}"
                                                        target="_blank" class="btn btn-sm btn-success mr-2">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <span class="text-success">Dokumen sudah diunggah</span>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diunggah</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label font-weight-bold">Pas Foto (3x4)</label>
                                        <div class="col-md-8">
                                            @if ($mahasiswa->file_pas_foto)
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ asset('storage/dokumen/pas_foto_mahasiswa/' . $mahasiswa->file_pas_foto) }}"
                                                        target="_blank" class="btn btn-sm btn-success mr-2">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <span class="text-success">Dokumen sudah diunggah</span>
                                                </div>
                                            @else
                                                <span class="text-danger">Belum diunggah</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modifikasi Bagian Jadwal -->
                            <div class="card border-left-primary mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-calendar-alt"></i> Jadwal Ujian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if ($pendaftaran && $pendaftaran->jadwal)
                                        <!-- Tampilkan jadwal yang sudah fix -->
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Tanggal Ujian</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal)->translatedFormat('l, d F Y') }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Jam Ujian</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($pendaftaran->jadwal->tanggal)->format('H:i') }} WIB"
                                                    disabled>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Tampilan jika belum memilih jadwal -->
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> Jadwal ujian akan ditentukan setelah
                                            pendaftaran diverifikasi
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card border-left-primary mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="card-title mb-0 text-primary">
                                        <i class="fas fa-file-alt"></i> Status Pendaftaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if ($pendaftaran && $pendaftaran->mahasiswa_id == Auth::user()->mahasiswa->id)
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Status Saat Ini</label>
                                            <div class="col-md-8">
                                                <span
                                                    class="badge badge-{{ $pendaftaran->status_id == 2 ? 'success' : ($pendaftaran->status_id == 3 ? 'danger' : 'warning') }} p-2">
                                                    {{ $pendaftaran->status->status_nama ?? 'Sedang Diproses' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Terakhir
                                                Diperbarui</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $pendaftaran->updated_at ? \Carbon\Carbon::parse($pendaftaran->updated_at)->translatedFormat('l, d F Y H:i:s') : 'Belum pernah diperbarui' }}"
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label font-weight-bold">Tanggal
                                                Pendaftaran</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control"
                                                    value="{{ $pendaftaran->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->translatedFormat('l, d F Y') : '-' }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            Anda belum memiliki data pendaftaran TOEIC.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
