<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Items extends Model
{
   
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
     'order_id',
        'user_id',
        'product_id',
        'cart_id',
        'product_variant_id',
        'quantity',
        'product_name',
        'product_sku',
        'product_img_thumbnail',
        'product_price_regular',
        'product_price_sale',
        'size',
        'color',
        'order_id'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
