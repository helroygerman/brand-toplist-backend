<?php

/**
 * Author: German SONKOUE
 * Version: 1.0.0
 * Date: 2025-06-14
 * Description: This file defines the API routes for the Brand Toplist application.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ToplistController;
use App\Http\Controllers\Api\BrandController;

// Use the API prefix for versioning (e.g., v1) the best practice for API development
Route::prefix('v1')->group(function () {
    Route::get('/toplist', [ToplistController::class, 'index']);
   
   Route::get('/brands', [BrandController::class,'index']);
    Route::get('/brands/{brand_id}',  [BrandController::class,'show']);
    Route::post('/brands', [BrandController::class,'store']);
    Route::put('/brands/{brand_id}', [BrandController::class,'update']);
    Route::delete('/brands/{brand_id}', [BrandController::class,'destroy']);
});


?>