<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WishlistRequest;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function wishlist()
    {
        $user = auth()->user();

        if ($user->currentAccessToken() !== null)
        {
            return Wishlist::where('user_id', $user->getAuthIdentifier());
        }else{
            return response(12);
        }
    }

    public function add(WishlistRequest $request)
    {
        $auth = auth()->user();
        if (isset($auth)) {
            $control = Wishlist::find(1)->where([
                'product_id' => $request->product_id,
                'user_id' => $auth->getAuthIdentifier()
            ])->get()->first();


            if (!isset($control)) {
                Wishlist::create([
                    'product_id' => $request->product_id,
                    'user_id' => $auth->getAuthIdentifier()
                ]);
            }
        }else{
            return response()->json('unauthorized');
        }
    }

    public function destroy(WishlistRequest $request)
    {
        $wish = Wishlist::where('id', $request->id);

        $wish->delete();

        return response()->json('deleted');
    }
}
