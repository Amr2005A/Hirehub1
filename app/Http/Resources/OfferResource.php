<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_title' => $this->project->title ,
            'creator_by' => Auth::user()->name,
            'suggested_price' => $this->suggested_price,
            'cover_letter' => $this->cover_letter,
            'Estimated days for project completion' => $this->count_of_days,
            'status' => $this->status,
            'file_path' => $this->file_path,
            'before' => $this->created_at,
        ];
    }
}
