<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FaqController;

// route ini boleh diakses tanpa login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// route di bawah ini butuh login/token
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/scholarships', [ScholarshipController::class, 'index']);
    Route::get('/scholarships/{id}', [ScholarshipController::class, 'show']);
    Route::post('/scholarships', [ScholarshipController::class, 'store']);
    Route::put('/scholarships/{id}', [ScholarshipController::class, 'update']);
    Route::delete('/scholarships/{id}', [ScholarshipController::class, 'destroy']);

    Route::get('/bookmarks', [BookmarkController::class, 'index']);
    Route::post('/bookmarks', [BookmarkController::class, 'store']);
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy']);

    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    Route::get('/faqs', [FaqController::class, 'index']);
    Route::post('/faqs', [FaqController::class, 'store']);
});