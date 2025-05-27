<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\Pendaftaran_ADMController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Pendaftaran_MHSController;

Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'authorize:ADM'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/help', [AdminController::class, 'help'])->name('admin.help');

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [DataMahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::post('/list', [DataMahasiswaController::class, 'list'])->name('admin.mahasiswa.list');
        Route::get('/create_ajax', [DataMahasiswaController::class, 'create_ajax'])->name('admin.mahasiswa.create_ajax');
        Route::post('/store_ajax', [DataMahasiswaController::class, 'store_ajax'])->name('admin.mahasiswa.store_ajax');
    });

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_ADMController::class, 'index'])->name('admin.pendaftaran.index');
        Route::post('/list', [Pendaftaran_ADMController::class, 'list'])->name('admin.pendaftaran.list');
    });

    Route::prefix('jadwal')->group(function () {
        Route::get('/', [JadwalController::class, 'index'])->name('admin.jadwal.index');
        Route::post('/list', [JadwalController::class, 'list'])->name('admin.jadwal.list');
    });
});

Route::middleware(['auth', 'authorize:MHS'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/help', [MahasiswaController::class, 'help'])->name('mahasiswa.help');

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', [Pendaftaran_MHSController::class, 'index'])->name('mahasiswa.pendaftaran.index');
    });
});