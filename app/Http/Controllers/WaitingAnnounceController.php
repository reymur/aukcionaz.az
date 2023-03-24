<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WaitingAnnounceController extends Controller
{
    public function index($id)
    {
        if (! $id ) abort(404);

        $waiting_product = GetProductByIdHelper($id);

        return view('announce.witing_announce', ['waiting_product' => $waiting_product]);
    }


}
