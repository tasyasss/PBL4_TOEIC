<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// route CRUD users
Route::prefix(('users'))->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/list', [UsersController::class, 'list']);
    Route::get('/create', [UsersController::class, 'create']);
    Route::post('/store', [UsersController::class, 'store']);
    Route::get('/{id}/show_ajax', [UsersController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [UsersController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [UsersController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [UsersController::class, 'delete_ajax']);
});

// route CRUD roles
Route::prefix(('roles'))->group(function () {
    Route::get('/', [RolesController::class, 'index']);
    Route::get('/list', [RolesController::class, 'list']);
    Route::get('/create', [RolesController::class, 'create']);
    Route::post('/store', [RolesController::class, 'store']);
    Route::get('/{id}/show_ajax', [RolesController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [RolesController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [RolesController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [RolesController::class, 'delete_ajax']);
});

// route CRUD mahasiswa
Route::prefix(('mahasiswa'))->group(function () {
    Route::get('/', [MahasiswaController::class, 'index']);
    Route::get('/list', [MahasiswaController::class, 'list']);
    Route::get('/create', [MahasiswaController::class, 'create']);
    Route::post('/store', [MahasiswaController::class, 'store']);
    Route::get('/{id}/show_ajax', [MahasiswaController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [MahasiswaController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [MahasiswaController::class, 'update_ajax']);
    Route::delete('/{id}/delete_ajax', [MahasiswaController::class, 'delete_ajax']);
});