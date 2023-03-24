<?php

use App\Models\Product;

    function GetProductByIdHelper($id) {
        if( !empty($id) ) {
            $product = Product::where('id',$id)->first();

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
