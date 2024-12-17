<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        // Chỉ cần trả về true nếu bạn muốn cho phép mọi người sử dụng request này
        return true;
    }

    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

        ];
    }

}

