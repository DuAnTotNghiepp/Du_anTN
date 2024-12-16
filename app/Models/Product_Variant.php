<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product_Variant extends Pivot
{
    protected $table = 'product_variants';
    protected  $fillable = [
        'id',
        'product_id',
        'color_variant_id',
        'size_variant_id',
        'stock',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    // public function variant()
    // {
    //     return $this->belongsTo(Variants::class, 'variants_id');
    // }

    public function color()
    {
        return $this->belongsTo(Variant::class, 'color_variant_id');
    }

    public function size()
    {
        return $this->belongsTo(Variant::class, 'size_variant_id');
    }
    public function getPriceAttribute()
    {
        return $this->attributes['price'] ?? $this->product->price_sale;
    }

}
