<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có được phép thực hiện yêu cầu này không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Đặt thành true nếu không có kiểm tra quyền đặc biệt
    }

    /**
     * Lấy các quy tắc xác thực được áp dụng cho yêu cầu.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:materials,name',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên chất liệu là bắt buộc.',
            'name.string' => 'Tên chất liệu phải là chuỗi.',
            'name.max' => 'Tên chất liệu không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên chất liệu đã tồn tại.', // Thêm thông báo tùy chỉnh cho unique
        ];
    }
}

