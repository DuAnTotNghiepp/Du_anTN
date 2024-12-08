<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_note',
        'payment_method',
        'status',
        'total_price',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'user_address', 'id');
    }


}
