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

Route::get('/', [WelcomeController::class, 'index'])->name('landingpage');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware('auth')->group(function () {
//     Route::middleware('authorize:ADM')->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/help', [AdminController::class, 'help'])->name('help');    

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('profil', [Profile_ADMController::class, 'profil'])->name('profil');
        });

        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('/', [DataMahasiswaController::class, 'index'])->name('index');
            Route::post('/list', [DataMahasiswaController::class, 'list']);      // menampilkan data  dlm json utk datatables
            Route::get('/create_ajax', [DataMahasiswaController::class, 'create_ajax']);   // menampilkan halaman form tambah  AJAX
            Route::post('/store_ajax', [DataMahasiswaController::class, 'store_ajax']);         // menampilkan data  baru AJAX
            // Route::get('/{id}', [DataMahasiswaController::class, 'show']);       // menampilkan detail user
            // Route::get('/{id}/edit_ajax', [DataMahasiswaController::class, 'edit_ajax']);     // menampilkan form perubahan data user AJAX
            // Route::put('/{id}/update_ajax', [DataMahasiswaController::class, 'update_ajax']);     // menyimpan perubahan data user AJAX
            // Route::get('/{id}/delete_ajax', [DataMahasiswaController::class, 'confirm_ajax']); // menampilkan form confirm delete AJAX
            // Route::delete('/{id}/delete_ajax', [DataMahasiswaController::class, 'delete_ajax']); // menghapus data user AJAX
            // Route::get('/import',[DataMahasiswaController::class, 'import']); // ajax form upload excel
            // Route::post('/import_ajax', [DataMahasiswaController::class, 'import_ajax']); //ajax import excel
            // Route::get('/export_excel',[DataMahasiswaController::class, 'export_excel']); // export excel
            // Route::get('/export_pdf',[DataMahasiswaController::class, 'export_pdf']); // export pdf
        });

        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [Pendaftaran_ADMController::class, 'index'])->name('index');
            Route::post('/list', [Pendaftaran_ADMController::class, 'list']);      // menampilkan data user dlm json utk datatables
        });
        
        Route::prefix('jadwal')->name('jadwal.')->group(function () {
            Route::get('/', [JadwalController::class, 'index'])->name('index');
            Route::post('/list', [JadwalController::class, 'list']);      // menampilkan data user dlm json utk datatables
        });

        
    });

    // Route::middleware('authorize:MHS')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/help', [MahasiswaController::class, 'help'])->name('help');

        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('profil', [Profile_MHSController::class, 'index'])->name('profil');
        });

      

        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/', [Pendaftaran_MHSController::class, 'index'])->name('index');
        });
    });