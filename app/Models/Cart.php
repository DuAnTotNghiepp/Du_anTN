<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'color',
        'size',
        'price',
        'total_price'
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
    public function color()
    {
        return $this->belongsTo(Variants::class, 'color');
    }

    public function size()
    {
        return $this->belongsTo(Variants::class, 'size');
    }


}
