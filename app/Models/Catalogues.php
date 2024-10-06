<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catalogues extends Model
{
    protected $table = 'catalogues';
    protected $primaryKey = 'id';
    protected  $fillable=[
        'id',
        'name',
        'cover',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts=[
        'is_active'=>'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public $timestamps = false;
    public function loadAllCate(){
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->get();
        return $query;
    }
}
