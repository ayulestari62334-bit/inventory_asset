<?php

use Illuminate\Support\Facades\Route;
use Modules\AssetInventory\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek', function () {
    return 'ROUTE UTAMA OK';
});

Route::get('/kategori', [KategoriController::class, 'index'])
    ->name('kategori.index');
