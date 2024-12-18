<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Material extends Model
{
    use HasFactory, SoftDeletes;

    // Các trường có thể gán giá trị
    protected $fillable = [
        'name', 'product_id'
    ];

    // Quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class);  // Một vật liệu thuộc về một sản phẩm
    }
    
}
