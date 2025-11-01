<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'description' => 'string|max:255',
            'price' => 'numeric|required',
            'category' => 'required|in:fruits_vegetables,butcher_shop,bakery,drinks,frozen_foods',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute precisa ser prenchido',
            'name.string' => 'O nome fornecido precisa ser no formato correto.',
            'name.max' => 'O nome pode ter no máximo 120 caracteres.',
            'name.min' => 'O nome precisa ter no mínimo 3 caracteres.',
            'description.string' => 'A descrição fornecido precisa ser no formato correto.',
            'description.max' => 'A descrição pode ter no máximo 255 caracteres.',
            'price.numeric' => 'O preço fornecido precisa ser no formato correto.',
            'category.in' => 'A categoria fornecido precisa ser uma dessas opções: fruits_vegetables, butcher_shop, bakery, drinks,frozen_foods.'
        ];
    }
}
