<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden  = [
        'is_active',
        'is_recommended'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeCategory ($query, $orderBy, $sequence)
    {
        return $query->where(['is_active' => 1])->orderBy($orderBy, $sequence);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
