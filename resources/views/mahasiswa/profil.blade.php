@extends('layouts_mahasiswa.template')

@section('title', 'Profile Mahasiswa')

@section('content')
    <!-- Memasukkan Breadcrumb -->
    @include('layouts_mahasiswa.breadcrumb', ['breadcrumb' => 'Profil Mahasiswa'])

    <div class="container-fluid mt-4">
        <!-- Profile Header Section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile-header">
                
                    <!-- Banner Image -->
                    <img src="{{ asset('landingpage/img/bg.png') }}" class="img-fluid" alt="Banner Image">

                    <!-- Profile Picture (Tengah Banner) -->
                    <div class="profile-picture">
                        <img src="{{ asset('landingpage/img/team-1.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle shadow">
                    </div>
                </div>

                <!-- Nama dan Role -->
                
            </div>
        </div>

        <!-- Profile Tabs -->
        <ul class="nav nav-tabs mt-3" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Detail Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editProfile-tab" data-bs-toggle="tab" href="#editProfile" role="tab">Edit Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editDocument-tab" data-bs-toggle="tab" href="#editDocument" role="tab">Edit Dokumen</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="changePassword-tab" data-bs-toggle="tab" href="#changePassword" role="tab">Ubah Password</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="profileTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Detail profil</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>NIM:</strong> 4638327827</p>
                        <p><strong>Nama:</strong> Zacky Yudha</p>
                        <p><strong>Email:</strong> jak231@example.com</p>
                        <p><strong>Nomor Telepon:</strong> 87987897892</p>
                        <p><strong>Alamat:</strong> Jalan Raya No. 123</p>
                        <p><strong>Username:</strong> jak123</p>
                    </div>
                </div>
            </div>

           <!-- Edit Document Tab -->
<div class="tab-pane fade" id="editDocument" role="tabpanel" aria-labelledby="editDocument-tab">
    <div class="container mt-3">
        <div class="row">
            <!-- Document Box 1 -->
            <div class="col-md-4 mb-3">
                <div class="document-box">
                    <img src="{{ asset('landingpage/img/logofile2.jpg') }}" class="img-fluid" alt="Document Image">
                    <div class="actions">
                        <button class="btn btn-primary">Lihat</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Document Box 2 -->
            <div class="col-md-4 mb-3">
                <div class="document-box">
                    <img src="{{ asset('landingpage/img/logofile2.jpg') }}" class="img-fluid" alt="Document Image">
                    <div class="actions">
                        <button class="btn btn-primary">Lihat</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Document Box 3 -->
            <div class="col-md-4 mb-3">
                <div class="document-box">
                    <img src="{{ asset('landingpage/img/logofile2.jpg') }}" class="img-fluid" alt="Document Image">
                    <div class="actions">
                        <button class="btn btn-primary">Lihat</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


            <!-- Edit Profile Tab -->
            <div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Edit Profil</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" value="Zacky Yudha">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="jak231@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telefon</label>
                                <input type="text" class="form-control" id="phone" value="87987897892">
                            </div>
                             <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat </label>
                                <input type="alamat" class="form-control" id="alamat" value="Jalan Raya No. 123">
                            </div>
                             <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" class="form-control" id="username" value="jak123">
                            </div>

                            <button type="submit" class="btn btn-success">Simpan perubahan</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Change Password Tab -->
            <div class="tab-pane fade" id="changePassword" role="tabpanel" aria-labelledby="changePassword-tab">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>ubah password</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">password sekarang</label>
                                <input type="password" class="form-control" id="currentPassword">
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">password baru</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">konfirmasi password baru</label>
                                <input type="password" class="form-control" id="confirmPassword">
                            </div>
                            <button type="submit" class="btn btn-success">ubah password</button>
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


    .actions {
        display: flex;
        justify-content: space-around;
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
    }

    .actions button {
        width: 63px;
        height: 32px;
        border-radius: 5px;
    }

    .actions .btn-primary {
        background-color: #4E73DF;
        color: white;
    }

    .actions .btn-warning {
        background-color: #FFC107;
        color: white;
    }

    .actions .btn-danger {
        background-color: #E74A3B;
        color: white;
    }
</style>
@endsection