<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PendaftaranController;
use App\Models\PendaftaranModel;


Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/help', [AdminController::class, 'help'])->name('help');
    Route::get('/jadwal-kuota', [JadwalController::class, 'jadwalKuota'])->name('admin.jadwal-kuota');
});

    // Route::middleware('authorize:MHS')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/help', [MahasiswaController::class, 'help'])->name('help');
    });
// });