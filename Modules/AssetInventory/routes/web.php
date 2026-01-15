<?php

use Illuminate\Support\Facades\Route;
use Modules\AssetInventory\Http\Controllers\AssetInventoryController;
use App\Http\Controllers\KategoriController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('assetinventories', AssetInventoryController::class)->names('assetinventory');
});

Route::get('/contoh', [KategoriController::class, 'index'])
    ->name('contoh.index');