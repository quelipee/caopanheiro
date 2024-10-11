<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:male,female',
            'size' => 'required|string|in:small,medium,large',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'status' => 'required|string|in:available,adopted',
            'photo' => 'required|url',
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * This method returns an array of custom error messages for the validation rules defined
     * in the rules() method, providing user-friendly feedback for the fields in the pet
     * registration form.
     *
     * @return array<string, string> The array of validation error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome do pet é obrigatório.',
            'species.required' => 'A espécie do pet é obrigatória.',
            'age.required' => 'A idade do pet é obrigatória.',
            'gender.required' => 'O gênero do pet é obrigatório.',
            'size.required' => 'O tamanho do pet é obrigatório.',
            'status.required' => 'O status do pet é obrigatório.',
            'photo.image' => 'O arquivo deve ser uma imagem.',
            'photo.max' => 'A imagem deve ter no máximo 2MB.',
        ];
    }
}
