<!-- Edit Profil -->
<div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Edit Profil</h5>
        </div>
        <div class="card-body">
            <form>
                @auth
                    @if (auth()->user()->admin)
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name"
                                value="{{ auth()->user()->admin->admin_nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ auth()->user()->admin->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone"
                                value="{{ auth()->user()->admin->no_telp }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat"
                                value="{{ auth()->user()->admin->alamat }}">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username"
                                value="{{ auth()->user()->admin->username }}">
                        </div>
                    @endif
                @endauth
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<!-- Ubah Password -->
<div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Ubah Password</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Password Sekarang</label>
                    <input type="password" class="form-control" id="currentPassword">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="newPassword">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="confirmPassword">
                </div>
                <button type="submit" class="btn btn-success">Ubah Password</button>
            </form>
        </div>
    </div>
</div>

