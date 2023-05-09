<?php

namespace App\Http\Controllers;

use App\Events\AukcionRealTimeSend;
use App\Events\RealTimeAuksiyon;
use App\Http\Requests\AukcionRealTimePriceRequest;
use App\Jobs\AddProductInAukcionJob;
use App\Jobs\SetAuksiyonPriceJob;
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
//        dd(  $request->id );
//        Auth::login();
        if( ! $request->id ) abort(404);

//        event(new RealTimeAuksiyon('AAAAAAAAAAA'));
//        event(new \App\Events\RealTimeAuksiyon('Hello World'));

        $product = false;
        $auksiyon = Auksiyon::where('product_id', $request->id)->first();

        if( ! $auksiyon ) return redirect()->route('home');

        if( $auksiyon->product_id && $auksiyon->product_id == $request->id ) {

            if( $auksiyon && $auksiyon->product && $auksiyon->product->productable ) {

                if( $auksiyon->product->productable->id == $request->id ) {
                    $product = $auksiyon->product->productable->load(['images','subCategory']);
//                    dd( $auksiyon->product->productable );
                }
            }
        }

        $auksiyon_gamers = $this->getAukcionGamersById($auksiyon->id);
        $user = Auth::check() ? Auth::user() : 'null';

        return view('auksiyon.real_time_aukcion', [
            'user' => $user, 'auksiyon_gamers' => $auksiyon_gamers,
            'product' => $product, 'auksiyon' => $auksiyon
        ]);
    }

    public function myMess(Request $request) {
        if( $request->message ) {

            event(new RealTimeAuksiyon('Hello World'));

            return response()->json([
                'message' => $request->message
            ]);
        }
    }

    public function setAukcionPrice(AukcionRealTimePriceRequest $request) {
        if( $request->user_id && $request->auksiyon_id && $request->price ) {
            $user = AuksiyonGamer::where('user_id', $request->user_id)->first();
//            return response()->json([
//                'message' => $this->getAukcionGamers($request->auksiyon_id)
//            ]);

            if( $user ){
                $user->update($request->validated());
                $users = [
                        'all_gamers' => $this->getAukcionGamersById($request->auksiyon_id),
                        'last_add_price' => $this->getAukcionGamersLastPriceAdd($request->auksiyon_id),
                    ];

                $this->dispatch( new SetAuksiyonPriceJob($users) );

//            broadcast( new AukcionRealTimeSend($request->user, $request->price) );
//                return response()->json([
//                    'users' => [
//                        'all_gamers' => $this->getAukcionGamersById($request->auksiyon_id),
//                        'last_add_price' => $this->getAukcionGamersLastPriceAdd($request->auksiyon_id),
//                    ]
//                ]);
            }
        }
    }

    public function getAukcionGamersLastPriceAdd($auksiyon_id) {
        $res = $this->getAukcionGamersById($auksiyon_id);
        if( $res && $res->count() ) return $res->sortBy('updated_at')->load('user')->last();
        return false;
    }
    public function getAukcionGamersById($auksiyon_id) {
        if( $auksiyon_id ) return AuksiyonGamer::where('auksiyon_id', $auksiyon_id)
            ->with('user')
            ->get();
        return false;
    }

    // VONAGE SMS Verification
    public function sendConfirmation(Request $request) {
        if( $request->number && $request->product_id && $request->save_time /*&& $request->name*/ ) {
            $product = GetProductByIdHelper($request->product_id);

            if( $product ) {
                $product_owner_phone = $this->getProductOwnerPhone($product);

                if( $this->generateNumber($product_owner_phone) == $request->number ) {
                    $token = new Token();

                    $token->user_id = $product->user->id;
                    $token->code = $token->code ?? $this->generateCode();
                    $token->save_time = $request->save_time;
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
                                    'timer' => $token->save_time
                                ], 200 );
//                            }
//                        } catch ( \Exception $ex ) {
//                            return response()->json([
//                                'error' => $ex->getMessage()
//                            ], 500 );
//                        }
                    }
                } else {
                    return response()->json([
                        'message' => 'not user'.$this->generateNumber($product_owner_phone).' - '.$request->number
                    ], 419 );
                }

                return response()->json([
                    'success' => /*$product_owner_phone ==*/ $request->number
                ]);
            }
        }

        return response()->json([
            'user' => 'not all'
        ], 500 );
    }

    public function issetAuksiyonGamer( $auksiyon, $auksiyon_gamer ) {
        if( !$auksiyon || !$auksiyon_gamer && (!$auksiyon->id || !$auksiyon_gamer->id) ) return false;
        if( !$auksiyon_gamer->auksiyonGamer->status ) return false;
        if( $auksiyon->finished && $auksiyon->status != 1 ) return false;
        if( $auksiyon->user_id == $auksiyon_gamer->id ) return false;
        if( !$auksiyon_gamer && !$auksiyon_gamer->auksiyonGamer && !$auksiyon_gamer->auksiyonGamer->auksiyon_id ) return false;

        if( $auksiyon->id == $auksiyon_gamer->auksiyonGamer->auksiyon_id ) return true;

        return false;
    }
    public function AuksiyonGamerInTheGame( $auksiyon, $auksiyon_gamer ) {
            if( !$auksiyon || !$auksiyon_gamer ) return false;
            if( !$auksiyon->id || !$auksiyon_gamer->id ) return false;
            if( !$auksiyon_gamer->auksiyonGamer->status ) return false;
            if( $auksiyon->finished && $auksiyon->status != 1 ) return false;
            if( $auksiyon->user_id == $auksiyon_gamer->id ) return false;
            if( !$auksiyon_gamer && !$auksiyon_gamer->auksiyonGamer && !$auksiyon_gamer->auksiyonGamer->auksiyon_id ) return false;

            if( $auksiyon->id == $auksiyon_gamer->auksiyonGamer->auksiyon_id ) return true;

            return false;
        }

    public function sendConfirmationForGamer(Request $request) {
        if( $request->name && $request->number && $request->product_id && $request->save_time ) {
            $phone = null;
            $auksiyon = null;
            $phone_owner = null;
            $product_owner_phone = null;
            $product = GetProductByIdHelper($request->product_id);
            $phone = Phone::where('phone', $request->number)->first();

            if( $product ) $product_owner_phone = $this->getProductOwnerPhone($product);

            if( $phone && $phone->user && $phone->user->auksiyonGamer ) $phone_owner = $phone->user;
            if( $product && $product->auksiyon && $product->auksiyon->id ) $auksiyon = $product->auksiyon;

            if( $product_owner_phone == $request->number ) {
                Auth::login($product->user);
                return response()->json([
                    'product_owner' => $product->user
                ], 200);
            }

            if( $this->AuksiyonGamerInTheGame( $auksiyon, $phone_owner ) ) {
                return response()->json([
                    'isset_gamer' => $phone_owner->auksiyonGamer->user_id
                ], 500 );
            }

//            if( !$this->issetAuksiyonGamer( $auksiyon, $phone_owner ) ) {
////                Auth::login($phone_owner->id);
//                return response()->json([
//                    'isset_gamer' => $phone_owner->auksiyonGamer
//                ], 500 );
//            }

            if( $phone_owner && $phone_owner->count() && $phone_owner->user && $phone_owner->user->id ) {
                $token = new Token();
                $token->user_id = $phone_owner->user->id;
                $token->status = 'gamer';
                $token->code = $token->code ?? $this->generateCode();
                $token->save_time = $request->save_time;
                $token->save();

//                    Auth::login( $phone->user );

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

                    if( $this->isAuksiyonOwner($auksiyon, $token, $request->number) ){
                        $auksiyon_product_owner = $this->isAuksiyonOwner($auksiyon, $token, $request->number);
//                        Auth::login($auksiyon->user);
//                        return response()->json([
//                            'request' => $product_auksiyon_owner->id.' = '.$token->user->id
//                        ], 500 );

                        return response()->json([
                            'user' => $auksiyon_product_owner,
                            'code' => $token->code,
                            'timer' => $token->save_time,
                            'auksiyon_id' => $auksiyon->id
                        ], 200);
                    } else {
//                        Auth::login($phone->user);
                        $new_auksiyon_gamer = AuksiyonGamer::create([
                            'user_id'     => $phone->user->id,
                            'auksiyon_id' => $auksiyon->id,
                            'price'       => 0,
                            'position'    => $this->getPosition(),
                        ]);

                        if( $new_auksiyon_gamer ) {
                            return response()->json([
                                'user' => $token->user,
                                'code' => $token->code,
                                'timer' => $token->save_time,
                                'auksiyon_id' => $auksiyon->id
                            ], 200);
                        }
                    }
//                            }
//                        } catch ( \Exception $ex ) {
//                            return response()->json([
//                                'error' => $ex->getMessage()
//                            ], 500 );
//                        }
                }
            }
            else {
                $new_user_phone = null;
                $new_user = User::create([ 'name' => $request->name ]);

                if( $new_user ) $new_user_phone = $new_user->phones()->create(['phone' => $request->number]);

                $token = new Token();
                $token->user_id = $new_user->id;
                $token->status = 'gamer';
                $token->code = $token->code ?? $this->generateCode();
                $token->save_time = $request->save_time;
                $token->save();

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
//                    Auth::login( $new_user );

                    $new_auksiyon_gamer = AuksiyonGamer::create([
                        'user_id'     => $new_user->id,
                        'auksiyon_id' => $auksiyon->id,
                        'price'       => 0,
                        'position'    => $this->getPosition(),
                    ]);

                    return response()->json([
                        'user' => $token->user,
                        'code' => $token->code,
                        'timer' => $token->save_time,
                        'auksiyon_id' => $auksiyon->id
                    ], 200 );
//                            }
//                        } catch ( \Exception $ex ) {
//                            return response()->json([
//                                'error' => $ex->getMessage()
//                            ], 500 );
//                        }
                }
            }
        }

        return response()->json([
            'request' => $request->number
        ], 500 );
