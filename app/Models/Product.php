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
        'material_id',
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
        return $this->belongsToMany(Variants::class, 'product__variants');
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
    public function materials()
    {
        return $this->hasMany(Material::class);  // Một sản phẩm có thể có nhiều vật liệu
    }
}
