<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    Protected $fillable=[
        'id',
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
        'created_at',
        'updated_at'
    ];

    public function catelogues()
    {
        return $this->belongsTo(Catalogues::class);
    }
    public function loadDataWithPager(){
        $query = Product::query()
        ->latest('id')
        ->paginate(10);
        return $query;
    }
    public function insertDataProduct($params){
        $params['is_active'] = 1;
        $params['created_at'] = date('Y-m-d H:i:s');
        $res = Product::query()->create($params);
        return $res;
    }
    public function getDataProductById($id){
        $query = Product::query()->find($id);
        return $query;
    }
    public function updateDataProduc($params, $id){
        $params['updated_at'] = date('Y-m-d H:i:s');
       $res =  Product::query()
           ->find($id)
           ->update($params);
       return $res;
    }
    public function deleteDataProduct($id){
        $res = Product::query()->find($id)->delete();
        return $res;
    }
}
