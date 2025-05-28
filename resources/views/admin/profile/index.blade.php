@extends('layouts_admin.template')

@section('title', 'Profil Admin')

@section('content')
    <div class="container-fluid mt-4">
        <!-- Header Profile -->
        <div class="row">
            <div class="col-lg-12 position-relative">
                <!-- Banner -->
                <img src="{{ asset('landingpage/img/bg.png') }}" class="img-fluid w-100" alt="Banner Image"
                    style="opacity: 0.8; height: 200px; object-fit: cover;">

                <!-- Foto Profil -->
                <div class="profile-picture">
                    <img src="{{ asset('landingpage/img/team-1.jpg') }}" alt="Profile Picture"
                        class="img-fluid rounded-circle shadow">
                </div>
            </div>
        </div>

        <!-- Tab Menu -->
        <ul class="nav nav-tabs mt-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab">Detail
                    Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="editProfile-tab" data-bs-toggle="tab" href="#editProfile" role="tab">Edit
                    Profil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="changePassword-tab" data-bs-toggle="tab" href="#changePassword" role="tab">Ubah
                    Password</a>
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
                        @auth
                            @if (auth()->user()->admin)
                                <p><strong>NIP:</strong> {{ auth()->user()->admin->admin_nip }}</p>
                                <p><strong>Nama:</strong> {{ auth()->user()->admin->admin_nama }}</p>
                                <p><strong>Email:</strong> {{ auth()->user()->admin->email }}</p>
                                <p><strong>Nomor Telepon:</strong> {{ auth()->user()->admin->no_telp }}</p>
                                <p><strong>Alamat:</strong> {{ auth()->user()->admin->alamat }}</p>
                                <p><strong>Username:</strong> {{ auth()->user()->admin->username }}</p>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            @include('admin.profile.edit')
        </div>
    </div>
@endsection

<style>
    .profile-picture {
        position: absolute;
        top: 50%;
        /* posisikan di tengah vertikal banner */
        left: 50%;
        /* posisikan di tengah horizontal */
        transform: translate(-50%, -50%);
        /* tepat di tengah */
        width: 140px;
        height: 140px;
        border: 5px solid white;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        background: url{{ asset('landingpage/img/bg.png') }};
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
            width: 100%;
            /* Adjust to 100% to take full width of the container */
            height: auto;
            /* Maintain aspect ratio */
            margin: 0 auto;
            display: block;
        }
    </style>
@endsection
