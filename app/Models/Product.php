<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'catalogues_id',
        'name',
        'slug',
        'sku',
        'quantity',
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
        'created_at',
        'updated_at'
    ];

    public function catelogues()
    {
        return $this->belongsTo(Catalogues::class, 'catalogues_id');
    }

    public function variants()
    {
        return $this->belongsToMany(Variants::class, 'product__variants');
    }
}
