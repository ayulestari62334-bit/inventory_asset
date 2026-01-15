<?php

use Illuminate\Support\Facades\Route;
use Modules\AssetInventory\app\Http\Controllers\AssetInventoryController;
use Modules\AssetInventory\app\Http\Controllers\KategoriBarangController;
Route::resource('assetinventories', AssetInventoryController::class)->names('assetinventory');


Route::get('/kategori-barang', [KategoriBarangController::class, 'index'])->name('kategori.index');
Route::post('/kategori-barang', [KategoriBarangController::class, 'store'])->name('kategori.store');
Route::put('/kategori-barang/{id}', [KategoriBarangController::class, 'update'])->name('kategori.update');
Route::delete('/kategori-barang/{id}', [KategoriBarangController::class, 'destroy'])->name('kategori.destroy');