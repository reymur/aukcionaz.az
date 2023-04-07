<?php

namespace App\Http\Controllers;

use App\Events\AukcionRealTimeSend;
use App\Http\Requests\AukcionRealTimePriceRequest;
use App\Jobs\AddProductInAukcionJob;
use App\Models\Auksiyon;
use App\Models\AuksiyonGamer;
use App\Models\AuksiyonTimer;
use App\Models\Category;
use App\Models\completeTimeExtendTimer;
use App\Models\Phone;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use function PHPUnit\Framework\isEmpty;
use Twilio\Rest\Client;

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

//        dd(  $this->issetOnAuksiyon(1) );

        if( ! $request->id ) abort(404);

        $product = false;
        $auksiyon = Auksiyon::where('product_id', $request->id)->first();

        if( ! $auksiyon ) abort(404);

        if( $auksiyon && $auksiyon->product_id == $request->id ) {

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

    // VONAGE SMS Verification
    public function sendConfirmation(Request $request) {
        if( $request->number && $request->product_id /*&& $request->name*/ ) {
            $product = GetProductByIdHelper($request->product_id);

            if( $product ) {
                $product_owner_phone = $this->getProductOwnerPhone($product);
                if( $this->generateNumber($product_owner_phone) == $request->number ) {
                    $token = new Token();

                    $token->user_id = $product->user->id;
                    $token->code = $token->code ?? $this->generateCode();
                    $token->save();

//                    Auth::login($product->user);

                    if( $token->user && $token->code && $token->isValid() ) {
//                        try {
//                            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
//
//                            $message = $twilio->messages->create(
//                                $request->number, // to
//                                array(
//                                    "from" => env('TWILIO_NUMBER'),
//                                    "body" => 'code: '.$token->code
//                                )
//                            );
//
//                            if( $message->sid ) {
                                return response()->json([
                                    'user' => $token->user,
                                    'code' => $token->code,
                                    'timer' => $token->created_at->timestamp
                                ], 200 );
//                            }
//                        } catch ( \Exception $ex ) {
//                            return response()->json([
//                                'error' => $ex->getMessage()
//                            ], 500 );
//                        }
                    }
                }

                return response()->json([
                    'success' => /*$product_owner_phone ==*/ $request->number
                ]);
            }
        }
    }

    public function checkVerificationCode(Request $request) {
        if( $request->user_id && $request->code && $request->verification_code ) {
            if( $request->code == $request->verification_code ) {
                $token = Token::where('user_id', $request->user_id)->firstOrFail();

                if( $token && $token->user_id && $token->isValid() ) {
                    Auth::login( $token->user );

                    if( Auth::check() ) {
                        $token->delete();

                        return response()->json([
                            'auth_user' => Auth::user()
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'user' => $token->user
        ]);
    }

    public function resendVerificationCode(Request $request) {
        if( $request->user_id && $request->code ) {
            $token = new Token();
            $old_token_code = $this->getTableInfo($token, 'user_id', 'code', $request->user_id, $request->code);

            if( $old_token_code && $old_token_code->count() ) {
                $old_token = $old_token_code->delete();

                if( $old_token ) {
                    $token->user_id = $request->user_id;
                    $token->code = $token->code ?? $this->generateCode();
                    $token->save();

                    if( $token->user && $token->user->id && $token->code ) {
                        return response()->json([
                            'user_id'  => $token->user->id,
                            'new_code' => $token->code,
                            'timer'    => $token->created_at->timestamp
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'error' => $old_token_code
                ], 500 );
            }

//            return response()->json([
//                'success' => $old_token_code
//            ], 200 );
        }
    }

    public function getTableInfo($table, $column1, $column2=false, $column_val1, $column_val2=false) {
        $res = $table->where(['user_id'=>$column_val1, 'code' => $column_val2])->first();
        return $res ? $res : false;
    }
    public function generateNumber($phone) {
        if( $phone ) {
            $num = preg_replace('/[^0-9]/','', $phone);
            $num ? $operator = substr($num, 0, 3) : false;
            $num = substr($num,4);

            return '+'. ($operator && $num) ? $operator.$num : false;
        }
    }

    public function generateCode($codeLength = 4): string
    {
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);

        return $code;
    }
    public function getProductOwnerPhone( $product ) {
        if( $product && $product->phones && $product->phones->count() ) {
            $phone_num = false;

            foreach ( $product->phones as $phone ) {
                $phone_num = $phone->phone;
            }

            if( $phone_num ) return $phone_num;
            else false;
        }

        return false;
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
            } else if( $isset_on_auksiyon->finished && !$isset_on_auksiyon->status ) {
                $isset_on_auksiyon->update([
                    'started'    => \Carbon\Carbon::now(),
                    'status'     => 1,
                    'finished'   => null,
                ]);
            }

            return response()->json([
                'auksiyon' => $auksiyon ?? $isset_on_auksiyon
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
            } else if( $isset_on_auksiyon->finished && !$isset_on_auksiyon->status ) {
                $isset_on_auksiyon->update([
                    'started'    => \Carbon\Carbon::now(),
                    'timer'      => $horus.'_'.$minute,
                    'finished'   => null,
                    'status'     => 1,
                ]);
            }

            return response()->json([
                'auksiyon' => $auksiyon ?? $isset_on_auksiyon
            ]);
        }
    }

    public function checkAuksiyon(Request $request){
        if( $request->product_id ) {
            $is_auksiyon = $this->issetOnAuksiyon($request->product_id);

            if( $is_auksiyon )
                return response()->json([ 'auksiyon' => $is_auksiyon ]);
            else
                return response()->json([ 'auksiyon' => 'have not' ]);
        }

        return response()->json([ 'auksiyon' => 'AAAAAA' ]);
    }

    public function completeTimeExtendTimer(Request $request) {
        if( $request->product_id && $request->current_time ) {
            $timer = CompleteTimeExtendTimer::where('product_id', $request->product_id )->first();

            if( !$timer ) {
                $timer = CompleteTimeExtendTimer::create([
                    'product_id' => $request->product_id,
                    'current_save_time' => $request->current_time,
                ]);

                if( $timer ) {
                    $current_save_time = $timer->current_save_time ?? $timer->current_save_time;

                    return response()->json([
                        'current_save_time' => $current_save_time
                    ]);
                }
            } else {
                $current_save_time = $timer->current_save_time ?? $timer->current_save_time;

                return response()->json([
                    'current_save_time' => $current_save_time
                ]);
            }
        }

//        return response()->json([
//            'product_id' => $request->product_id.' - '.$request->current_time
//        ]);
    }

    public function issetOnAuksiyon($product_id) {
        if( $product_id ) {
            $auksiyon = Auksiyon::where('product_id', $product_id)->first();

            if( $auksiyon && $auksiyon->product_id == $product_id ) return $auksiyon;
            else return false;
        }

        return false;
    }

    public function setAukcionPrice(AukcionRealTimePriceRequest $request) {
        $users = AuksiyonGamer::where('id', 1)->update($request->validated());

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

    public function auksiyonTimerFunc(Request $request) {
        if( $request->timer && $request->name && $request->time && $request->current_time ) {
            $auksiyon_timer = AuksiyonTimer::where('name', $request->name)->first();

            if( ! $auksiyon_timer ) {
                $auksiyon_timer = AuksiyonTimer::create([
                    'name'              => $request->name,
                    'time'              => $request->time,
                    'current_save_time' => $request->current_time,
                ]);
            }

            $time = $request->current_time - $auksiyon_timer->current_save_time;

            if( ($request->timer - $time) < 0 ) {
                return $this->deleteAuksiyon($request->auksiyon_name, $request->auksiyon_id);
            }

            return response()->json([
                'time' => $time,
            ]);
        }

        if( $request->stop_auksiyon_timer && $request->auksiyon_id ) {
            return $this->deleteAuksiyon($request->auksiyon_name, $request->auksiyon_id);
        }
    }

    public function deleteAuksiyon($auksiyon_name, $auksiyon_id) {
        $auksiyon_timer = AuksiyonTimer::where('name', $auksiyon_name)->delete();
        $auksiyon       = Auksiyon::where('product_id', $auksiyon_id)->first();
        $res = $auksiyon;

        $res->update([
            'timer'    => null,
            'finished' => \Carbon\Carbon::now(),
            'status'   => 0
        ]);

        return response()->json([
            'stop_auksiyon' => 11111,
        ]);
    }
//    public function auksiyonTimer(Request $request) {
//        session_start();
//
//        if( $request->time && $request->name && $request->current_start ) {
//            if( ! isset($_SESSION[$request->name]) && !isset($_SESSION['current_start']) ) {
//                $_SESSION[$request->name] = $request->time;
//                $_SESSION['current_start'] = $request->current_start;
//            }
//
//            if( isset($_SESSION[$request->name]) && $_SESSION[$request->name] == ($_SESSION[$request->name] - 1000) ) {
//                return response()->json([
//                    'time' => $_SESSION[$request->name],
//                ]);
//            } else {
//                $time = $request->current_start - $_SESSION['current_start'];
//                return response()->json([
//                    'time' => $time,
//                ]);
//            }
//        }
//
//        if( $request->stop_auksiyon_timer && $request->auksiyon_id ) {
//            $auksiyon = Auksiyon::where('product_id', $request->auksiyon_id)->first();
//
//            $auksiyon->update([
//                'timer'    => null,
//                'finished' => \Carbon\Carbon::now(),
//                'status'   => 0
//            ]);
//
//            session_destroy();
//
//            return response()->json([
//                'stop_auksiyon_timer' => $auksiyon,
//            ]);
//        }
//
////        session_destroy();
//    }

}
