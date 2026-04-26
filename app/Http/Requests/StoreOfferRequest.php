<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'suggested_price' => 'required|numeric',
            'cover_letter' => 'nullable|string|max:1000',
            'count_of_days' => 'required|integer',
            'status' => 'in:pending,accepted,rejected',
            'file_path'=>'nullable|string'
        ];
    }
}
