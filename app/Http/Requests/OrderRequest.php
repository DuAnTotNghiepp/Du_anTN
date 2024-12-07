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
    public function rules()
    {
        return [
            'user_name' => 'required|string|max:255', // Tên người đặt hàng (bắt buộc, kiểu chuỗi, tối đa 255 ký tự)
            'user_email' => 'required|email|max:255', // Email (bắt buộc, phải đúng định dạng email, tối đa 255 ký tự)
            'user_phone' => 'required|string|max:20', // Số điện thoại (bắt buộc, kiểu chuỗi, tối đa 20 ký tự)
            'user_address' => 'nullable|string|max:255', // Địa chỉ (không bắt buộc, kiểu chuỗi, tối đa 255 ký tự)
            'user_note' => 'nullable|string', // Ghi chú (không bắt buộc, kiểu chuỗi)
            'payment_method' => 'required|in:cash,vnpay', // Phương thức thanh toán (bắt buộc, chỉ cho phép "cash" hoặc "vnpay")
            'items' => 'required|array', // Mảng các sản phẩm (bắt buộc)
            'items.*.product_id' => 'required|exists:products,id', // ID sản phẩm (bắt buộc, phải tồn tại trong bảng products)
            'items.*.quantity' => 'required|integer|min:1', // Số lượng sản phẩm (bắt buộc, kiểu số nguyên, tối thiểu 1)
            'items.*.price' => 'required|numeric|min:0', // Giá sản phẩm (bắt buộc, kiểu số, không âm)
            'items.*.color' => 'nullable|string|max:50', // Màu sắc (không bắt buộc, kiểu chuỗi, tối đa 50 ký tự)
            'items.*.size' => 'nullable|string|max:50', // Kích thước (không bắt buộc, kiểu chuỗi, tối đa 50 ký tự)
            'total_price' => 'required|numeric|min:0', // Tổng giá trị đơn hàng (bắt buộc, kiểu số, không âm)
        ];
    }
    
    public function messages()
    {
        return [
            'user_name.required' => 'Tên không được để trống.',
            'user_name.string' => 'Tên phải là kiểu chuỗi.',
            'user_name.max' => 'Tên không được vượt quá 255 ký tự.',
            
            'user_email.required' => 'Email không được để trống.',
            'user_email.email' => 'Email không đúng định dạng.',
            'user_email.max' => 'Email không được vượt quá 255 ký tự.',
            
            'user_phone.required' => 'Số điện thoại không được để trống.',
            'user_phone.string' => 'Số điện thoại phải là kiểu chuỗi.',
            'user_phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            
            'user_address.string' => 'Địa chỉ phải là kiểu chuỗi.',
            'user_address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            
            'payment_method.required' => 'Phương thức thanh toán không được để trống.',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ.',
            
            'items.required' => 'Danh sách sản phẩm không được để trống.',
            'items.array' => 'Danh sách sản phẩm phải là mảng.',
            
            'items.*.product_id.required' => 'ID sản phẩm không được để trống.',
            'items.*.product_id.exists' => 'Sản phẩm không tồn tại.',
            
            'items.*.quantity.required' => 'Số lượng sản phẩm không được để trống.',
            'items.*.quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'items.*.quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 1.',
            
            'items.*.price.required' => 'Giá sản phẩm không được để trống.',
            'items.*.price.numeric' => 'Giá sản phẩm phải là kiểu số.',
            'items.*.price.min' => 'Giá sản phẩm không được âm.',
            
            'items.*.color.string' => 'Màu sắc phải là kiểu chuỗi.',
            'items.*.color.max' => 'Màu sắc không được vượt quá 50 ký tự.',
            
            'items.*.size.string' => 'Kích thước phải là kiểu chuỗi.',
            'items.*.size.max' => 'Kích thước không được vượt quá 50 ký tự.',
            
            'total_price.required' => 'Tổng giá trị không được để trống.',
            'total_price.numeric' => 'Tổng giá trị phải là kiểu số.',
            'total_price.min' => 'Tổng giá trị không được âm.',
        ];
    }
    
}
