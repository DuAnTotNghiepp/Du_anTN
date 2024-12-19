<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogues extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',

        'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function hasProducts()
    {
        return $this->products()->exists();
    }
}
