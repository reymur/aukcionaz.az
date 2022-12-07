@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="col-12 bg-white border__bottom_opacity-10">

            <!-- SEARCH INPUT -->
            <div class="col-11 m-auto">
                <div class="input-group ">
                    <input type="text" class="form-control" aria-label="Text input with radio button">

                    <div class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                          </svg>
                    </div>
                </div>
            </div>

            <!-- CATEGORY -->
            <div class="mt-3">
                <div class="col-11 m-auto overflow-scroll">
                    <ul class="list-group list-group-horizontal">
                        
                        <!-- Modals Kataloq category -->
                        @include('home.modals.modal_home_category')

                        <li class="category__image_li-styles">
                            <img src="{{ asset('images/category/all-categories.png') }}" alt="" class="category__image-styles">
                            <p class="text-center lh-1">Kataloq</p>
                        </li>
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
