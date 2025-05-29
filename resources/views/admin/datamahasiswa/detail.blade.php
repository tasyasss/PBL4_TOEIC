<!-- Modal Detail Mahasiswa -->
<div class="modal-header">
    <h5 class="modal-title">Detail Mahasiswa</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table">
        <tr><th>NIM</th><td>{{ $mahasiswa->mahasiswa_nim }}</td></tr>
        <tr><th>Nama</th><td>{{ $mahasiswa->mahasiswa_nama }}</td></tr>
        <tr><th>Alamat</th><td>{{ $mahasiswa->alamat }}</td></tr>
        <tr><th>No. Telepon</th><td>{{ $mahasiswa->no_telp }}</td></tr>
        <tr><th>Email</th><td>{{ $mahasiswa->email }}</td></tr>
        <tr><th>Prodi</th><td>{{ $mahasiswa->prodi->prodi_nama ?? '-' }}</td></tr>
        <tr>
            <th>Aksi</th>
            <td>
                <!-- Tombol Reset Password yang memanggil fungsi JavaScript -->
                <button type="button" onclick="resetPassword({{ $mahasiswa->id }})" class="btn btn-danger btn-sm">Reset Password</button>
            </td>
        </tr>
    </table>
</div>

@push('js')
    <script>
        // Fungsi untuk mereset password mahasiswa
        function resetPassword(id) {
    if (confirm("Yakin reset password ke 12345?")) {
        // Pastikan URL yang dikirim sesuai dengan route di web.php
        $.post('/admin/mahasiswa/' + id + '/reset_password', {
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token untuk keamanan
        }, function(response) {
            alert(response.message);
        }).fail(function(xhr) {
            alert("Terjadi kesalahan: " + xhr.responseText);  // Menangani kesalahan jika ada
        });
    }
}

    </script>
@endpush