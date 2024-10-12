<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogues extends Model
{
    protected  $fillable=[
        'name',
        'cover',

    ];
    protected $casts=[
        'is_active'=>'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
