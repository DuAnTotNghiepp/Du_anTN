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
            'size_value' => 'required|alpha|max:255',
        ];
    }
    public function messages(): array
    {
        return [

            'size_value.required' => 'Trường Size là bắt buộc.',
            'size_value.string' => 'Giá trị Size phải là một chuỗi.',
            'size_value.alpha' => 'Giá trị Size chỉ được phép chứa các chữ cái.',
            'size_value.max' => 'Giá trị Size không được vượt quá 255 ký tự.',
        ];
    }
}
