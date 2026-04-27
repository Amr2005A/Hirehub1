<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserResource;
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
    public function update(UpdateUserProfileRequest $request)
    {
        $authUser    = Auth::user();
        $userProfile = $authUser->profile;

        // تحديث بيانات الـ user الرئيسية
        $authUser->update([
            'name'    => $request->name    ?? $authUser->name,
            'city_id' => $request->city_id ?? $authUser->city_id,
        ]);

        // تحديث بيانات الـ profile
        $userProfile->update([
            'personal_info'       => $request->personal_info       ?? $userProfile->personal_info,
            'hourly_price'        => $request->hourly_price        ?? $userProfile->hourly_price,
            'phone_number'        => $request->phone_number        ?? $userProfile->phone_number,
            'availability_status' => $request->availability_status ?? $userProfile->availability_status,
            'portfolio_link'      => $request->portfolio_link      ?? $userProfile->portfolio_link,
        ]);

                if ($request->has('skills') && is_array($request->skills)) {
                        $syncData = [];
                        foreach ($request->skills as $skillEntry) {
                        if (isset($skillEntry['skill_id'])) {
                         $syncData[$skillEntry['skill_id']] = [
                        'years_of_experience' => $skillEntry['years_of_experience'] ?? 0,
                    ];
                }
            }
            $userProfile->skills()->sync($syncData);
        }

        $updatedUser = User::with(['profile.skills', 'city', 'reviews'])
            ->withCount('projects')
            ->findOrFail($authUser->id);

        return response()->json([
            'message'      => 'Profile updated successfully',
            'user_profile' => UserResource::make($updatedUser),
        ]);
    }
}
