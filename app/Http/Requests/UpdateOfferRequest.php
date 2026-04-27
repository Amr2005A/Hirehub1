<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'suggested_price' => 'nullable|numeric',
            'cover_letter' => 'nullable|string|max:1000',
            'count_of_days' => 'nullable|integer',
            'status' => 'nullable|in:accepted,rejected,pending',
            'file_path' => 'nullable|string|max:255',
            'created_at' => 'nullable|date',
        ];
    }
}
