@extends('layouts.app')


@section('content')
    <div class="">
        @if( isset($product) && $product )
            <!-- PRODUCT IMAGE SHOW SECTION -->
            <div class="">
                <product-show
                    :product="{{ $product }}"
                ></product-show>
            </div>

            <div class="p-3">
                <!-- PRODUCT PRICE AND TITLE SECTION -->
                <div class=" d-flex p-2 mb-3">
                    <div class="col-5">
                        <p class="h5 fw-bolder text-bold pb-0 mb-1 fs-4">
                            <span class="pe-2"> {{ $product->price ?? '' }} </span>
                            <span class=" text-uppercase">azn</span>
                        </p>
                        <span class="h5 text-black"> {{ $product->title  ?? ''}} </span>
                    </div>

                    <div class="col-7">
                        <a href="" type="button" role="button"
                           class="btn btn-danger position-absolute pb-2 text-uppercase fw-bolder px-4 py-2 aukcion__is_active_btn active-aukcion">
                            Auksiyon
                        </a>
                    </div>
                </div>

                <!-- PRODUCT CITY AND TYPE SECTION -->
                <div class="product__show_city_and_type">
                    <table class="table mb-2">
                        <tbody>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0" scope="row">Şəhər</th>
                            <td class="border-0 fw-bolder"> {{ $product->city ?? '' }} </td>
                        </tr>

                        <tr>
                            <th class="col-2 text-muted fw-normal border-0" scope="row">Malın növü</th>
                            <td class="border-0">
                                <a href="" class="fw-bolder error__letter_spacing">
                                    {{ $product->type ?? ''}}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- PRODUCT ABOUT TEXT SECTION -->
                @if( $product->about )
                    <div class="product__show_about_text px-2 mt-3">
                        <div class="" id="product-about-text">
                            {{ Illuminate\Support\Str::words(
                                $product->about, 10,'......'
                            ) }}
                            <div class="text-primary" role="button" onclick="showProductAboutText()">Davamını oxu</div>
                        </div>

                        <div class="" id="product-about-full-text">
                            {{ $product->about }}
                        </div>
                    </div>
                @endif

                @if( $product->user )
                    <!-- PRODUCT OWNER USER INFO -->
                    <div class="ps-2 product__user_info">
                        @if( $product->user->name )
                            <div class="d-flex">
                                <div class="col">
                                    <div class="">{{ $product->user->name ?? '' }}</div>
                                    <div class="">
                                        <a href="" class="">
                                            {{ $product->user->name ?? '' }} all announces
                                        </a>
                                    </div>
                                </div>

                                <div class="product__user_info_avatar_div">
                                    <img src="{{ asset('images/avatar/avatar.jpeg') }}" alt="" class="product__user_info_avatar">
                                </div>
                            </div>
                        @endif

                        @if( $product->phones->count() )
                            <div class="product__user_phone_div">
                                <a href="tel:0502536564" class="d-flex p-2">
                                    <div class="col d-flex product__user_phone_icon_number_div">
                                        <div class="product__user_phone_icon d-flex pe-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="blue"
                                                 class="bi bi-telephone-fill align-self-center" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                            </svg>
                                        </div>
                                        <div class="product__user_phone_number">
                                            @foreach( $product->phones as $phone )
                                                <div class="row pb-1">{{ $phone->phone }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="d-flex product__user_phone">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                             class="bi bi-chevron-right text-muted align-self-center" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
                <!-- PRODUCT (ANNOUNCE NUMBER) AND (SIEN COUNT) AND (UPDATED) SECTION -->
                <div class="pb-1 product__number_sien_updated_div">
                    <table class="table mb-2">
                        <tbody>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Elanın nömrəsi</th>
                            <td class="border-0 py-0">{{ $product->number }}</td>
                        </tr>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Baxışların sayı</th>
                            <td class="border-0 py-0">{{ $product->seen }}</td>
                        </tr>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Yeniləndi</th>
                            <td class="border-0 py-0">{{ $product->updated_at->diffForHumans() }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="d-flex pb-2 mt-3">
                        <div class="me-3 text-capitalize">
                            <a href="" class="py-2 px-3"> Elanı düzəlt </a>
                        </div>
                        <div class=" text-capitalize">
                            <a href="" class="py-2 px-3"> Elanı sil </a>
                        </div>
                    </div>
                </div>

                <!-- To Sale Quicly (tez satmaq ucun) SECTION -->
                @include('products.crumbs.to_sale_quickly', $product)

            </div>

            <!-- ANNOUNCE PRODUCTS -->
            <div class="col-12">
                <!-- ANNOUNCE PRODUCT CARDS -->
                @include('products.product_card')
            </div>
        @endif
    </div>

@endsection



