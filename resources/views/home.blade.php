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

                        <!-- Vertical Modals Kataloq all category -->
                        <div class="">
                            @include('home.modals.modal_home_category', [$categories])
                        </div>

                        <!-- Horizontal Modals Kataloq all category -->
                        @if( isset($categories) && $categories && $categories->count() > 0 )
                            <div class="d-flex category__child_div" id="category__child_div">
                                @foreach ( $categories as $key => $category )
                                    @include('home.crumbs.category_child_elements', ['id' => $key,'category' => $category])
                                @endforeach
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- ANNOUNCE PRODUCTS -->
        <div class="col-12">

            <!-- ANNOUNCE PRODUCT CARDS -->
            @if( isset($products) && $products && $products->count() )
                @include('products.product_card', ['products' => $products])
            @endif

        </div>
    </div>
@endsection
