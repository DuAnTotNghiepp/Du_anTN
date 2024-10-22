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
            'name' => 'required|string|max:50|min:3|regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$',
            'sku' => 'required|string|max:255|unique:products,sku',
            'img_thumbnail' => 'nullable|image|max:2048', // Tối đa kích thước của ảnh là 2048KB (2Mb)
            'price_regular' => 'required|numeric|min:0',  // numeric: phải là 1 số
            'price_sale' => 'required|numeric|min:0',
            'material' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'user_manual' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ];
    }

    public function messages(){
        return [
            'name.regex' => 'Tên sản phẩm phải bao gồm cả chữ và số.',
        ];
    }
}
