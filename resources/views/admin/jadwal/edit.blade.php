<form id="form-edit" method="POST" action="{{ route('admin.jadwal.update_ajax', $jadwal->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="jadwal-id" value="{{ $jadwal->id }}">

    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal"
                                value="{{ date('Y-m-d\TH:i', strtotime($jadwal->tanggal)) }}" required>
                            <small id="error-tanggal" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="kuota" name="kuota"
                                placeholder="Masukkan kuota" value="{{ $jadwal->kuota }}" required>
                            <small id="error-kuota" class="error-text form-text text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</form>

{{-- @push('css')
@endpush --}}

@push('js')
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
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
                submitHandler: function(form) {
                    let id = $('#jadwal-id').val();
                    form.action = `/admin/jadwal/${id}/update_ajax`;
                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataKategori.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.error, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal mengupdate data. Silakan coba lagi.'
                            });
                        }
                    });
                    return false;
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