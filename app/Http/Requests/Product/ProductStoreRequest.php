<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
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
            'category_id' => ['nullable', Rule::exists('categories', 'id')],
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'price' => ['required', 'numeric', 'decimal:0,2'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp'],
            'color' => ['nullable'],
            'pattern' => ['nullable'],
            'season' => ['nullable'],
            'material' => ['nullable'],
            'size' => ['nullable']
        ];
    }
}
