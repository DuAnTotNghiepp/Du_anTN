<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;  // Thay đổi nếu bạn muốn kiểm tra quyền người dùng
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Kiểm tra nếu là yêu cầu cập nhật voucher
        $voucherId = $this->route('id');  // Lấy ID voucher từ URL (giả sử bạn đã định nghĩa route hợp lý)

        return [
            'code' => 'required|string|unique:vouchers,code,' . $voucherId . '|regex:/^[a-zA-Z0-9]+$/|min:2|max:20',  // Mã voucher, bỏ qua chính voucher đang cập nhật
            'type' => 'required|in:fixed,percent',         // Loại voucher phải là 'fixed' hoặc 'percent'
            'value' => 'required|numeric|min:0',           // Giá trị phải có, là số và lớn hơn hoặc bằng 0
            'minimum_order_value' => 'required|numeric|min:0', // Giá trị đơn hàng tối thiểu có thể là rỗng, nếu có thì phải >= 0
            'usage_limit' => 'required|integer|min:0',     // Giới hạn sử dụng có thể là rỗng, nếu có thì phải >= 0
            'start_date' => 'required|date',               // Ngày bắt đầu phải có và phải là ngày hợp lệ
            'end_date' => 'required|date|after_or_equal:start_date', // Ngày kết thúc phải có và phải là ngày hợp lệ, phải sau hoặc bằng ngày bắt đầu
            'status' => 'required|in:active,expired,disabled', // Trạng thái phải là một trong các giá trị: 'active', 'expired', 'disabled'
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
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.unique' => 'Mã voucher này đã tồn tại.',
            'code.regex' => 'Mã voucher chỉ được chứa các ký tự chữ và số, không có ký tự đặc biệt.',
            'code.min' => 'Mã voucher phải có ít nhất 2 ký tự trở lên.',
            'code.max' => 'Mã voucher không được vượt quá 20 ký tự.',

            'type.required' => 'Loại voucher là bắt buộc.',
            'type.in' => 'Loại voucher phải là "cố định" hoặc "phần trăm".',

            'value.required' => 'Giá trị voucher là bắt buộc.',
            'value.numeric' => 'Giá trị voucher phải là một số.',
            'value.min' => 'Giá trị voucher phải lớn hơn hoặc bằng 0.',

            'minimum_order_value.numeric' => 'Giá trị đơn hàng tối thiểu phải là một số.',
            'minimum_order_value.required' => 'Giá trị đơn hàng tối thiểu là bắt buộc.',
            'minimum_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',

            'usage_limit.integer' => 'Giới hạn sử dụng phải là một số nguyên.',
            'usage_limit.required' => 'Giới hạn sử dụng là bắt buộc.',
            'usage_limit.min' => 'Giới hạn sử dụng phải lớn hơn hoặc bằng 0.',

            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',

            'end_date.required' => 'Ngày kết thúc là bắt buộc.',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',

            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái phải là "hoạt động", "hết hạn" hoặc "tắt".',
        ];
    }
}
