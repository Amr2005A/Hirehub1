<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'project_title' => optional($this->project)->title,
            'project_status'=> optional($this->project)->status,
            'freelancer_id' => $this->user_id,
            'suggested_price' => $this->suggested_price,
            'cover_letter'  => $this->cover_letter,
            'estimated_days'=> $this->count_of_days,
            'status'        => $this->status,
            'file_path'     => $this->file_path,
            'submitted_at'  => $this->created_at?->toDateString(),
        ];
    }
}
