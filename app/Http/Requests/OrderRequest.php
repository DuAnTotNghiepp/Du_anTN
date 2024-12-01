<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_phone' => ['required', 'min:8', 'max:10'],
        ];
    }
    public function messages(): array
    {
        return [
            'user_phone.required'=>'Trường Giá Số Điện Thoại Không Được Bỏ Trống',
            'user_phone.min'=>'Trường Giá Số Điện Thoại Không Được > 8',
            'user_phone.max'=>'Trường Giá Số Điện Thoại Không Được < 11',
        ];
    }
}
