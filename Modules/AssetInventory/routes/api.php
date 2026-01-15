<?php

use Illuminate\Support\Facades\Route;
use Modules\AssetInventory\Http\Controllers\AssetInventoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('assetinventories', AssetInventoryController::class)->names('assetinventory');
});
