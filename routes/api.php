<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PublishController;

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

Route::prefix('author')->group(function () {
    Route::get('', [AuthorController::class, 'index']);
    Route::post('', [AuthorController::class, 'store']);
    Route::put('{author_id}', [AuthorController::class, 'update']);
    Route::delete('{author_id}', [AuthorController::class, 'destroy']);
});

Route::prefix('books')->group(function () {
    Route::get('', [BookController::class, 'index']);
    Route::post('', [BookController::class, 'store']);
    Route::put('{book_id}', [BookController::class, 'update']);
    Route::delete('{book_id}', [BookController::class, 'destroy']);
});

Route::prefix('publish')->group(function () {
    Route::get('', [PublishController::class, 'index']);
    Route::post('', [PublishController::class, 'store']);
    Route::put('{publish_id}', [PublishController::class, 'update']);
    Route::delete('{publish_id}', [PublishController::class, 'destroy']);
});
