<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariantsRequest extends FormRequest
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
            'value' => [ 'string', 'max:255', 'unique:variants,value'],
   
        ];
    }

    public function messages(): array
    {
        return [
            'value.unique' => 'Tên biến thể đã Tồn Tại',
        ];
    }
}
