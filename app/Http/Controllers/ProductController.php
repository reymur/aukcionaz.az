<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('web');
    }

    public function index($id) {

        $product = GetProductByIdHelper($id) ?? false;

        return view('products.product_show', ['product' => $product]);
    }

}
