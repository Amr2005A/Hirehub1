<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\App;

class ReviewController extends Controller
{
    public function UserReview(StoreReviewRequest $request,$id)
    {
        $request->validated();

        $user = User::where('role_id', 2)->find($id);

        try {
             $user->reviews()->create([
            'reviewer_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'You already rate this user ',
            ], 400);
        }

        return response()->json(['message' => 'Review created successfully'], 201);
    }

     public function ProjectReview(StoreReviewRequest $request,$id)
    {
        $request->validated();
        $project = Project::find($id);
        


        try {
             $project->reviews()->create([
            'reviewer_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'You already rate this Poject ',
            ], 400);
        }


        return response()->json(['message' => 'Review created successfully'], 201);

}
}
