
@if( $product )
    <div class="mt-4">
        <div class="d-flex mb-3 product__tez_sat_div">
            <div class="fs-5 product__tez_sat_text">Tez satmaq üçüçn</div>
            <div class="pt-1 ps-3 ">
                <svg style="transform: rotateX(183deg)" xmlns="http://www.w3.org/2000/svg" width="22"
                     height="22" fill="currentColor" class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                    <path
                        d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z"/>
                </svg>
            </div>
        </div>

        <div class="d-flex px-3 mb-2 product__tez_sat_bussines_div">
            <div class="col p-2 ">
                <div class="d-flex product__tez_sat_do_first_div">
                    <div class=" fw-bolder fs-6">İRƏLİ çək</div>
                    <div class="product__tez_sat_first_icon_div">
                        <img src="{{ asset('/images/icons/first-icon.png') }}" alt=""
                             class="product__tez_sat_first_icon">
                    </div>
                </div>
                <div class=""> Elanın 1-ci sıraya qaldırılması</div>
            </div>

            <div class="product__tez_sat_do_first_price_parent_div">
                <div class="product__tez_sat_do_first_price_div"> 1 AZN</div>
            </div>
        </div>

        <div class="d-flex px-3 mb-2 product__tez_sat_bussines_div">
            <div class="col p-2 ">
                <div class="d-flex product__tez_sat_do_first_div">
                    <div class=" fw-bolder fs-6">VIP et</div>
                    <div class="product__tez_sat_vip_icon_div">
                        <img src="{{ asset('/images/icons/vip-icon_1.png') }}" alt=""
                             class="product__tez_sat_vip_icon">
                    </div>
                </div>
                <div class=""> Yuxarı hissədə, VIP blokunda görünür</div>
            </div>

            <div class="product__tez_sat_do_first_price_parent_div">
                <div class="product__tez_sat_do_first_price_div"> 1 AZN</div>
            </div>
        </div>

        <div class="d-flex px-3 product__tez_sat_bussines_div">
            <div class="col p-2 ">
                <div class="d-flex product__tez_sat_do_first_div">
                    <div class=" fw-bolder fs-6">PREMIUM et</div>
                    <div class="product__tez_sat_premium_icon_div">
                        <img src="{{ asset('/images/icons/premium-icon.png') }}" alt=""
                             class="product__tez_sat_premium_icon">
                    </div>
                </div>
                <div class=""> Premium bloku: İRƏLİ + VİP + PREMİUM edir</div>
            </div>

            <div class="product__tez_sat_do_first_price_parent_div">
                <div class="product__tez_sat_do_first_price_div"> 1 AZN</div>
            </div>
        </div>
    </div>
@endif

