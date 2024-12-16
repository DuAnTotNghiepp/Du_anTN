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
        'created_at',
        'updated_at'
    ];

    public function catelogues()
    {
        return $this->belongsTo(Catalogues::class, 'catalogues_id');
    }

    public function variants()
    {
        return $this->belongsToMany(Variants::class, 'product__variants','product_id', 'variants_id')->withPivot('quantity');
    }
    public function productVariants()
    {
        return $this->hasMany(Product_Variant::class, 'product_id');
    }
    public function binh_luans()
    {
        return $this->hasMany(BinhLuan::class, 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function productFavoritedByUsers()
    {
        return $this->hasMany(ProductFavorite::class);
    }
    public function productFavorites()
    {
        return $this->belongsToMany(Product::class, 'product_favorites', 'user_id', 'product_id');
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallerie::class);
    }
}