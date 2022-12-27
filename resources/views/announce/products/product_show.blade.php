@extends('layouts.app')


@section('content')
    <div class="">
        <!-- PRODUCT IMAGE SHOW SECTION -->
        <div class="">
            <product-show></product-show>
        </div>

        <div class="p-3">  
            <!-- PRODUCT PRICE AND TITLE SECTION -->
            <div class=" d-flex p-2 mb-3"> 
                <div class="col-5">
                    <p class="h5 fw-bolder text-bold pb-0 mb-1">
                        43 <span class=" text-uppercase">azn</span>
                    </p>
                    <span class="h5 text-black">Title</span>
                </div>

                <div class="col-7">
                    <a href="" type="button" class="btn btn-danger text-uppercase fw-bolder px-4 py-2 aukcion__is_active_btn active-aukcion">
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

            <!-- PRODUCT ABOUT TEXT SECTION -->
            <div class="product__show_about_text px-2 mt-3">
                <div class="" id="product-about-text">
                    {{ Illuminate\Support\Str::words(
                        'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit ducimus blanditiis tempore dolore. Architecto dignissimos soluta voluptate alias cumque officia tempore porro quo perspiciatis. Qui voluptatum nam non modi praesentium?'
                        , 10,'......'
                    ) }}
                    <div class="text-primary" role="button" onclick="showProductAboutText()">Davamını oxu</div>
                </div>
                
                <div class="" id="product-about-full-text">  
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit ducimus blanditiis tempore dolore. Architecto dignissimos soluta voluptate alias cumque officia tempore porro quo perspiciatis. Qui voluptatum nam non modi praesentium?
                </div>
            </div>

            <!-- PRODUCT ADDED USER INFO SECTION -->
            <div class="ps-2 product__user_info">
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

                <div class="product__user_phone_div">
                    <a href="tel:0502536564" class="d-flex p-2">
                        <div class="col d-flex product__user_phone_icon_number_div">
                            <div class="product__user_phone_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                            </div>
                            <div class="product__user_phone_number">
                                (070) 345-00-66
                            </div>
                        </div>
                        
                        <div class="product__user_phone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right text-muted" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                    </a>
                </div> 
            </div>

            <!-- PRODUCT (ANNOUNCE NUMBER) AND (SIEN COUNT) AND (UPDATED) SECTION -->
            <div class="pb-1 product__number_sien_updated_div"> 
                <table class="table mb-2">
                    <tbody>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Elanın nömrəsi</th>
                            <td class="border-0 py-0">35209851</td>
                        </tr>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Baxışların sayı</th>
                            <td class="border-0 py-0">621</td>
                        </tr>
                        <tr>
                            <th class="col-2 text-muted fw-normal border-0 py-0" scope="row">Yeniləndi</th>
                            <td class="border-0 py-0">Bugün, 12:13</td>
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
            <div class="mt-4">
                <div class="d-flex mb-3 product__tez_sat_div">
                    <div class="fs-5 product__tez_sat_text" >Tez satmaq üçüçn </div>
                    <div class="pt-1 ps-3 "> 
                        <svg style="transform: rotateX(183deg)" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                            <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z"/>
                        </svg>    
                    </div>
                </div>
                
                <div class="d-flex px-3 mb-2 product__tez_sat_bussines_div">
                    <div class="col p-2 ">
                        <div class="d-flex product__tez_sat_do_first_div">
                            <div class=" fw-bolder fs-6">İRƏLİ çək</div>
                            <div class="product__tez_sat_first_icon_div">
                                <img src="{{ asset('/images/icons/first-icon.png') }}" alt="" class="product__tez_sat_first_icon">
                            </div>
                        </div>
                        <div class=""> Elanın 1-ci sıraya qaldırılması </div>
                    </div>

                    <div class="product__tez_sat_do_first_price_parent_div">
                        <div class="product__tez_sat_do_first_price_div"> 1 AZN </div>
                    </div>
                </div>

                <div class="d-flex px-3 mb-2 product__tez_sat_bussines_div">
                    <div class="col p-2 ">
                        <div class="d-flex product__tez_sat_do_first_div">
                            <div class=" fw-bolder fs-6">VIP et</div>
                            <div class="product__tez_sat_vip_icon_div">
                                <img src="{{ asset('/images/icons/vip-icon_1.png') }}" alt="" class="product__tez_sat_vip_icon">
                            </div>
                        </div>
                        <div class=""> Yuxarı hissədə, VIP blokunda görünür </div>
                    </div>

                    <div class="product__tez_sat_do_first_price_parent_div">
                        <div class="product__tez_sat_do_first_price_div"> 1 AZN </div>
                    </div>
                </div>

                <div class="d-flex px-3 product__tez_sat_bussines_div">
                    <div class="col p-2 ">
                        <div class="d-flex product__tez_sat_do_first_div">
                            <div class=" fw-bolder fs-6">PREMIUM et</div>
                            <div class="product__tez_sat_premium_icon_div">
                                <img src="{{ asset('/images/icons/premium-icon.png') }}" alt="" class="product__tez_sat_premium_icon">
                            </div>
                        </div>
                        <div class=""> Premium bloku: İRƏLİ + VİP + PREMİUM edir </div>
                    </div> 

                    <div class="product__tez_sat_do_first_price_parent_div">
                        <div class="product__tez_sat_do_first_price_div"> 1 AZN </div>
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



