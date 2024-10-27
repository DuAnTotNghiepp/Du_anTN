<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variant extends Model
{
    use HasFactory;
    protected  $fillable=[
        'id',
        'product_id',
        'variants_id',
    ];
}
