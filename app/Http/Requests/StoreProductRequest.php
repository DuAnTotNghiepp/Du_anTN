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
            'name' => 'required|string|max:255',
            'img_thumbnail' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|lt:price_regular',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string|max:2000',
            'user_manual' => 'nullable|string|max:2000',
            'content' => 'nullable|string|max:5000',
            'is_active' => 'nullable|boolean',
            'is_hot_deal' => 'nullable|boolean',
            'is_good_deal' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'is_show_home' => 'nullable|boolean',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,gif,jpg|max:2048',
            'category_id' => 'required|exists:categories,id', // Kiểm tra danh mục hợp lệ
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là một chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'price_regular.required' => 'Giá thường là bắt buộc.',
            'price_regular.numeric' => 'Giá thường phải là số.',
            'price_regular.min' => 'Giá thường phải lớn hơn hoặc bằng 0.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là số.',
            'price_sale.lt' => 'Giá khuyến mãi không được lớn hơn giá thường.',
            'quantity.required' => 'Số lượng sản phẩm là bắt buộc.',
            'quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 0.',
            'img_thumbnail.image' => 'Ảnh sản phẩm phải là một hình ảnh.',
            'img_thumbnail.mimes' => 'Ảnh sản phẩm phải có định dạng jpeg, png, gif hoặc jpg.',
            'img_thumbnail.max' => 'Ảnh sản phẩm không được vượt quá 2MB.',
            'image.*.image' => 'Ảnh liên quan phải là hình ảnh.',
            'image.*.mimes' => 'Ảnh liên quan phải có định dạng jpeg, png, gif hoặc jpg.',
            'image.*.max' => 'Ảnh liên quan không được vượt quá 2MB.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'description.max' => 'Mô tả không được vượt quá 2000 ký tự.',
            'user_manual.string' => 'Hướng dẫn sử dụng phải là chuỗi ký tự.',
            'user_manual.max' => 'Hướng dẫn sử dụng không được vượt quá 2000 ký tự.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'content.max' => 'Nội dung không được vượt quá 5000 ký tự.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
        ];
    }

}

