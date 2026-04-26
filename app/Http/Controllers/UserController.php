<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;



class UserController extends Controller
{

    public function ShowAvaliableFreelancers()
    {
        $AvaliableUsers = User::where('role_id', 2)->whereHas('profile', function ($q) {
            $q->available();
        })->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')
        ->get();



        return response()->json([
            'message' => 'Avaliable users retrieved successfully',
            'users' => UserResource::collection($AvaliableUsers),
        ], 200);
    }

    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id ?? 2,
            'city_id' => $request->city_id ?? null,
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'image' => 'images/default.jpg',
            'intry_date' => now(),
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    public function Login (Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        if(! Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'access_token' => $token,
        ], 200);
    }

    public function Logout (Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ], 200);
    }
}
