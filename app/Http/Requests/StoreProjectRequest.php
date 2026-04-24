<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget_type' => 'required|in:hourly,fixed',
            'hourly_price' => 'required_if:budget_type,hourly|numeric',
            'fixed_price' => 'required_if:budget_type,fixed|numeric',
            'date' => 'required|date|after:today',
            'file_path' => 'nullable|string|max:255',
        ];
    }
}
