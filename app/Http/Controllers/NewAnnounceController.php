<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewAnnounceController extends Controller
{
    public function index() {
        return view('announce.new_announce');
    }
}
