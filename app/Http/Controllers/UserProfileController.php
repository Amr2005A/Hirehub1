<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserProfileController extends Controller
{
    public function ImageUpload(Request $request)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $userProfile = Auth::user()->profile;

    if ($request->hasFile('image')) {

        if ($userProfile->image && $userProfile->image != 'images/default.jpg') {
            Storage::disk('public')->delete($userProfile->image);
        }

        $path = $request->file('image')->store('users', 'public');
    } else {
        $path = 'images/defult.jpg';
    }

    $url = Storage::url($path);
    $userProfile->image = $url;
    $userProfile->save();

    return response()->json([
        'message' => 'Image processed successfully',
        'image_path' => $url,
    ], 200);
}

    public function UserProfile($id)
{
    $AvarageRating = User::with('reviews')
        ->findOrFail($id)
        ->reviews
        ->avg('rating');

    $userInfo = User::with(['profile' => function ($q) {
        $q->select('user_id', 'image','intry_date');
    }])
    ->select('id', 'name', 'email')
        ->findOrFail($id);

    return response()->json([
        'user_info' => $userInfo,
        'average_rating' => $AvarageRating . '⭐',
        'member since' => $userInfo->profile->intry_date,
    ], 200);

}

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
