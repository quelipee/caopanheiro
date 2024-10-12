<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'species' => 'string|max:100',
            'breed' => 'string|max:100',
            'age' => 'integer|min:0',
            'gender' => 'string|in:male,female',
            'size' => 'string|in:small,medium,large',
            'color' => 'string|max:50',
            'description' => 'string|max:500',
            'status' => 'string|in:available,adopted',
            'photo' => 'url',
        ];
    }
}
