<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OfferResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfferController extends Controller
{
    use AuthorizesRequests;
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
        $this->authorize('create',Offer::class);
        $offer = $request->validated();

        try {
                $offer=Offer::create([
                'project_id' => $offer['project_id'],
                'user_id' => Auth::user()->id,
                'suggested_price' => $offer['suggested_price'],
                'cover_letter' => $offer['cover_letter'],
                'count_of_days' => $offer['count_of_days'],
                'file_path' => $offer['file_path'] ?? null,
                'status' => $offer['status'] ?? 'pending',
             ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'message' => 'You already applied to this project.'
                ], 400);
            }


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
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $request->validated();
        $offer=Offer::find($offer->id);
        $offer->update([
            'suggested_price'=>$request->suggested_price ?? $offer->suggested_price,
            'cover_letter'=>$request->cover_letter ?? $offer->cover_letter,
            'count_of_days'=>$request->count_of_days ?? $offer->count_of_days,
            'file_path'=>$request->file_path ?? $offer->file_path,
        ]);

        return response()->json([
            'message' => 'Offer updated successfully',
            'data' => new OfferResource($offer)
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
            $offer->delete();
            return response()->json([
                'message' => 'Offer deleted successfully'
            ], 200);
    }
}
