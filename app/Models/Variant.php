<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'name',
        'value',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_variants', 'color_variant_id', 'product_id')
        ->withPivot('size_variant_id', 'stock');;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'color')->orWhere('size', 'id');
    }

    public function scopeColors($query)
    {
        return $query->where('name', 'Color');
    }

    // Lọc theo kích thước
    public function scopeSizes($query)
    {
        return $query->where('name', 'Size');
    }

}
