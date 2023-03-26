@extends('layouts.app')

@section('content')
    <div class="container no_published_main_div">
        <!-- NEW ANNOUNCE INFO -->
        @isset($no_published)
            @if( $no_published->id )
{{--                <div class="mt-4">--}}
{{--                    <a href="/" class="fs-3 fw-bold d-flex justify-content-center text-decoration-none text-black">Aukcionaz.az</a>--}}
{{--                </div>--}}

                <div class="m-auto align-self-center">
                    <div class="fs-4 mb-5 text-center">
                        <span class="fs-2 fw-bold me-1">{{ $no_published->title }}</span>
                        elanınız yoxlama mərhələsindədir. <br>
                        Elanınız təstiqləndikdən sonra elanlar bölməsində yerləşdiriləcək.
                    </div>

                    <div class="col-10 col-sm-6 col-md-5 col-lg-4 col-xl-4 col-xxl-4 m-auto py-1 bg-success bg-opacity-10">
                        <div class="d-flex justify-content-center">
                            <div class="fs-4 text-uppercase me-2"> pin: </div>
                            <div class="fs-4 text-black"> {{ $no_published->pin }} </div>
                        </div>

                        <div class="fs-6 d-flex justify-content-center text-decoration-underline ms-3 mt-n1">
                            PIN nömrəni yadda saxlayın.
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="mt-5 d-flex fs-5 text-center">
                            <div class="me-1">
                                Elana baxış
                            </div>

                            <div class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </div>

                            <a href="{{ route('product', ['id' => $no_published->id]) }}" class="">
                                {{ $no_published->title }}
                            </a>

                            <div class="ms-3 me-3 text-black fs-5">|</div>

                            <a href="/" class="">Çıxış</a>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM BORDER -->
{{--                <hr class="w-75 m-auto"/>--}}

                <!-- ADD AUKCION -->
{{--                <div class="d-flex justify-content-center mt-4">--}}
{{--                    <!-- ADD ON AUKCION -->--}}
{{--                    <div class="">--}}
{{--                        <div class="d-flex justify-content-center fs-4 fw-bold mb-2">--}}
{{--                            <span class="fs-3 text-success me-1">Aukcion</span>--}}
{{--                            <span class="m-auto"> - da daha tez sat</span>--}}
{{--                        </div>--}}

{{--                        <div class="d-flex py-3">--}}
{{--                            <div class="align-self-center me-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">--}}
{{--                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}

{{--                            @if( $no_published && $no_published->publish > 0 )--}}
{{--                                <div class="">--}}
{{--                                    <add-on-aukcion--}}
{{--                                        :product_info="{{ $no_published }}"--}}
{{--                                    ></add-on-aukcion>--}}
{{--                                </div>--}}
{{--                            @endif--}}

{{--                            <div class="align-self-center ms-2">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">--}}
{{--                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <!-- WHAT IS AUKSIYON? -->--}}
{{--                        @include('products.crumbs.what_is_auksiyon')--}}

{{--                    </div>--}}
{{--                </div>--}}
            @endif
        @endisset
    </div>
@endsection
