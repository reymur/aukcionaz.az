@extends('layouts.app')


@section('content')
    <div class="">
        <!-- IMAGE SHOW SECTION -->
        <div class="">
            <product-show></product-show>
        </div>

        <div class="p-3">  
            <!-- PRICE AND TITLE SHOW SECTION -->
            <div class="p-2 mb-3"> 
                <div class="">
                    <p class="h5 fw-bolder text-bold pb-0 mb-1">
                        43 <span class=" text-uppercase">azn</span>
                    </p>
                    <span class="h5 text-black">Title</span>
                </div>
            </div>

            <!-- CITY AND TYPE SECTION -->
            <div class="product__show_city_and_type">
                <table class="table mb-2">
                    <tbody>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0" scope="row">Şəhər</th>
                            <td class="border-0">Bakı</td>
                        </tr>
                        
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0" scope="row">Malın növü</th>
                            <td class="border-0">
                                <a href="" class="">
                                    Malın növü
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- ABOUT TEXT SECTION -->
            <div class="product__show_about_text p-2 mt-3">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit ducimus blanditiis tempore dolore. Architecto dignissimos soluta voluptate alias cumque officia tempore porro quo perspiciatis. Qui voluptatum nam non modi praesentium?
            </div>

            <!-- PRODUCT ADDED USER INFO SECTION -->
            <div class="p-2 product__user_info">
                <div class="d-flex">
                    <div class="col">
                        <div class="">User name</div>
                        <div class="">
                            <a href="" class="">
                                User all announces
                            </a>
                        </div>
                    </div>

                    <div class="product__user_info_avatar_div">
                        <img src="{{ asset('images/avatar/avatar.jpeg') }}" alt="" class="product__user_info_avatar">
                    </div>
                </div>

                <div class="product__user_phone_div d-flex p-2">
                    <div class="col d-flex product__user_phone_icon_number_div">
                        <div class="product__user_phone_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                        </div>
                        <div class="product__user_phone_number">
                            <a href="" class="">
                                (070) 345-00-66
                            </a>
                        </div>
                    </div>
                    
                    <div class="product__user_phone">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- ANNOUNCE PRODUCTS -->
        <div class="col-12">
           <!-- ANNOUNCE PRODUCT CARDS -->
           @include('announce.announce_card')
       </div>
    </div>

@endsection



