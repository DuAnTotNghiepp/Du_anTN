<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'img_thumbnail' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'description' => ['max:4000'],
            'price_regular' => ['required', 'integer', 'min:1'],
            'price_sale' => ['required', 'integer', 'min:1'],
            'user_manual' => ['required', 'string', 'max:2000'],
            'content' => ['max:2048'],
            'sku' => ['required', 'string', 'max:10', 'unique:products,sku'],
            'catalogues_id' => ['required', 'exists:catalogues,id']
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Trường Tên Sản Phẩm Không Được Bỏ Trống',
            'name.string'=>'Trường Tên Sản Phẩm Phải Là Chuỗi Ký Tự',
            'name.max'=>'Trường Tên Sản Phẩm Không Vược Quá 255 ký tự',
            'name.unique' => 'Tên Sản Phẩm Đã Tồn Tại',

            'img_thumbnail.image'=>'Trường Ảnh Phải Bắt Buộc Là Ảnh',
            'img_thumbnail.mimes'=>'Tường Ảnh Bắt Buộc Phải Là Dường Dẫn .igf, png, jpeg',
            'img_thumbnail.max'=>'Tường Ảnh Không Quá 2048kb',

            'image.image'=>'Trường Ảnh Phải Bắt Buộc Là Ảnh',
            'image.mimes'=>'Tường Ảnh Bắt Buộc Phải Là Dường Dẫn .igf, png, jpeg',
            'image.max'=>'Tường Ảnh Không Quá 2048kb',

            'description.max'=>'Trường Mô tả Ngắn Sản Phẩm Không Vược Quá 4000 ký tự',

            'price_regular.required'=>'Trường Giá Sản Phẩm Không Được Bỏ Trống',
            'price_regular.integer'=>'Trường Giá Sản Phẩm Phải Là Số Nguyên',
            'price_regular.min'=>'Trường Giá Sản Phẩm Không Được < 1',

            'price_sale.required'=>'Trường Giá Sản Phẩm Không Được Bỏ Trống',
            'price_sale.integer'=>'Trường Giá Sản Phẩm Phải Là Số Nguyên',
            'price_sale.min'=>'Trường Giá Sản Phẩm Không Được < 1',

            'user_manual.required'=>'Trường Hướng Dẫn Sử Dụng Sản Phẩm Không Được Bỏ Trống',
            'user_manual.string'=>'Trường Hướng Dẫn Sử Dụng Sản Phẩm Phải Là Chuỗi Ký Tự',
            'user_manual.max'=>'Trường Hướng Dẫn Sử Dụng Sản Phẩm Không Vược Quá 2000 ký tự',

            'content.max'=>'Trường Mô tả Dài Sản Phẩm Không Vược Quá 4000 ký tự',

            'sku.required'=>'Trường MÃ Sản Phẩm Không Được Bỏ Trống',
            'sku.string'=>'Trường MÃ Sản Phẩm Phải Là Chuỗi',
            'sku.max'=>'Trường MÃ Sản Phẩm Không Được > 10 Ký Tự ',
            'sku.unique' => 'Mã Sản Phẩm Đã Tồn Tại',

            'catalogues_id.required'=>'Trường Danh Mục Không Được Bỏ Trống',
            'catalogues_id.exists'=>'Trường Danh Mục Phải Chọn',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('price_sale') > $this->input('price_regular')) {
                $validator->errors()->add('khuyen_mai', 'Giá khuyến mãi không được nhỏ hơn giá sản phẩm.');
            }
        });
    }
}
