<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'admin'], function() {
    Route::post('create', [AuthController::class, 'create']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['authenticated', 'isAdmin']], function() {
        Route::get('logout', [AuthController::class, 'logout']);

        Route::get('user-listing', [UserController::class, 'index']);
        Route::put('user-edit/{uuid}',[UserController::class, 'edit']);
        Route::delete('user-delete/{uuid}',[UserController::class, 'delete']);
    });

});

Route::group(['middleware' => ['authenticated']], function() {
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('files', FileController::class);

    Route::apiResource('products', ProductController::class);
});

