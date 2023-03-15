@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="col-12 bg-white border__bottom_opacity-10">

            <!-- SEARCH INPUT -->
            @include('home.forms.search_home_input')

            <!-- CATEGORY -->
            <div class="mt-3 mt-lg-5 mt-xl-5 mb-2 main__category_div">
                <div class="col-12 col-lg-10 col-xl-10 m-auto px-3 scroll__hide overflow-scroll ">
                    <ul class="list-group list-group-horizontal">
                        <!-- SHOW SubCategories -->
                        @if( isset($category) && $category !== false && $category->count() > 0 )
                            <div class="d-flex pe-3 category__child_div" id="category__child_div">
                                @include('home.categories.crumbs.show_sub_category_name', ['category' => $category])
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- ANNOUNCE PRODUCTS -->
        <div class="col-12">

            <!-- ANNOUNCE PRODUCT CARDS -->
            @include('products.product_card')

        </div>
    </div>
@endsection
