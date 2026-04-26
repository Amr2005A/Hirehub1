<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'nullable|string|max:255',
            'city_id'=>'nullable|exists:cities,id',
            'personal_info' => 'nullable|string|max:1000',
            'hourly_price' => 'nullable|numeric',
            'phone_number' => 'nullable|string|max:20',
            'availability_status'=>'new Enum(AvailabilityStatus::class)',
            'portfolio_link' =>'nullable|string|max:255'
        ];
    }
}
