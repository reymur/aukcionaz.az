<?php

namespace App\Http\Controllers;

use App\Events\AukcionRealTimeSend;
use App\Http\Requests\AukcionRealTimePriceRequest;
use App\Models\AukcionGamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class AukcionRealTimeController extends Controller
{
    public function index() {
        $users = $this->getAukcionGamers();
        return view('pages.real_time_aukcion', ['users' => $users]);
    }

    public function setAukcionPrice(AukcionRealTimePriceRequest $request) {
        $users = AukcionGamer::where('id', 1)
                            ->update($request->validated());

        if( $users ){
            broadcast( new AukcionRealTimeSend($request->user, $request->price) );
            return $this->getResponseAukcionGamers();
        }

    }

    public function getAukcionGamers() {
//        dd($users);
        return $users = AukcionGamer::query()->with(['user','aukcion'])->get();
    }

    public function getResponseAukcionGamers() {
        return response()->json([ 'users' => $this->getAukcionGamers() ]);
    }

}
