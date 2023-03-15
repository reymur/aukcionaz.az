<template>
    <div class="collapse-picker" id="collapsePicker">
        <div class="card card-body position-relative">
            <div class="col mt-3 mb-4">

                <div class="">
                    <div class="d-flex mb-2 date_and_time_pickers_titles_div">
                        <div class="fs-5 fw-bold m-auto">Başlama tarixi</div>
                        <div class="fs-5 fw-bold m-auto">Başlama saatı</div>
                    </div>
                    <div class="col d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex">

                        <div class="col d-flex me-sm-2 me-md-2 me-lg-2 me-xl-2 me-xxl-2 mb-3 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0">
                            <div class="col d-flex justify-content-center aukcion__date_picker_div">
                                <div class="d-flex aukcion_date_icon_div">
                                    <img src="/images/icons/date_icon.png" alt="" class="aukcion_date_icon">
                                </div>

                                <data-picker
                                    :reset_al_time="reset_al_time"
                                    @timePickerIsChanged="changeValueResetAlTime"
                                ></data-picker>
                            </div>
                        </div>

                        <div class="col d-flex">
                            <div class="col d-flex justify-content-center aukcion__time_picker_div">
                                <div class="d-flex aukcion_time_icon_div">
                                    <img src="/images/icons/time_icon.png" class="aukcion_time_icon" alt="">
                                </div>

                                <time-picker
                                    :reset_al_time="reset_al_time"
                                    @timePickerIsChanged="changeValueResetAlTime"
                                ></time-picker>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div href="#" @click="resetDateAndTime" type="button" class="link-danger reset__data_time">Sıfırla</div>

            <!--  RUN AUKCION NEW TIME COLLAPSE START  -->
            <div class="col mb-3 on_time_aukcion">
                <div class="col d-block d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex">
                    <div class="d-flex justify-content-center fs-5 mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0 me-2 rounded-0 do__akcion_on_time">
                        <span class="auksiyon_text_style">Auksion </span> saatla olsun?
                    </div>
                    <div class="col d-flex">
                        <input type="radio" class="btn-check" name="on-later-time" id="no-later-time" autocomplete="off" checked>
                        <label @click="runLaterTimeAukcionClose" class="col btn btn-outline-danger rounded-0 px-4 w-25" for="no-later-time">Xeyir</label>

                        <input type="radio" class="btn-check" name="on-later-time" id="yes-later-time" autocomplete="off">
                        <label @click="runLaterTimeAukcion" class="col btn btn-outline-success rounded-0 px-4 w-25" for="yes-later-time">Bəli</label>
                    </div>
                </div>


                <div class="" id="runLaterTimeAukcionCollapse">
                    <div class="card card-body">
                        <on-later-time-aukcion
                            :reset_al_time="reset_al_time"
                        ></on-later-time-aukcion>
                    </div>
                </div>
            </div>
            <!-- RUN AUKCION NEW TIME COLLAPSE END -->
        </div>


    </div>
</template>

<script>
export default {
    name: "LaterTimeAukcion",
    data() {
        return {
            reset_al_time: false,
        }
    },
    methods:{
        changeValueResetAlTime(data) {
            if( data ) {
                this.reset_al_time = false;
            }
        },
        resetDateAndTime() {
            this.reset_al_time = true;
        },
        runLaterTimeAukcionClose() {
            let runLaterTimeAukcionCollapse = document.getElementById('runLaterTimeAukcionCollapse');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');

            if( runLaterTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                    setTimeout( () => {
                        if( on_time_aukcion[0].style ) {
                            on_time_aukcion[0].style.marginTop = '0';
                        }
                    }, 210 )
                }

                runLaterTimeAukcionCollapse.style.maxHeight = '0';

                setTimeout( () => {
                    runLaterTimeAukcionCollapse.style.marginTop = '0';
                }, 100);
            }
        },
        runLaterTimeAukcion() {
            let runLaterTimeAukcionCollapse = document.getElementById('runLaterTimeAukcionCollapse');
            let collapsePicker = document.getElementById('collapsePicker');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');
            let card = document.getElementsByClassName('card');

            if( runLaterTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                    if( on_time_aukcion[0].style ) {
                        on_time_aukcion[0].style.border = 'none';
                    }
                }

                let he = setInterval( () => {
                    if( collapsePicker.style.maxHeight && card && card[0] ) clearInterval(he);
                    console.log('card[0] - ', card[0].scrollHeight )
                    let heig = Number( collapsePicker.scrollHeight );
                    let heig_2 = Number( collapsePicker.scrollHeight );
                    collapsePicker.style.maxHeight = (heig+heig_2)+'px';
                    runLaterTimeAukcionCollapse.style.maxHeight = (runLaterTimeAukcionCollapse.scrollHeight + 5 )+'px';
                    runLaterTimeAukcionCollapse.style.marginTop = '15px';
                }, 0.1 );

                setTimeout( () => {
                    clearInterval(he);
                }, 3000 );
            }
        },
    }
}
</script>

<style scoped>

    .aukcion_time_icon {
        height: 30px;
        width: 30px;
        align-self: center;
        opacity: 0.7;
    }
    .aukcion_date_icon_div {
        position: absolute;
        left: 5px;
        top: 3px;
        z-index: 1;
    }
    .aukcion_time_icon_div {
        position: absolute !important;
        align-self: center;
        left: 5px;
    }
    .auksiyon_text_style {
        font-size: 1em;
        color: #41830b;
        font-weight: bold;
    }
    .reset__data_time {
        bottom: 0;
        font-size: 1rem;
        position: absolute;
        text-decoration: underline;
    }
    #runLaterTimeAukcionCollapse {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
</style>
