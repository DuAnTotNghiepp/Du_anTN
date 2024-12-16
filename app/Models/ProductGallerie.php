<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'image',
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;
    public function ProductGallerie()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
