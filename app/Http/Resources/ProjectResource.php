<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use carbon\Carbon;
use function Illuminate\Support\hours;

class ProjectResource extends JsonResource
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
            'creator_by' => $this->creatorby->name ?? null,
            'title' => $this->title,
            'description' => $this->description,

            'budget' => $this->budget_type === 'hourly'
            ? $this->hourly_price . '$/hr'
            : $this->fixed_price . '$',

            'deadline' => Carbon::parse($this->date)->isPast()
            ? 'Expired'
            : Carbon::now()->diffInDays($this->date) . ' days left',

            'status' => $this->status,
            'file_path' => $this->file_path,

            'tags' => $this->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            }),

            'offers_count' => $this->offers_count ?? $this->offers()->count(),

            'average_rating' => $this->reviews()->exists()
                ? round($this->reviews()->avg('rating'), 1) . ' ⭐'
                : null,

            'reviews' => $this->whenLoaded('reviews', function () {
                return $this->reviews->map(function ($review) {
                    return [
                        'reviewer_id' => $review->reviewer_id,
                        'rating'      => $review->rating,
                        'comment'     => $review->comment,
                        'date'        => $review->created_at->toDateString(),
                    ];
                });
            }),
        ];
    }
}
