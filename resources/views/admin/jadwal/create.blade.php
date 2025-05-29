<form action="{{ route('admin.jadwal.store_ajax') }}" method="POST" id="form-tambah">
    @csrf

    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal"
                                placeholder="Masukkan Tanggal" required>
                            <small id="error-tanggal" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="kuota" name="kuota"
                                placeholder="Masukkan kuota" required>
                            <small id="error-kuota" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $("#form-tambah").validate({
                rules: {
                    tanggal: {
                        required: true
                    },
                    kuota: {
                        required: true,
                        min: 1
                    }
                },
                messages: {
                    tanggal: {
                        required: "Tanggal wajib diisi"
                    },
                    kuota: {
                        required: "Kuota wajib diisi",
                        min: "Kuota minimal 1"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: $(form).serialize(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#modal-master').modal('hide');

                                console.log("Response received:",
                                    response); // Debugging line

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Redirect after Swal closes
                                    if (response.redirect_url) {
                                        window.location.href = response
                                            .redirect_url;
                                    }
                                });

                                // Optional: Reload DataTables if needed
                                if (typeof dataJadwal !== 'undefined') {
                                    dataJadwal.ajax.reload(null, false);
                                }
                            } else {
                                $('.error-text').text('');
                                $.each(response.errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan server'
                            });
                        }
                    });
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
