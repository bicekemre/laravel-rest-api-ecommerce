<?php

use App\Http\Controllers\{ HomeController, ProductController, ProfileController, WishlistController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [HomeController::class, 'home'])
    ->name('home');

Route::permanentRedirect('/home', '/');

Route::get('/products/{product}', [ProductController::class, 'product'])
    ->name('products')
    ->missing(function (){
        return view('layouts.notfound');
    });


Route::controller(WishlistController::class)->group( function () {
    Route::get('/wishlist', 'wishlist')
        ->name('wishlist');

    Route::get('/wishlist/add/{product}', 'add')
        ->name('wishlist.add');

    Route::get('/wishlist/delete/{wishlist}', 'destroy')
        ->name('wishlist.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';
