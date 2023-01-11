<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioVeVideoRequest;
use App\Models\AudioVeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Electronica extends Controller
{
    public function audioVeVideo(AudioVeVideoRequest $request): \Illuminate\Http\JsonResponse
    {
        $res = AudioVeVideo::create([
            'user_id' => Auth::check() ? Auth::user()->id : NULL,
            'sub_category_id' => $request->sub_category_id,
            'type'            => $request->type,
            'title'           => $request->title,
            'new'             => $this->isCheckBoxName($request->check_box, 'new'),
            'delivery'        => $this->isCheckBoxName($request->check_box, 'delivery'),
            'price'           => $request->price,
            'city'            => $request->city,
            'about'           => $request->about,
            'name'            => $request->name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'publish'         => false,
            'pin'             => (rand(1,100) * mt_rand(rand(1,999), 999999) * rand(1, 99)),
        ]);

        $res->products()->create();

        return response()->json( $res );
    }

    public function isCheckBoxName($check_box, $name) {
        if( !empty($check_box) && !empty($name) && count($check_box) ) {
            foreach ( $check_box as $box ) {
                if( $box == $name ) return $box;
            }
        }
        return false;
    }
}
