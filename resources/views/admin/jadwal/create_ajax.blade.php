<form id="formJadwal">
    @csrf
    {{-- <div class="modal-dialog modal-lg"> --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="tanggal">Tanggal & Jam Ujian <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="tanggal" class="form-control" 
                        placeholder="Masukkan Tanggal" required>
                    <small class="text-danger" id="error-tanggal"></small>
                </div>
                <div class="form-group">
                    <label for="kuota">Kuota Peserta <span class="text-danger">*</span></label>
                    <input type="number" name="kuota" class="form-control" min="1" 
                        placeholder="Masukkan Kuota" required>
                    <small class="text-danger" id="error-kuota"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    {{-- </div> --}}
</form>

<script>
    $('#formJadwal').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        $('.text-danger').text('');

        $.ajax({
            url: "{{ route('admin.jadwal.store_ajax') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                if (res.status) {
                    $('#myModal').modal('hide');
                    dataJadwal.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: res.message
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error-${field}`).text(errors[field][0]);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server'
                    });
                }
            }
        });
    });
</script>