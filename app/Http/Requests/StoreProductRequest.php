<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                'name' => 'required|string|max:50|min:3',
                'sku' => 'required|string|max:255|unique:products,sku',
                'img_thumbnail' => 'nullable|image|max:2048',
                'price_regular' => 'required|numeric|min:0',
                'price_sale' => 'required|numeric|min:0|lte:price_regular',
                'material' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'content' => 'required|string',
                'user_manual' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
        ];
    }
}

