<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product_Variant extends Pivot
{
    protected $table = 'product__variants';
}


// class Product_Variant extends Model
// {
//     use HasFactory;
//     protected  $fillable=[
//         'id',
//         'product_id',
//         'variants_id',
//     ];
// }
