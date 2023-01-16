<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioVeVideoRequest;
use App\Models\AudioVeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Electronica extends Controller
{
    public function audioVeVideo(AudioVeVideoRequest $request): \Illuminate\Http\JsonResponse
    {
//        if( !empty($request) ) {
//            $product = AudioVeVideo::create([
//                'user_id' => Auth::check() ? Auth::user()->id : NULL,
//                'sub_category_id' => $request->sub_category_id,
//                'type'            => $request->type,
//                'title'           => $request->title,
//                'new'             => $this->isCheckBoxName($request->check_box, 'new'),
//                'delivery'        => $this->isCheckBoxName($request->check_box, 'delivery'),
//                'price'           => $request->price,
//                'city'            => $request->city,
//                'about'           => $request->about,
//                'name'            => $request->name,
//                'email'           => $request->email,
//                'publish'         => false
//            ]);
//
//            if( $product && $product->id) {
//                $this->makePinAndNumber($product);
//
//                $phone = $product->phones()->create([
//                    'phone' => $request->phone,
//                ]);
//
//                if( $phone && $product->id === $phone->phoneable_id )
//                    $productable = $product->products()->create();
//                else return response()->json( [
//                    'status' => 422,
//                    'error' => 'phone'
//                ] );
//
//                if( $productable && $product->id === $productable->productable_id )
//                    $imageable = $this->saveImages( $product, $request );
//                else return response()->json( [
//                    'status' => 422,
//                    'error' => 'productable'
//                ] );
//
//                if( $imageable && $product->id === $imageable->imageable_id ) {
//                    return response()->json( [
//                        'status' => '200',
//                        'success' => 'imageable'
//                    ] );
//                } else return response()->json( [
//                    'status' => 422,
//                    'error' => 'imageable'
//                ] );
//            }
//
//            else return response()->json( [
//                'status' => 422,
//                'error' => 'product no created'
//            ] );
//        }

        return response()->json( $request );
    }

    public function saveImages( $product, $request )
    { $arr = [];
        if( $product && $request && $request->has('images') ) {
            $imageable = 0;
            $images = $request->file('images');
            $storage = Storage::disk('public');

            foreach ( $images as $key => $image ) {
                $time = time();
                $image_name = $product->id.'_'.rand(0, $time).'.'.$image->getClientOriginalExtension();

                $imageable = $product->images()->create([
                    'image' => $image_name,
                    'alt' => 'alt',
                ]);
//
                if( $imageable->image == $image_name ) {
                    $storage->put('images/products/'.$image_name, file_get_contents($image) );
                }
            }
            return $imageable;
        }

        return false;
    }

    private function makePinAndNumber($product) {
        if( $product->name ) {
            $pin = ( rand(1,100) * mt_rand(rand(1,999), 999999) * rand(1, 99) ) + (int)$product->id;
            $number = (int)(($pin / 100) + (int)$product->id) * 100;

            return $product->update([
                'pin'    => $pin,
                'number' => $number,
            ]);
        }

        return false;
    }

    public function isCheckBoxName($check_box, $name) {
        if( !empty($check_box) && !empty($name) ) {
            $arr = explode(',', $check_box);
            if( $arr && count($arr) ) {
                foreach ( $arr as $box ) {
                    if( $box == $name ) return $box;
                }
            }
            return false;
        }
        return false;
    }
}
