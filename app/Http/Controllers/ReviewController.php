<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\App;

class ReviewController extends Controller
{
    public function UserReview(StoreReviewRequest $request,User $user)
    {
        $request->validated();


        Review::create([
            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'reviewable_id' => $request->reviewable_id,
            'reviewable_type' => "App\Models\User",
        ]);

        return response()->json(['message' => 'Review created successfully'], 201);
    }
}
