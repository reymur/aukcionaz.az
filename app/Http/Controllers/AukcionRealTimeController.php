<?php

namespace App\Http\Controllers;

use App\Events\AukcionRealTimeSend;
use App\Http\Requests\AukcionRealTimePriceRequest;
use App\Jobs\AddProductInAukcionJob;
use App\Models\Auksiyon;
use App\Models\AuksiyonGamer;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use function PHPUnit\Framework\isEmpty;

class AukcionRealTimeController extends Controller
{
    public function getAuksiyon(Request $request) {
//        foreach ($sub_category as $item) {
//            SubCategory::query()->insert([
//                'category_id' => $item['category_id'], 'name' => $item['name']
//            ]);
//        }
//        $user = User::query()->insert([
//            'name' => 'Teymur',
//            'password' => Hash::make(Str::random(10)),
//            'email' => 'ni-ttg@hotmail.com'
//        ]);

//        $user = User::first();

//        $pass = $user->password;

//        dispatch(
//            new AddProductInAukcionJob($user, $pass))->delay(now()->addMinute(1)
//        );

//        dd( $request->id );
        if( ! $request->id ) abort(404);

        $timer = null;
        $started_auksiyon = null;
        $product = false;
        $auksiyon = Auksiyon::where('product_id', $request->id)->first();

        if( $auksiyon->product_id == $request->id && $auksiyon->status ) {

            if( $auksiyon && $auksiyon->product && $auksiyon->product->productable ) {

                if( $auksiyon->product->productable->id == $request->id ) {
                    $product = $auksiyon->product->productable->load(['images','subCategory']);
//                    dd( $auksiyon->product->productable );
                }
            }
        }

        $users = $this->getAukcionGamers();

        return view('auksiyon.real_time_aukcion', [
            'users' => $users, 'product' => $product, 'auksiyon' => $auksiyon
        ]);
    }

    public function addOnlyNowAuksiyon(Request $request) {

        if( $request->product_id ) {
            $product_id = $request->product_id;

            $isset_on_auksiyon = $this->issetOnAuksiyon($product_id);

            if( ! $isset_on_auksiyon ) {
                $auksiyon = Auksiyon::create([
                    'user_id'    => Auth::check() ? Auth::user()->id : null,
                    'product_id' => $product_id,
                    'started'    => \Carbon\Carbon::now(),
                    'status'     => 1,
                ]);
            }

            return response()->json([
                'auksiyon' => $auksiyon
            ]);
        }
    }
    public function addOnlyNowAuksiyonWithTimer(Request $request) {

        if( $request->product_id && $request->current_auksiyon_with_time_horus && $request->current_auksiyon_with_time_minute  ) {
            $product_id = $request->product_id;
            $horus = $request->current_auksiyon_with_time_horus;
            $minute = $request->current_auksiyon_with_time_minute;

            $isset_on_auksiyon = $this->issetOnAuksiyon($product_id);

            if( ! $isset_on_auksiyon ) {
                $auksiyon = Auksiyon::create([
                    'user_id'    => Auth::check() ? Auth::user()->id : null,
                    'product_id' => $product_id,
                    'started'    => \Carbon\Carbon::now(),
                    'timer'      => $horus.'_'.$minute,
                    'status'     => 1,
                ]);
            }

            return response()->json([
                'auksiyon' => $auksiyon
            ]);
        }
    }

    public function checkAuksiyon(Request $request){
        if( $request->product_id ) {
            if( $this->issetOnAuksiyon($request->product_id) )
                return response()->json([ 'auksiyon' => 'ok' ]);
            else
                return response()->json([ 'auksiyon' => 'no' ]);
        }

        return response()->json([ 'auksiyon' => 'AAAAAA' ]);
    }

    public function issetOnAuksiyon($product_id) {
        if( $product_id ) {
            $auksiyon = Auksiyon::where('product_id', $product_id)->first();

            if( $auksiyon && $auksiyon->product_id === $product_id ) return true;
            else return false;
        }

        return false;
    }

    public function setAukcionPrice(AukcionRealTimePriceRequest $request) {
        $users = AuksiyonGamer::where('id', 1)
                            ->update($request->validated());

        if( $users ){
            broadcast( new AukcionRealTimeSend($request->user, $request->price) );
            return $this->getResponseAukcionGamers();
        }

    }

    public function getAukcionGamers() {
        return $users = AuksiyonGamer::query()->with(['user','aukcion'])->get();
    }

    public function getResponseAukcionGamers() {
        return response()->json([ 'users' => $this->getAukcionGamers() ]);
    }

    public function auksiyonTimer(Request $request) {
        session_start();
        if( $request->time && $request->current_start ) {
            if( ! isset($_SESSION['time']) && !isset($_SESSION['current_start']) ) {
                $_SESSION['time'] = $request->time;
                $_SESSION['current_start'] = $request->current_start;
            }

            if( isset($_SESSION['time']) && $_SESSION['time'] == ($_SESSION['time'] - 1000) ) {
                return response()->json([
                    'time' => $_SESSION['time'],
                ]);
            } else {
                $time = $request->current_start - $_SESSION['current_start'];
                return response()->json([
                    'time' => $time,
                ]);
            }
        }

//        session_destroy();
    }

}
