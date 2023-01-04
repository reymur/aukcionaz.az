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
        // include('../MY_FILES/CATEGORY/sub_category_type.php');

        // // dd( $category );
        // foreach( $sub_category_type as $cat ) {
        //     SubCategoryType::create([
        //         // 'sub_category_type_id' => $cat['sub_category_type_id'],
                
        //         'name' => $cat['name'],
        //         'sub_category_id' => $cat['sub_category_id']
        //     ]);
        // }

        $categories = $this->getAllCategories();
       
        return view('home', ['categories' => $categories->load('subCategories')]);
    }

    public function showSubCategories( $id, $name  ) {
        // dd(  $id );
        $category = $this->getCategoryWithRelations($id, 'subCategories');
        
        return view('home.categories.show_sub_categories', [ 'category' => $category ]);
    }

    protected function getCategoryWithRelations($id, $relation) {

        if( is_string($id) && is_string($relation) ) {
            $category = Category::where('id', $id)->first();
            // dd(  $category );
            if( $category && $category->count() > 0 && $category->load($relation) ) return $category->load($relation) ;

            return false;
        }

        return false;
    }

    protected function getAllCategories() {
        return $categories = Category::all();
    }
}
