<div class="modal-header">
    <h5 class="modal-title">Detail Pendaftaran</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-borderless">
        <tr>
            <th class="text-right">NIM</th>
            <td>{{ $pendaftaran->mahasiswa->mahasiswa_nim ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Nama</th>
            <td>{{ $pendaftaran->mahasiswa->mahasiswa_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Program Studi</th>
            <td>{{ $pendaftaran->mahasiswa->prodi->prodi_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Jurusan</th>
            <td>{{ $pendaftaran->mahasiswa->jurusan->jurusan_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Kampus</th>
            <td>{{ $pendaftaran->mahasiswa->kampus->kampus_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Tanggal Pendaftaran</th>
            <td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th class="text-right">Status</th>
            <td>{{ $pendaftaran->status->status_nama ?? '-' }}</td>
        </tr>
        <tr>
            <th class="text-right">Jadwal</th>
            <td>{{ $pendaftaran->jadwal->jadwal_nama ?? '-' }}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>

<script>
    $(document).on('click', '[data-dismiss="modal"]', function() {
        $('#modalContainer').modal('hide');
    });
</script>
