<?php

namespace App\Http\Controllers;

use App\Layer\Head;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist ()
    {
        if (auth()->user() !== null) {

            $user = Auth::user();

            $wishlists = Wishlist::where('user_id', $user->getAuthIdentifier())->with('products')->get();

            $head =  (new Head)
                ->defineHead(
                    'TEST','TEST',
                    'TEST','TEST',
                    'TEST','TEST'
                );

            return view('home.wishlist',
                compact('head', 'wishlists',
                )
            );
        }else{
            return redirect('/login');
        }
    }

    public function add(Product $product)
    {
        $auth = Auth::hasUser();
        if (isset($auth)) {
            $control = Wishlist::find(1)->where([
                'product_id' => $product->id,
                'user_id' => auth()->user()->getAuthIdentifier()
            ])->get()->first();


            if (!isset($control)) {
                Wishlist::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->getAuthIdentifier()
                ]);
            }
        }
        return redirect('/wishlist');
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();

        return back();
    }
}