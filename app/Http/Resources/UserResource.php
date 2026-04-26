<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,

            'profile' => [
                'image' => optional($this->profile)->image,
                'entry_date' => optional($this->profile)->intry_date,
                'availability_status' => optional($this->profile)->availability_status,
                'phone_number'=>optional($this->profile)->phone_number,
            ],

            'average_rating' => $this->reviews->avg('rating') . '⭐',
        ];
    }
}
