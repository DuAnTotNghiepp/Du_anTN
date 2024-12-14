<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product_Variant extends Pivot
{
    protected $table = 'product__variants';
    protected  $fillable = [
        'id',
        'product_id',
        'variants_id',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function variant()
    {
        return $this->belongsTo(Variants::class, 'variants_id');
    }

}
