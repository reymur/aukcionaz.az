<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class NewAnnounceController extends Controller
{
    public function index() {
        // $categories = Category::with('SubCategories')->get() ?? false;
        $categories = $this->getCategoryWithRelation( 'App\Models\Category', 'SubCategories');

        return view('announce.new_announce', ['categories' => $categories]);
    }

    protected function getCategoryWithRelation( $model, $relation ) {
        if( $model::with($relation) !== null ) {
            return  $model::with($relation)->get();
        }

        return false;
    }
}
