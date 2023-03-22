<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'admin'], function () {
    Route::post('create', [AuthController::class, 'create']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['authenticated', 'isAdmin']], function () {
        Route::get('logout', [AuthController::class, 'logout']);

        Route::get('user-listing', [UserController::class, 'index']);
        Route::put('user-edit/{uuid}', [UserController::class, 'update']);
        Route::delete('user-delete/{uuid}', [UserController::class, 'destroy']);
    });
});

Route::get('brands', [BrandController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);

Route::get('file/{file}', [FileController::class, 'show']);
Route::post('file', [FileController::class, 'store'])->middleware('authenticated');

Route::get('products', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store'])->middleware('authenticated');
Route::get('product/{product}', [ProductController::class, 'show']);
Route::put('product/{product}', [ProductController::class, 'update'])->middleware('authenticated');
Route::delete('product/{product}', [ProductController::class, 'destroy'])->middleware('authenticated');
