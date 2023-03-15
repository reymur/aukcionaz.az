@extends('layouts.app')

@section('content')
   <div class="">
        <div class="col">
            <!-- NEW ANNOUNCE ADD CATEGORIES -->
            <div class="bg-white w-100 mt-0 mb-3 p-0">
                <new-announce
                    :categories="{{ $categories }}"
                    :cities="{{ $cities }}"
                ></new-announce>
            </div>
        </div>
    </div>
@endsection

