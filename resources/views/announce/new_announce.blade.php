@extends('layouts.app')

@section('content')
   <div class="">
    {{-- {{ dd( $cities ) }} --}}
        <div class="col-12">
            <!-- NEW ANNOUNCE ADD CATEGORIES -->
            <div class="bg-white w-100 mt-0 mb-3 p-0">
                <new-announce
                    :categories="{{ $categories }}"
                    :cities="{{ $cities }}"
                ></new-announce>

{{--                <index-audio-ve-video--}}
{{--                    :categories="{{ $categories }}"--}}
{{--                    :cities="{{ $cities }}"--}}
{{--                ></index-audio-ve-video>--}}
            </div>
        </div>
    </div>
@endsection

