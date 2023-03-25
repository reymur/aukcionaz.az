<?php

namespace App\Http\Controllers;

use App\Events\AukcionRealTimeSend;
use App\Http\Requests\AukcionRealTimePriceRequest;
use App\Jobs\AddProductInAukcionJob;
use App\Models\AuksiyonGamer;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use function PHPUnit\Framework\isEmpty;

class AukcionRealTimeController extends Controller
{
    public function index() {


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

        $user = User::first();

        $pass = $user->password;

//        dispatch(
//            new AddProductInAukcionJob($user, $pass))->delay(now()->addMinute(1)
//        );

        $users = $this->getAukcionGamers();
        return view('pages.real_time_aukcion', ['users' => $users]);
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

}
