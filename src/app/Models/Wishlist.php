<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function countWishlist ()
    {
        $user = Auth::user();
        if (isset($user))
        {
            $wishlists = Wishlist::where('user_id', $user->getAuthIdentifier())->with('products')->get();

            $count =  count($wishlists);
        }else{
            $count = 1;
        }
        return $count;
    }
}
