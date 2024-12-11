<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCataloguesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Đảm bảo người dùng được phép thực hiện hành động này
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|min:3|regex:/^[a-zA-Z0-9\s]+$/u',
            'is_active' => 'nullable|boolean',
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            // Validate cho trường `name`
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 50 ký tự.',
            'name.min' => 'Tên danh mục phải có ít nhất 3 ký tự.',
            'name.regex' => 'Tên danh mục chỉ được chứa chữ cái, số và khoảng trắng.',


            // Validate cho trường `cover`
            'cover.image' => 'Ảnh bìa phải là một tệp hình ảnh hợp lệ.',
            'cover.mimes' => 'Ảnh bìa chỉ được phép có định dạng jpg, jpeg hoặc png.',
            'cover.max' => 'Ảnh bìa không được vượt quá 2MB.',

            // Validate cho trường `is_active`
            'is_active.boolean' => 'Trạng thái phải là kiểu giá trị hợp lệ (có hoặc không).',
        ];
    }

}
