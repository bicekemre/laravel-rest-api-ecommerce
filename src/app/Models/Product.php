<?php

namespace App\Models;

use App\Models\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public $query;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeProduct($query, $orderBy, $sequence)
    {
        return $query->where('is_active', '1')->orderBy($orderBy, $sequence);
    }

    protected static function booted()
    {
        static::addGlobalScope(new ProductScope);
    }

    public function images ()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'product_id', 'id');
    }
}
