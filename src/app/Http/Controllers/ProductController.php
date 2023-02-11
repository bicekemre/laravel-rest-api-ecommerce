<?php

namespace App\Http\Controllers;

use App\Layer\Head;

use App\Models\{Category, Product, ProductImage};


class ProductController extends Controller
{

    public function product(Product $product)
    {
        $categories  = Category::where(['id' => $product->category_id])->get();
        $productsSim = Product::product('is_recommended', 'DESC')->get();
        $nextProduct = Product::where( ['id' => 1])->get()->first();
        $prevProduct = Product::where(['id' => 1])->get()->first();

        $productImages = ProductImage::where([
            'product_id' => $product->id,
            'is_active' => 1
        ])
            ->orderBy('sorting', 'ASC')
            ->get();




        $head = (new Head())
            ->defineHead(
                $product->name,
                $product->description,
                $product->lead,
                $product->name,
                $product->name,
                $product->name
            );

        return view('home.product',
            compact(
                'head', 'product',
                'productsSim', 'productImages',
                'categories', 'nextProduct',
                'prevProduct'
            )
        );
    }
}
