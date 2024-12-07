<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;
    protected $table = 'vouchers'; 

    protected $fillable = [
        'code',
        'type',
        'value',
        'minimum_order_value',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'status',
    ];

    
}
