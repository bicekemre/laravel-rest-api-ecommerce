<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $user = auth()->user();

        if ($user->currentAccessToken() !== null)
        {
            return Basket::where('user_id', $user->getAuthIdentifier());
        }else{
            return response(12);
        }
    }

    public function add(Request $request)
    {
        $auth = auth()->user();
        if (isset($auth)) {
            $control = Basket::find(1)->where([
                'product_id' => $request->product_id,
                'user_id' => $auth->getAuthIdentifier()
            ])->get()->first();


            if (!isset($control)) {
                $create = Basket::create([
                    'product_id' => $request->product_id,
                    'user_id' => $auth->getAuthIdentifier()
                ]);
                return response()->json($create);
            }
        }else{
            return response()->json('unauthorized');
        }
    }


    public function destroy(Request $request)
    {
        $wish = Basket::where('id', $request->id);

        $wish->delete();

        return response()->json('deleted');
    }

}
