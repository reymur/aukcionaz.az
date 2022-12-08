@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="col-12 bg-white border__bottom_opacity-10">

            <!-- SEARCH INPUT -->
            @include('home.forms.search_home_input')

            <!-- CATEGORY -->
            <div class="mt-3 mt-lg-4 mt-xl-4 mb-2"> 
                <div class="col-12 col-lg-10 col-xl-10 m-auto px-3 scroll__hide overflow-scroll ">
                    <ul class="list-group list-group-horizontal">
                        
                        <!-- Modals Kataloq category -->
                        @include('home.modals.modal_home_category')

                        <!-- Category child elements -->
                        
                        @isset( $images )
                            @foreach ( $images as $image )
                                @include('home.crumbs.category_child_elements', [$image])
                            @endforeach
                        @endisset
                    </ul>
                </div>
            </div>
        </div>

        <!-- ANNOUNCES -->
        <div class="col-12">

            <!-- ANNOUNCE CARDS -->
            @include('announce.announce_card')

        </div>
    </div>
@endsection
