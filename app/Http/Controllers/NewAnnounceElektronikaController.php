<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewAnnounceElektronikaController extends Controller
{
    public function audioVeVideo(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json( $request->data );
    }
}
