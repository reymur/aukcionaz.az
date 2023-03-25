<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WaitingProductController extends Controller
{
    public function index($id)
    {
        if (! $id ) abort(404);

        $waiting_product = GetProductByIdHelper($id);

        return view('products.waiting_product', ['waiting_product' => $waiting_product]);
    }


}
