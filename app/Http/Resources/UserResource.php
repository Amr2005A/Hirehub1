<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'city'  => optional($this->city)->name,

            'profile' => [
                'image'               => optional($this->profile)->image,
                'entry_date'          => optional($this->profile)->intry_date,
                'availability_status' => optional($this->profile)->availability_status,
                'phone_number'        => optional($this->profile)->phone_number,
                'personal_info'       => optional($this->profile)->personal_info,
                'hourly_price'        => optional($this->profile)->hourly_price,
                'portfolio_link'      => optional($this->profile)->portfolio_link,

                // المهارات مع سنوات الخبرة
                'skills' => $this->profile
                    ? $this->profile->skills->map(fn($skill) => [
                        'id'                 => $skill->id,
                        'name'               => $skill->name,
                        'years_of_experience'=> $skill->pivot->years_of_experience,
                    ])
                    : [],
            ],

            // عدد المشاريع للـ freelancer أو الـ client
            'projects_count' => $this->when(
                isset($this->projects_count),
                $this->projects_count
            ),

            'average_rating' => $this->reviews->isNotEmpty()
                ? round($this->reviews->avg('rating'), 1) . ' ⭐'
                : 'No reviews yet',
        ];
    }
}
