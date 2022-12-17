<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    public function __construct()
    {
        return $this->middleware('web');
    }

    public function index() {
        // return view();
    }
}
