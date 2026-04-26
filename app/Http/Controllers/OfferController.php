<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $offer = $request->validated();

        $offer=Offer::create([
            'project_id' => $offer['project_id'],
            'user_id' => Auth::user()->id,
            'suggested_price' => $offer['suggested_price'],
            'cover_letter' => $offer['cover_letter'],
            'count_of_days' => $offer['count_of_days'],
            'file_path' => $offer['file_path'] ?? null,
            'status' => $offer['status'] ?? 'pending',
        ]);

        return response()->json([
            'message' => 'Offer created successfully',
            'data' => new OfferResource($offer)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function ShowProjectOffers(Project $project)
    {
        $offers = Offer::where('project_id', $project->id)->get();
        return response()->json([
            'message' => 'Offers retrieved successfully',
            'data' => OfferResource::collection($offers)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $offer = $request->validated();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
