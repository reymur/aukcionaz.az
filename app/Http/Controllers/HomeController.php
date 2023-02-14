<?php

namespace App\Http\Controllers;

use App\Models\AudioVeVideo;
use App\Models\City;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubCategoryType;
use App\Models\SubCategoryTypeOnce;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

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
//            $res = AudioVeVideo::find(2);

//       $this->makeCategories();
//        $a = Product::all();
//        dd( $a[0]->productable->subCategory->category );
        $categories = $this->getCategoryByModelWithRelation( 'App\Models\Category', 'SubCategories');

        return view('home', ['categories' => $categories] );
    }

    public function showSubCategories( $name ) {
        // dd(  $id );
        $category = $this->getCategoryWithRelations($name, 'subCategories');

        return view('home.categories.show_sub_categories', [ 'category' => $category ]);
    }

    public function showSubCategoryTypes( $category, $sub_category  ) {
         dd(  $sub_category );
//        $category = $this->getCategoryWithRelations($id, 'subCategories');
//
//        return view('home.categories.show_sub_categories', [ 'category' => $category ]);
    }

    protected function getCategoryWithRelations($name, $relation) {

        if( is_string($relation) ) {
            $category = Category::where('slug', $name)->first();
            // dd(  $category );
            if( $category && $category->count() > 0 && $category->load($relation) ) return $category->load($relation) ;

            return false;
        }

        return false;
    }

    protected function getCategoryByModelWithRelation( $model, $relation ) {
        if( $model::with($relation ) ) {
            $res = $model::with($relation);
            if( $res && $res->count() ) return $model::with($relation)->get();
        }

        return false;
    }

    public function makeCategories()
    {
        include('../MY_FILES/CATEGORY/category.php');
        $cat = false;
        $sub_cat = false;
        $sub_cat_type = false;

         foreach( $category as $item ) {
             $cat = Category::create([
                 'name' => $item['name'],
                 'slug' => Str::slug($item['name'], '-'),
                 'image' => $item['image'],
             ]);
         }

         if($cat){
             include('../MY_FILES/CATEGORY/sub_category.php');
             foreach( $sub_category as $item ) {
                 $sub_cat = SubCategory::create([
                     'category_id' => $item['category_id'],
                     'name' => $item['name'],
                     'slug' => Str::slug($item['name'], '-'),
                 ]);
             }
         }
         if($sub_cat) {
             include('../MY_FILES/CATEGORY/sub_category_type.php');
             foreach( $sub_category_type as $item ) {
                 $sub_cat_type = SubCategoryType::create([
                     'sub_category_id' => $item['sub_category_id'],
                     'name' => $item['name'],
                     'slug' => Str::slug($item['name'], '-'),
                 ]);
             }
         }
        if($sub_cat_type) {
            include('../MY_FILES/CATEGORY/sub_category_type_one.php');
            foreach( $sub_category_type_one as $item ) {
                SubCategoryTypeOnce::create([
                    'sub_category_type_id' => $item['sub_category_type_id'],
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name'], '-'),
                ]);
            }
        }

        include('../MY_FILES/select.php');
        foreach( $cities as $item ) {
            City::create([
                'city' => $item['city']
            ]);
        }
    }
}
