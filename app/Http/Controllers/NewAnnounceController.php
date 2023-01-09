<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategoryType;

class NewAnnounceController extends Controller
{
    public function index() {
        // $categories = Category::with('SubCategories')->get() ?? false;
        $categories = $this->getCategoryWithRelation( 'App\Models\Category', 'SubCategories');
        $cities     = City::all();

        return view('announce.new_announce', [
            'categories' => $categories,
            'cities' => $cities,
        ]);
    }

    public function getSubCategoryTypes(Request $request): \Illuminate\Http\JsonResponse
    {
        if( isset($request->id) ) {
            $res = SubCategoryType::where('sub_category_id', $request->id )->get();
        }
        return response()->json([
             "sub_category_types" => $res
        ]);
    }

    protected function getCategoryWithRelation( $model, $relation ) {
        if( $model::with($relation) !== null ) {
            return  $model::with($relation)->get();
        }

        return false;
    }
}
