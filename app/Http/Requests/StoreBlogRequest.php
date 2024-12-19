<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Trả về true nếu bạn muốn tất cả người dùng có thể gửi form
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2|max:255|unique:blog',  // Tiêu đề là bắt buộc, là chuỗi và có độ dài tối đa là 255 ký tự
            'content' => 'required|string',             // Nội dung là bắt buộc và phải là chuỗi
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Ảnh là bắt buộc, phải là tệp ảnh (jpeg, png, jpg, gif) và không vượt quá 2MB.
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.min' => 'Tiêu đề phải có ít nhất 2 ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là một chuỗi.',
            'image.required' => 'Ảnh là trường bắt buộc.',
            'image.image' => 'Tệp tải lên phải là một hình ảnh.',
            'image.mimes' => 'Ảnh chỉ được hỗ trợ định dạng: jpeg, png, jpg, gif.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ];
    }
}
