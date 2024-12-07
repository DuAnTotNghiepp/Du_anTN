<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
   
    use HasFactory;

    protected $table = 'order_items'; // Đặt đúng tên bảng

    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
    ];
}
