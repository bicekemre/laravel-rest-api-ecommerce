<?php

use App\Http\Controllers\Api\V1\{AuthController, BasketController, CategoryController, WishlistController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function (){
    Route::post('/login', 'login')
        ->name('login');

    Route::post('/register', 'register')
        ->name('register');

    Route::post('/logout', 'logout')
        ->name('logout');
});


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function (){
    Route::controller(WishlistController::class)->group(function (){
        Route::get('/wishlist', 'wishlist')
            ->name('wishlist');

        Route::post('/wishlist/add', 'add')
            ->name('wishlist.add');

        Route::delete('/wishlist/delete', 'destroy')
            ->name('wishlist.destroy');
    });

     Route::controller(BasketController::class)->group(function (){
            Route::get('/basket', 'basket')
                ->name('basket');

            Route::post('/basket/add', 'add')
                ->name('basket.add');

            Route::delete('/basket/delete', 'destroy')
                ->name('basket.destroy');
        });

    Route::controller(CategoryController::class)->group(function (){
        Route::get('/categories',  'index')
            ->name('categories');

        Route::post('/categories/create',  'store')
            ->name('categories.create');
    });
});





