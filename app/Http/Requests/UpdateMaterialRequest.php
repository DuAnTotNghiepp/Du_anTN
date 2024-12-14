<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Đảm bảo người dùng được phép thực hiện yêu cầu này
    }

    public function rules()
    {
        $id = $this->route('material'); // Lấy ID từ route (khớp với tên parameter trong route)

        return [
            'name' => 'required|string|max:255|unique:materials,name,' . $id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chất liệu là bắt buộc.',
            'name.string' => 'Tên chất liệu phải là chuỗi.',
            'name.max' => 'Tên chất liệu không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên chất liệu đã tồn tại.',
        ];
    }
}

