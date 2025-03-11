<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Models\UserModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
// user tambah
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// user ubah
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// user delete
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);