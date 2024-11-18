<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    protected $table = 'variants'; // Chỉ rõ bảng 'variants'
    public $timestamps = false;
    // public function variants()
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product__variants');
    }

}
