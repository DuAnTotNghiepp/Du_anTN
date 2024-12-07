<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
      // Bảng liên kết với model
      protected $table = 'order_items';

      // Các cột có thể được gán giá trị hàng loạt
      protected $fillable = [
          'order_id',
          'product_id',
          'product_name',
          'size',
          'color',
          'price',
          'quantity'
      ];

    
    // Quan hệ với model Order
      public function order()
      {
          return $this->belongsTo(Order::class);
      }
  
      /**
       * Quan hệ với model Product
       */
      public function product()
      {
          return $this->belongsTo(Product::class);
      }
}
