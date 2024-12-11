<?php
namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',  // Lưu variant_id
        'quantity'  // Số lượng sản phẩm
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variants::class);  // Liên kết với bảng variants thông qua variant_id
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
