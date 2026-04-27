<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\OfferController;

Route::get('/u', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['log.requests'])->group(function () {
    Route::post('/register', [UserController::class, 'Register']);
    Route::post('/login', [UserController::class, 'Login']);

});

Route::middleware(['auth:sanctum','log.requests'])->group(function () {
    Route::post('/logout', [UserController::class, 'Logout']);
    Route::get('/user', [UserController::class, 'showProfile']);
    Route::post('/userprofile/image', [UserProfileController::class, 'ImageUpload']);
    Route::get('/userprofile/{id}', [UserProfileController::class, 'UserProfile']);
    Route::post('/userreview/{id}', [ReviewController::class, 'UserReview']);
    Route::post('/projectreview/{id}', [ReviewController::class, 'ProjectReview']);
    Route::get('/showavaliableusers', [UserController::class, 'ShowAvaliableFreelancers']);
    Route::get('/showprojects', [ProjectController::class, 'index']);
    Route::apiResource('projects', ProjectController::class);
    Route::get('/budgetfilter/{value}', [ProjectController::class, 'BudgetFilter']);
    Route::get('/thismonthfilter', [ProjectController::class, 'ThisMonthFilter']);
    Route::apiResource('offers', OfferController::class)->except(['store']);
    Route::get('resent-email',[UserController::class,'reSentEmail']);

    Route::middleware(['verified'])->group(function () {
         Route::put('/updateuserprofile',[UserProfileController::class,'update']);
         Route::post('offers',[OfferController::class,'store']);
   });
});




Route::get('/logs', function () {
    return \App\Models\RequestLog::latest()->paginate(20);
});
 Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent']);
    })->middleware(['auth', 'throttle:6,1']);


    Route::get('/email-verified', function () {
        return "<h1>Email verified successfully ✅</h1>";
    });
