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
        ];
    }
}
