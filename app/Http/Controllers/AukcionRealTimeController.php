<?php

namespace App\Http\Controllers;

use App\Models\AukcionUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class AukcionRealTimeController extends Controller
{
    public function index() {
        $users = $this->getAukcionUsers();
        return view('pages.real_time_aukcion', ['users' => $users]);
    }

    public function setAukcionSum(Request $request) {
        $users = AukcionUsers::where('id', 1)
            ->update(['sum' => $request->sum]);

        if( $users ){
            return $this->getResponseAukcionUsers();
        }
    }

    public function getAukcionUsers() {
        return $users = AukcionUsers::all();
    }

    public function getResponseAukcionUsers() {
        return response()->json([ 'users' => $this->getAukcionUsers() ]);
    }

}
