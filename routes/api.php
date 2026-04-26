<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/u', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'Register']);
Route::post('/login', [UserController::class, 'Login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'Logout']);
    Route::get('/user', [UserController::class, 'showProfile']);
    Route::post('/userprofile/image', [UserProfileController::class, 'ImageUpload']);
    Route::get('/userprofile/{id}', [UserProfileController::class, 'UserProfile']);
    Route::post('/userreview/{id}', [ReviewController::class, 'UserReview']);
    Route::post('/projectreview/{id}', [ReviewController::class, 'ProjectReview']);
    Route::get('/showavaliableusers', [UserController::class, 'ShowAvaliableFreelancers']);
    Route::get('/showprojects', [ProjectController::class, 'index']);
    Route::get('/showproject/{project}', [ProjectController::class, 'show']);
    Route::post('/createproject', [ProjectController::class, 'store']);
    Route::put('/updateproject/{project}', [ProjectController::class, 'update']);
    Route::delete('/deleteproject/{project}', [ProjectController::class, 'destroy']);
    Route::get('/budgetfilter/{value}', [ProjectController::class, 'BudgetFilter']);
    Route::get('allprojects', [ProjectController::class, 'getAllProjects']);
    Route::get('/thismonthfilter', [ProjectController::class, 'ThisMonthFilter']);
});




Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent']);
})->middleware(['auth', 'throttle:6,1']);


Route::get('/email-verified', function () {
    return "<h1>Email verified successfully ✅</h1>";
});
