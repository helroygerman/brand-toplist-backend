<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ToplistController;
use App\Http\Controllers\Api\BrandController;

// Use the API prefix for versioning (e.g., v1) the best practice for API development
Route::prefix('v1')->group(function () {
    // Define routes for Toplists and Brands
   // Route::get('/toplists', 'ToplistController@index');
    //Route::get('/toplists/{country_code}', 'ToplistController@show');
   // Route::post('/toplists', 'ToplistController@store');
    //Route::put('/toplists/{country_code}', 'ToplistController@update');
   Route::get('/toplist', [ToplistController::class, 'index']);
   
   Route::get('/brands', [BrandController::class,'index']);
    Route::get('/brands/{brand_id}',  [BrandController::class,'show']);
    Route::post('/brands', [BrandController::class,'store']);
    Route::put('/brands/{brand_id}', [BrandController::class,'update']);
    Route::delete('/brands/{brand_id}', [BrandController::class,'destroy']);
});
// Route::get('/brands', [BrandController::class,'index']);

?>