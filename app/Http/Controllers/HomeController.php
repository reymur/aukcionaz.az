<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubCategoryType;
use App\Models\SubCategoryTypeOnce;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // include('../MY_FILES/CATEGORY/sub_category_type_one.php');

        // // dd( $category );
        // foreach( $sub_category_type_one as $cat ) {
        //     SubCategoryTypeOnce::create([
        //         // 'sub_category_type_id' => $cat['sub_category_type_id'],
                
        //         'name' => $cat['name'],
        //         'sub_category_type_id' => $cat['sub_category_type_id']
        //     ]);
        // }

        $categories = Category::all();
        // dd( $categories->load('subcategories') );
        return view('home', ['categories' => $categories->load('subCategory')]);
    }

    public function getImages() {
        $images = collect([
            (object) [
                'name' => 'for_house_category.png'
            ],
            (object) [
                'name' => 'car_category1.png'
            ],
            (object) [
                'name' => 'd2.png'
            ],
            (object) [
                'name' => 'house_category.png'
            ],
            (object) [
                'name' => 'clothes_category3.png'
            ],
            (object) [
                'name' => 'services_business_category2.png'
            ],
            (object) [
                'name' => 'hobi_category.png'
            ],
            (object) [
                'name' => 'children_world_category.png'
            ],
            (object) [
                'name' => 'animals_category.png'
            ],
            (object) [
                'name' => 'work_category.png'
            ],
             (object) [
                'name' => 'stores_category.png'
            ],
        ]);


        return $images;
    }
}
