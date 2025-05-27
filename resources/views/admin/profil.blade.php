@extends('layouts_admin.template')

@section('title', 'Profil Admin')

@section('content')
@include('layouts_admin.breadcrumb', ['breadcrumb' => 'Profil Admin'])

    <div class="container-fluid mt-4">
        <!-- Header Profile -->
        <div class="row">
            <div class="col-lg-12 position-relative">
                <!-- Banner -->
                <img src="{{ asset('landingpage/img/bg.png') }}" class="img-fluid w-100" alt="Banner Image">

                <!-- Foto Profil -->
                <div class="profile-picture">
                    <img src="{{ asset('landingpage/img/team-1.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle shadow">
                </div>
            </div>
        </div>

        <!-- Tab Menu -->
        <ul class="nav nav-tabs mt-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Detail Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editProfile-tab" data-bs-toggle="tab" href="#editProfile" role="tab">Edit Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="changePassword-tab" data-bs-toggle="tab" href="#changePassword" role="tab">Ubah Password</a>
            </li>
        </ul>

        <!-- Isi Tab -->
        <div class="tab-content mt-3" id="profileTabsContent">
            <!-- Overview -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Detail Profil</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>NIP:</strong> 4638327827</p>
                        <p><strong>Nama:</strong> Ivan Rizal</p>
                        <p><strong>Email:</strong> Ivan@example.com</p>
                        <p><strong>Nomor Telepon:</strong> 87987897892</p>
                        <p><strong>Alamat:</strong> Jalan Raya No. 123</p>
                        <p><strong>Username:</strong> ipan123</p>
                    </div>
                </div>
            </div>

            <!-- Edit Profil -->
            <div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Edit Profil</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="Ivan Rizal">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="ivan@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone" value="87987897892">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" value="Jalan Raya No. 123">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" value="ipan123">
                            </div>
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
        </div>
    </div>
@endsection

<style>
.profile-picture {
    position: absolute;
    top: 50%; /* posisikan di tengah vertikal banner */
    left: 50%; /* posisikan di tengah horizontal */
    transform: translate(-50%, -50%); /* tepat di tengah */
    width: 140px;
    height: 140px;
    border: 5px solid white;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    background: url{{asset('landingpage/img/bg.png')}};
    z-index: 10;

}

</style>
@section('styles')
<style>
   
   
    .document-box {
        position: relative;
        width: 259px;
        height: 304px;
        background: white;
        border: 1px solid #AEB1B6;
        padding: 10px;
    }

    .document-box img {
    width: 100%; /* Adjust to 100% to take full width of the container */
    height: auto; /* Maintain aspect ratio */
    margin: 0 auto;
    display: block;
}


    
</style>
@endsection