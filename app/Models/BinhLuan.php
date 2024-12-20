<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    protected $table = 'binh_luans'; 

    protected $fillable = [
        'product_id',
        'user_id',
        'noidung',
        'rating',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