//
//        return response()->json([
//            'request' => $request->name .' - '. $request->number .' - '. $request->product_id .' - '. $request->save_time
//        ], 500 );
    }

    public function authorizeAuksiyonGamer(Request $request) {
        if( $request->pin && $request->user_id && $request->auksiyon_id ) {
            $auksiyon_gamer = AuksiyonGamer::where([
                'pin' => $request->pin,
                'user_id' => $request->user_id,
                'auksiyon_id' => $request->auksiyon_id,
            ])->first();

            if( $auksiyon_gamer && $auksiyon_gamer->auksiyon ) {
                $gamer = $auksiyon_gamer;
                if( !$gamer->auksiyon->finished && $gamer->auksiyon->status ) {
                    return response()->json([
                        'auksiyon_is_finished' => true
                    ], 422 );
                }
            }

            if( $auksiyon_gamer && $auksiyon_gamer->user ) {
                Auth::login( $auksiyon_gamer->user );

                return response()->json([
                    'request' => $auksiyon_gamer->auksiyon
                ], 200);
            }


        }
    }

    public function exitFromAuksiyon(Request $request) {
        if( $request->auksiyon_id ) {
            $auksiyon = Auksiyon::where('id', $request->auksiyon_id )->first();

            if( $auksiyon && $auksiyon->id == $request->auksiyon_id ) {
                $auksiyon->delete();

                return response()->json([
                    'auction_removed' => $auksiyon
                ], 200 );
            }
        }
    }

    public function checkVerificationCode(Request $request) {
        if( $request->user_id && $request->code && $request->verification_code ) {
            if( $request->code == $request->verification_code ) {
                $token = Token::where('user_id', $request->user_id)->first();

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
            'user' => $request->user_id
        ]);
    }
    public function isAuksiyonOwner($auksiyon, $token, $number) {
        if( $auksiyon && $auksiyon->user && $token && $token->user && $number ) {
            if ( ($auksiyon->user->phone->phone == $number) &&( $auksiyon->user->id == $token->user->id) )
                return $auksiyon->user;

            return false;
        }
        return false;
    }

    public function getPosition() {
        $auksiyon_gamers = AuksiyonGamer::latest('id')->first();
        if( $auksiyon_gamers && $auksiyon_gamers->count() ) {
            return (int) $auksiyon_gamers->position + 1;
        }
        return false;
    }

    public function resendVerificationCode(Request $request) {
        if( $request->user_id && $request->code && $request->save_time ) {
            $token = new Token();
            $old_token_code = $this->getTableInfo($token, 'user_id', 'code', $request->user_id, $request->code);

            if( $old_token_code && $old_token_code->count() ) {
                $old_token = $old_token_code->delete();

                if( $old_token ) {
                    $token->user_id = $request->user_id;
                    $token->code = $token->code ?? $this->generateCode();
                    $token->save_time = $request->save_time;
                    $token->save();

                    if( $token->user && $token->user->id && $token->code ) {
                        return response()->json([
                            'user_id'  => $token->user->id,
                            'new_code' => $token->code,
                            'timer'    => $token->save_time
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

    public function deleteToken(Request $request) {
        if( $request->user_id && $request->code ) {
            $token = new Token();
            $token = new Token();
            $result = $token->where(['user_id'=>$request->user_id, 'code'=>$request->code])->first();

            if( $result ) {
                $result->delete();
            }
        }
//        return response()->json([
//            'deleted' => $request->auksiyon_gamer_id .' - '. $request->auksiyon_id
//        ], 200);

        if( $request->auksiyon_gamer_id && $request->auksiyon_id ) {
            $this->deleteAuksiyonGamer($request->auksiyon_gamer_id, $request->auksiyon_id );


        }
    }

    public function deleteAuksiyonGamer($gamer_id, $auksiyon_id) {
        $is_gamer = AuksiyonGamer::where(['user_id'=>$gamer_id, 'auksiyon_id'=>$auksiyon_id])->first();
        Auth::logout();
        if( $is_gamer ) $is_gamer->delete();
    }

    public function getTableInfo($table, $column1, $column2=false, $column_val1, $column_val2=false) {
        $res = $table->where(['user_id'=>$column_val1, 'code' => $column_val2])->first();
        return $res ? $res : false;
    }
    public function generateNumber($phone) {
        if( $phone ) {
            $num = preg_replace('/[^0-9]/','', $phone);
            $num ? $operator = substr($num, 0, 3) : false;
            $num = substr($num,3);

            return ($operator && $num) ? '+'.$operator.$num : false;
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

                return response()->json([
                    'auksiyon' => $auksiyon
                ], 200);

            } else if( $isset_on_auksiyon->finished && !$isset_on_auksiyon->status ) {
                $isset_on_auksiyon->update([
                    'started'    => \Carbon\Carbon::now(),
                    'status'     => 1,
                    'finished'   => null,
                ]);

                return response()->json([
                    'isset_on_auksiyon' => $isset_on_auksiyon
                ], 200);
            }
        }

        return response()->json([
            'error' => $request
        ], 500);
    }
    public function addOnlyNowAuksiyonWithTimer(Request $request) {

        if( $request->product_id &&
            $request->current_auksiyon_with_time_horus &&
            $request->current_auksiyon_with_time_minute
        ) {
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

                return response()->json([
                    'auksiyon' => $auksiyon
                ], 200 );

            } else if( $isset_on_auksiyon->finished && !$isset_on_auksiyon->status ) {
                $isset_on_auksiyon->update([
                    'started'    => \Carbon\Carbon::now(),
                    'timer'      => $horus.'_'.$minute,
                    'finished'   => null,
                    'status'     => 1,
                ]);

                return response()->json([
                    'auksiyon' =>  $this->issetOnAuksiyon($product_id)
                ], 200 );
            }
        }

        return response()->json([
            'error' => $request
        ], 500);
    }

    public function checkAuksiyon(Request $request){
        if( $request->product_id ) {
            $is_auksiyon = $this->issetOnAuksiyon($request->product_id);

            if( ! $is_auksiyon ) return response()->json([ 'auksiyon' => 'have not' ], 404 );

            return response()->json([ 'auksiyon' => $is_auksiyon ], 200 );
        }

        return response()->json([ 'auksiyon' => 'request->product_id not have' ], 500 );
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

    public function getResponseAukcionGamers(Request $request) {
        if( $request->auksiyon_id ) {
            return response()->json(['users' => $this->getAukcionGamersById($request->auksiyon_id)]);
        }
    }

    public function getAllAukcionGamers() {
        return AuksiyonGamer::query()->with(['user','auksiyon'])->get();
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

        $auksiyon->update([
            'timer'    => NULL,
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
