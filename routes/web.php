<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PendaftaranController;
use App\Models\PendaftaranModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/help', [AdminController::class, 'help'])->name('help');
    Route::get('/jadwal-kuota', [JadwalController::class, 'jadwalKuota'])->name('admin.jadwal-kuota');
    Route::get('/data-pendaftaran', [PendaftaranController::class, 'dataPendaftaran'])->name('admin.data-pendaftaran');
});

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function() {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/help', [MahasiswaController::class, 'help'])->name('help');
});
