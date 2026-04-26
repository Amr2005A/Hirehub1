<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // تحقق من ال hash
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return response()->json(['message' => 'Invalid verification link'], 403);
    }

    if ($user->hasVerifiedEmail()) {
        return redirect(env('FRONTEND_URL') . '/email-verified?status=already');
    }

    $user->markEmailAsVerified();

    return view('email-verified');

})->middleware('signed')->name('verification.verify');
