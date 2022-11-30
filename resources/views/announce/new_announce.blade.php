@extends('layouts.app')

@section('content')
   <div class="">

        <div class="col-12">
            <div class="bg-white w-100 mt-1 mb-2 p-0">
                @include('announce.modals.modal_category')
            </div>

            <div class="cbg-white w-100 mt-1 mb-2 p-0">
                <div class="border-0 ">
                    @include('announce.modals.modal_price')
                </div>

                <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>

                <div class="">
                    @include('announce.modals.modal_city')
                </div>
            </div>
        </div>

   </div>
@endsection

