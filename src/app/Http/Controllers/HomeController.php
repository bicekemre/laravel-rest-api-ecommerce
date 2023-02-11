<?php

namespace App\Http\Controllers;

use App\Layer\Head;
use App\Models\{Category, Product};


class HomeController extends Controller
{
    public function home()
    {


        $productsRec  =  Product::product('is_recommended', 'DESC')->get();
        $productsRat  =  Product::product('rating', 'DESC')->get();
        $productsNew  =  Product::product('created_at', 'ASC')->get();

        $categories   =  Category::category('is_recommended', 'DESC')->get();

        $head =  (new Head)
            ->defineHead(
                'TEST','TEST',
                'TEST','TEST',
                'TEST','TEST'
            );

        return view('home.read',
            compact('head',
                'categories',
                'productsRec', 'productsNew',
                'productsRat'
            )
        );
    }
}
