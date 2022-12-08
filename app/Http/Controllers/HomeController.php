<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

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
        return view('home', ['images' => $this->getImages()]);
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
