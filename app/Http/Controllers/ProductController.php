<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('web');
    }

    public function index($id) {
        $product = $this->getProductById($id) ?? false;
        return view('products.product_show', ['product' => $product]);
    }

    public function getProductById($id) {
        if( !empty($id) ) {
            $product = Product::where('id',$id)->first();

            if( $product && $product->id && $product->productable ) {
                $product_with_all = $product->productable->with(['user','images','phones'])
                    ->where('id',$product->productable->id)->first();

                if( $product_with_all && $product_with_all->id ) return $product_with_all;
                else return false;
            }
            return false;
        }
        return false;
    }
}
