<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    protected $table = 'variants'; // Chỉ rõ bảng 'variants'
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'name',
        'value',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product__variants', 'variants_id', 'product_id')->withPivot('quantity');;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'color')->orWhere('size', 'id');
    }


}
