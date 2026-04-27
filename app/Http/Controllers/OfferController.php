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
        $offers = Offer::with('project')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Your offers retrieved successfully',
            'count'   => $offers->count(),
            'data'    => OfferResource::collection($offers),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $this->authorize('create', Offer::class);
        $data = $request->validated();

        try {
            $offer = Offer::create([
                'project_id'    => $data['project_id'],
                'user_id'       => Auth::id(),
                'suggested_price'=> $data['suggested_price'],
                'cover_letter'  => $data['cover_letter'],
                'count_of_days' => $data['count_of_days'],
                'file_path'     => $data['file_path'] ?? null,
                'status'        => 'pending',
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'You already applied to this project.',
            ], 400);
        }

        $offer->load('project');

        return response()->json([
            'message' => 'Offer created successfully',
            'data'    => new OfferResource($offer),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
     public function show(Offer $offer)
    {
        $offer->load('project');

        return response()->json([
            'message' => 'Offer retrieved successfully',
            'data'    => new OfferResource($offer),
        ]);
    }

    public function ShowProjectOffers(Project $project)
    {
        // فقط صاحب المشروع يرى العروض
        if (Auth::id() !== $project->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $offers = Offer::with('project')
            ->where('project_id', $project->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Project offers retrieved successfully',
            'project' => $project->title,
            'count'   => $offers->count(),
            'data'    => OfferResource::collection($offers),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        if (Auth::id() !== $offer->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if ($offer->status !== 'pending') {
            return response()->json([
                'message' => 'Cannot edit an offer that is already ' . $offer->status,
            ], 422);
        }

        $offer->update([
            'suggested_price' => $request->suggested_price ?? $offer->suggested_price,
            'cover_letter'    => $request->cover_letter    ?? $offer->cover_letter,
            'count_of_days'   => $request->count_of_days   ?? $offer->count_of_days,
            'file_path'       => $request->file_path       ?? $offer->file_path,
        ]);

        $offer->load('project');

        return response()->json([
            'message' => 'Offer updated successfully',
            'data'    => new OfferResource($offer),
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        if (Auth::id() !== $offer->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if ($offer->status !== 'pending') {
            return response()->json([
                'message' => 'Cannot delete an offer that is already ' . $offer->status,
            ], 422);
        }

        $offer->delete();

        return response()->json(['message' => 'Offer deleted successfully']);
    }
}
