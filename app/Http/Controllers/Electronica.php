<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudioVeVideoRequest;
use Illuminate\Http\Request;

class Electronica extends Controller
{
    public function audioVeVideo(AudioVeVideoRequest $request): \Illuminate\Http\JsonResponse
    {

        return response()->json( $request );
    }
}
