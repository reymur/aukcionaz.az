<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('web');
    }

    public function index($id) {
//        dd( public_path( Storage::disk('public') ) );
        $product = $this->getProductById($id) ?? false;
//        dd( $product );
        return view('products.product_show', ['product' => $product]);
    }

    public function getProductById($id) {
        if( !empty($id) ) {
            $product = Product::where('id',$id)->first();
//            dd( $product );
            if( ! $product ) abort(404 );

            if( $product && $product->id && $product->productable ) {
                $product_infos = $product->productable->with(['user','images','phones'])
                    ->where('id',$product->productable->id)->first();

                if( $product_infos && $product_infos->id ) return $product_infos;
                else return false;
            }
            return false;
        }
        return false;
    }
}
