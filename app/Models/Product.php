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
    protected static function booted()
    {
        static::created(function ($product) {
            $catalogue = $product->catalogue;
            if ($catalogue) {
                $catalogue->increment('total_product');
            }
        });

        static::deleted(function ($product) {
            $catalogue = $product->catalogue;
            if ($catalogue) {
                $catalogue->decrement('total_product');
            }
        });
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'product_variants', 'product_id', 'color_variant_id')
                    ->withPivot('color_variant_id', 'size_variant_id', 'stock');
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

    public function materials()
    {
        return $this->hasMany(Material::class);  // Một sản phẩm có thể có nhiều vật liệu
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallerie::class);
    }

}

