<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| GUEST (BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('login.post');
});

/*
|--------------------------------------------------------------------------
| AUTH (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | MASTER DIVISI
    |--------------------------------------------------------------------------
    */
    Route::prefix('divisi')->name('divisi.')->group(function () {
        Route::get('/', [DivisiController::class, 'index'])->name('index');
        Route::post('/', [DivisiController::class, 'store'])->name('store');
        Route::put('/{id}', [DivisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [DivisiController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | DATA KARYAWAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('index');
        Route::post('/', [KaryawanController::class, 'store'])->name('store');
        Route::put('/{id}', [KaryawanController::class, 'update'])->name('update');
        Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA BARANG (NON MODULE)
    |--------------------------------------------------------------------------
    */
    Route::prefix('barang')->name('barang.')->group(function () {

        Route::get('/', [BarangController::class, 'index'])
            ->name('index');

        Route::post('/', [BarangController::class, 'store'])
            ->name('store');

        Route::put('/{id}', [BarangController::class, 'update'])
            ->name('update');

        Route::delete('/{id}', [BarangController::class, 'destroy'])
            ->name('destroy');

        /*
        | Optional future features (siap pakai nanti)
        */
        // Route::post('/hapus-semua', [BarangController::class,'hapusSemua'])->name('hapus.semua');
        // Route::get('/export', [BarangController::class,'export'])->name('export');
        // Route::get('/qr/{id}', [BarangController::class,'qr'])->name('qr');
    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
