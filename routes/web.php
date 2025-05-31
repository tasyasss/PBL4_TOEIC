<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Profile_ADMController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\Pendaftaran_ADMController;
use App\Http\Controllers\JadwalController;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Profile_MHSController;
use App\Http\Controllers\Pendaftaran_MHSController;
use App\Http\Controllers\KampusController;

Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'authorize:ADM'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/help', [AdminController::class, 'help'])->name('admin.help');

    Route::prefix('profile')->group(function () {
        Route::get('/', [Profile_ADMController::class, 'index'])->name('admin.profile.index');
        Route::post('/update', [Profile_ADMController::class, 'update'])->name('admin.profile.update');
        Route::post('/change_password', [Profile_ADMController::class, 'change_password'])->name('admin.profile.change_password');
        Route::post('/update_picture', [Profile_ADMController::class, 'updateProfilePicture'])->name('admin.profile.update_picture');
    });

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [DataMahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::post('/list', [DataMahasiswaController::class, 'list'])->name('admin.mahasiswa.list');
        Route::get('/create_ajax', [DataMahasiswaController::class, 'create_ajax'])->name('admin.mahasiswa.create_ajax');
        Route::post('/store_ajax', [DataMahasiswaController::class, 'store_ajax'])->name('admin.mahasiswa.store_ajax');
        Route::get('/edit_ajax/{id}', [DataMahasiswaController::class, 'edit_ajax'])->name('admin.mahasiswa.edit_ajax');
        Route::post('/update_ajax/{id}', [DataMahasiswaController::class, 'update_ajax'])->name('admin.mahasiswa.update_ajax');
        Route::get('/delete_ajax/{id}', [DataMahasiswaController::class, 'delete_ajax'])->name('admin.mahasiswa.delete_ajax');
        Route::get('/{id}/show_ajax', [DataMahasiswaController::class, 'show_ajax'])->name('admin.mahasiswa.show_ajax');
        Route::post('/{id}/reset_password', [DataMahasiswaController::class, 'resetPassword'])->name('admin.mahasiswa.resetPassword');
    });

        Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_ADMController::class, 'index'])->name('admin.pendaftaran.index');
        Route::post('/list', [Pendaftaran_ADMController::class, 'list'])->name('admin.pendaftaran.list');
        Route::post('store_ajax', [Pendaftaran_ADMController::class, 'store_ajax'])->name('admin.pendaftaran.store_ajax');
        Route::get('{id}/show_ajax', [Pendaftaran_ADMController::class, 'show_ajax'])->name('admin.pendaftaran.show_ajax');

    });

    Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::post('/list', [JadwalController::class, 'list'])->name('admin.jadwal.list');
    Route::get('/create_ajax', [JadwalController::class, 'create_ajax'])->name('admin.jadwal.create_ajax');
    Route::post('/store_ajax', [JadwalController::class, 'store_ajax'])->name('admin.jadwal.store_ajax');
    Route::get('/edit_ajax/{id}', [JadwalController::class, 'edit_ajax'])->name('admin.jadwal.edit_ajax');
    Route::put('/{id}/update_ajax', [JadwalController::class, 'update_ajax'])->name('admin.jadwal.update_ajax');
    Route::delete('/delete_ajax/{id}', [JadwalController::class, 'delete_ajax'])->name('admin.jadwal.delete_ajax');
    });

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('kampus', [KampusController::class, 'index'])->name('kampus.index');
    Route::post('kampus/list', [KampusController::class, 'list'])->name('kampus.list');
    Route::get('kampus/create_ajax', [KampusController::class, 'create_ajax'])->name('kampus.create_ajax');
    Route::post('kampus/store_ajax', [KampusController::class, 'store_ajax'])->name('kampus.store_ajax');
    Route::get('kampus/edit_ajax/{id}', [KampusController::class, 'edit_ajax'])->name('kampus.edit_ajax');
    Route::post('kampus/update_ajax/{id}', [KampusController::class, 'update_ajax'])->name('kampus.update_ajax');
    Route::get('kampus/delete_ajax/{id}', [KampusController::class, 'delete_ajax'])->name('kampus.delete_ajax');
});


Route::middleware(['auth', 'authorize:MHS'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/help', [MahasiswaController::class, 'help'])->name('mahasiswa.help');

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_MHSController::class, 'index'])->name('mahasiswa.pendaftaran.index');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [Profile_MHSController::class, 'index'])->name('mahasiswa.profile.index');
        Route::post('/update', [Profile_MHSController::class, 'update'])->name('mahasiswa.profile.update');
        Route::get('/change_password', [Profile_MHSController::class, 'change_password'])->name('mahasiswa.profile.change_password');
        Route::post('/change_password', [Profile_MHSController::class, 'change_password'])->name('mahasiswa.profile.change_password');
        Route::post('/update_picture', [Profile_MHSController::class, 'updateProfilePicture'])->name('mahasiswa.profile.update_picture');
        Route::post('/update_dokumen', [Profile_MHSController::class, 'updateDokumen'])->name('mahasiswa.profile.update_dokumen');
    });
});