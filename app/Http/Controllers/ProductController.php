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

    public function NoPublishedProduct() {
        session_start();

        if( ! isset($_SESSION['product_id']) ) return redirect()->route('home');

        $product_id = $_SESSION['product_id'];

        $no_published = GetProductByIdHelper( $product_id );

        session_destroy();

        return view('products.no_published_product', ['no_published' => $no_published]);
    }

}
