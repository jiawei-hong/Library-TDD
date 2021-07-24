<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('category')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::post('', [CategoryController::class, 'store']);
    Route::put('{category_id}', [CategoryController::class, 'update']);
    Route::delete('{category_id}', [CategoryController::class, 'destroy']);
});

Route::prefix('author')->group(function(){
    Route::get('', [AuthorController::class, 'index']);
    Route::post('', [AuthorController::class, 'store']);
    Route::put('{author_id}', [AuthorController::class, 'update']);
    Route::delete('{author_id}', [AuthorController::class, 'destroy']);
});
