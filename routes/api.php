<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReviewController;

Route::get('/u', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'Register']);
Route::post('/login', [UserController::class, 'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'Logout']);
    Route::get('/user', [UserController::class, 'showProfile']);
    Route::post('/userprofile/image', [UserProfileController::class, 'ImageUpload']);
    Route::get('/userprofile', [UserProfileController::class, 'UserProfile']);
    Route::post('/review', [ReviewController::class, 'UserReview']);
});


