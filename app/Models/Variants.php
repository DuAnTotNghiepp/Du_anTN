<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    Protected $fillable=[
        'id',
        'name',
        'value',
        'created_at',
        'updated_at'
    ];
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
