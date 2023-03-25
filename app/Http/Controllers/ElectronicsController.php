<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioVeVideoRequest;
use App\Models\AudioVeVideo;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ElectronicsController extends Controller
{
    public function audioVeVideo(AudioVeVideoRequest $request)
    {
        if (!empty($request)) {
            $user = null;
            $imageable = null;
            $productable = null;

            DB::beginTransaction();

            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                Auth::login($user);
            } catch (\Exception $ex) {
                DB::rollBack();
                abort(500, 'Not created user');
            }

            try {
                $product = AudioVeVideo::create([
                    'user_id' => Auth::check() ? Auth::user()->id : $user->id,
                    'sub_category_id' => $request->sub_category_id,
                    'type' => $request->type,
                    'title' => $request->title,
                    'new' => $this->isCheckBoxName($request->check_box, 'new'),
                    'delivery' => $this->isCheckBoxName($request->check_box, 'delivery'),
                    'price' => $request->price,
                    'city' => $request->city,
                    'about' => $request->about,
                    'publish' => false
                ]);
            } catch (\Exception $ex) {
                DB::rollBack();
                abort(500, 'Not created product');
            }


            try {
                $this->makePinAndNumber($product);
            } catch (\Exception $ex) {
                DB::rollBack();
                abort(500, 'Not created PIN number');
            }

            try {
                $phone = $product->phones()->create([
                    'phone' => $request->phone,
                ]);
            } catch (\Exception $ex) {
                DB::rollBack();
                abort(500, 'Not created PHONE number');
            }

            try {
                if ($phone && $product->id === $phone->phoneable_id) {
                    $productable = $product->products()->create();
                } else {
                    abort(500, '(Productable create) Bilinməyən Xəta!');
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                abort(500, 'Not created PRODUCTABLE');
            }

            try {
                if ($productable && $product->id === $productable->productable_id) {
                    $imageable = $this->saveImages($product, $request);
                } else {
                    abort(500, '(Image Save) Bilinməyən Xəta!');
                }
            } catch (\Exception $ex) {
                DB::rollBack();

                if( $product && !$product->images->count() && $product->id ) {
                    abort(500, $product->id );
                }
            }

            try {
                if ($imageable && $product->id === $imageable->imageable_id) {
                    session_start();
                    $_SESSION['product_id'] = $product->id;

                    DB::commit();

                    return response()->json([
                        'productable' => $productable->productable
                    ]);
                } else {
                    abort(500, '(productable) Bilinməyən Xəta!');
                }
            } catch (\Exception $ex) {
                DB::rollBack();

                if( $product && !$product->images->count() && $product->id ) {
                    abort(500, $product->id );
                }
            }
        }
    }

    public function saveImages( $product, $request )
    {
        $arr = [];
        if( $product && $request && $request->has('images') ) {
            $imageable = 0;
            $images = $request->file('images');
            $storage = Storage::disk('public');
            $image_path = public_path('storage').'/images/products';

            foreach ( $images as $key => $image ) {
                $time = time();
                $image_name = $product->id.'_'.rand(0, $time).'.'.$image->getClientOriginalExtension();

                $imageable = $product->images()->create([
                    'image' => $image_name,
                    'alt' => 'alt',
                ]);

                // IMAGE INTERVENTION
                $this->imageInterventionMake($imageable, $image, $image_name, $image_path);
            }
            return $imageable;
        }

        return false;
    }

    public function makePinAndNumber($product) {
        if( $product->id ) {
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

    private function imageInterventionMake($imageable, $image, string $image_name, string $image_path)
    {
        if( $imageable->image == $image_name ) {
            $width = Image::make( $image )->width();
            $height = Image::make( $image )->height();
            $intervention = Image::make( $image->getRealPath() );
            if( $width > 853 && $height > 501 ) {
                $intervention->resize(853, 501, function ($constraint) {
                    $constraint->aspectRatio();
                })->save( $image_path.'/'.$image_name );
            }
            else if ( $width > 853 && $height <= 501 ) {
                $intervention->resize(853, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save( $image_path.'/'.$image_name );
            }
            else if ( $width <= 853 && $height > 501 ) {
                $intervention->resize($width, 501, function ($constraint) {
                    $constraint->aspectRatio();
                })->save( $image_path.'/'.$image_name );
            }
            else {
                $intervention->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save( $image_path.'/'.$image_name );
            }
//                    $storage->put('images/products/'.$image_name, file_get_contents($image) );
        }
    }
}
