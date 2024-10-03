<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    Protected $fillable=[
        'catelogues_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'is_active',
        'view',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
        'is_show_home',
    ];

    public function catelogues()
    {
        return $this->belongsTo(Catalogues::class);
    }
}
