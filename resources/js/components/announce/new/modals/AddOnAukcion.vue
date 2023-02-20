<template>
    <div class="">

        <!-- Button trigger modal -->
        <button @click="modalBackdrop" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <span class="aukcion__add_button_text"> Auksion əlavə et</span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="col-11 modal-title aukcion__title_div" id="staticBackdropLabel">
                            <div class="d-flex m-auto ms-sm-4 ms-md-4 ms-lg-4 ms-xl-4 ms-xxl-4 justify-content-center">
                                <span class="me-1 aukcion__first_title"> Auksion </span>
                                <span class="align-self-center aukcion__second_title"> - da daha tez sat!</span>
                            </div>
                        </h1>
                        <button @click="hideDateTimePickers" type="button" class="col-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="col d-flex mb-3">
                                <div class="col">
                                    <input type="radio" class="btn-check" name="options-outlined" id="new-button" autocomplete="off" checked>
                                    <label @click="newAukcion" class="btn btn-outline-success rounded-0 px-4 w-100" for="new-button">Indi</label>
                                </div>
                                <div class="col">
                                    <input type="radio" class="btn-check" name="options-outlined" id="later">
                                    <label @click="laterAukcion" class="btn btn-outline-success rounded-0 px-4 w-100" for="later">Sonra</label>
                                </div>
                            </div>

                            <!-- CURRENT TIME AUKCION START -->
                            <div class="" id="runCurrentTimeAukcion">
                                <div class="card card-body">
                                    <div class="col">
                                        <div class="col">

                                            <div class="d-flex ms-2 mb-3 pb-2 date_and_time_pickers_titles_div">
                                                <div class="fs-5 d-block d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex">
                                                    <div class="me-3 to_start_aukcion_title">
                                                        <span class="auksiyon_text_style">Auksion </span>
                                                        <span class="">başlasın:</span>
                                                    </div>
                                                    <div class="">
                                                        {{ today.toLocaleDateString() }} | {{ current_time_show }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col ms-2 mb-3 on_time_aukcion">
                                                <div class="col pb-3 d-block d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex ">
                                                    <div class="fs-5 mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0 me-2 rounded-0 do__akcion_on_time">
                                                        <span class="auksiyon_text_style">Auksion </span> saatla olsun?
                                                    </div>
                                                    <div class="col d-flex">
                                                        <input type="radio" class="btn-check" name="on-time" id="no-time" autocomplete="off" checked>
                                                        <label @click="runNowTimeAukcionClose" class="col btn btn-outline-danger rounded-0 px-4 w-25" for="no-time">Xeyir</label>

                                                        <input type="radio" class="btn-check" name="on-time" id="yes-time" autocomplete="off">
                                                        <label @click="runNowTimeAukcion" class="col btn btn-outline-success rounded-0 px-4 w-25" for="yes-time">Bəli</label>
                                                    </div>
                                                </div>

                                                <!--  RUN AUKCION NEW TIME COLLAPSE START  -->
                                                <div class="" id="runNowTimeAukcionCollapse">
                                                    <div class="card card-body">
                                                        <div class="col">
                                                            <div class="col">

                                                                <div class="d-flex ms-2 mb-3 pb-2 date_and_time_pickers_titles_div">
                                                                    <div class="fs-5 d-block d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex">
                                                                        <div class="me-3 to_start_aukcion_title">
                                                                            <span class="auksiyon_text_style">Auksion </span>
                                                                            <span class="">davam etsin:</span>
                                                                        </div>
                                                                        <div class="">
                                                                            aaa
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- RUN AUKCION NEW TIME COLLAPSE END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CURRENT TIME AUKCION END -->

                            <!-- LATER TIME DATA AND TIME PICKERS COLLAPSE START -->
                            <div class="collapse-picker" id="collapsePicker">
                                <div class="card card-body position-relative">
                                    <div class="col mt-3 mb-4">

                                        <div class="">
                                            <div class="d-flex mb-2 date_and_time_pickers_titles_div">
                                                <div class="fs-5 fw-bold m-auto">Başlama tarixi</div>
                                                <div class="fs-5 fw-bold m-auto">Başlama saatı</div>
                                            </div>
                                            <div class="col d-flex">
                                                <div class="col d-flex">
                                                    <div class="d-flex aukcion_date_icon_div">
                                                        <img src="/storage/images/icons/aukcion_date_icon.png" alt="" class="aukcion_date_icon">
                                                    </div>

                                                    <div class="col d-flex justify-content-center aukcion__date_picker_div">
                                                        <data-picker
                                                            :reset_al_time="reset_al_time"
                                                            @timePickerIsChanged="changeValueResetAlTime"
                                                        ></data-picker>
                                                    </div>
                                                </div>

                                                <div class="col d-flex">
                                                    <div class="time-picker-svg">
                                                        <img src="/storage/images/icons/aukcion_time_icon.png" class="aukcion_time_icon" alt="">
                                                    </div>

                                                    <div class="col d-flex justify-content-center aukcion__time_picker_div">
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
                                </div>
                            </div>
                            <!-- LATER TIME DATA AND TIME PICKERS COLLAPSE END -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Təstiqlə</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import * as bootstrap from 'bootstrap';
import {toString} from "lodash";
export default {
    name: "AddOnAukcion",
    data () {
        return {
            // bodyColor: null,
            collapse: 'collapse',
            show_later_aukcion: true,
            reset_al_time: false,
            current_time_show: '',
            today: new Date(),
            date_format: { year: 'numeric', month: 'long', day: 'numeric' },
            run_current_time_aukcion: true,
        }
    },
    methods: {
        getCurrentTime( clear=false ) {
            let time_i = setInterval( () => {
                let date = new Date();
                let horus = date.getHours();
                let minutes = toString(date.getMinutes());
                let seconds = toString( date.getSeconds() );
                if( minutes.length < 2 ) minutes = '0'+minutes;
                if( seconds.length < 2 ) seconds = '0'+seconds;

                this.current_time_show = horus+':'+minutes+':'+seconds;


                // console.log('COLOR - ', date.getSeconds() )
            }, 1000 );
        },
        changeValueResetAlTime(data) {
            if( data ) {
                this.reset_al_time = false;
            }
        },
        resetDateAndTime() {
            this.reset_al_time = true;
        },
        runNowTimeAukcion() {
            let runNowTimeAukcionCollapse = document.getElementById('runNowTimeAukcionCollapse');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');

            if( runNowTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                    if( on_time_aukcion[0].style ) {
                        on_time_aukcion[0].style.border = 'none';
                    }
                }

                runNowTimeAukcionCollapse.style.maxHeight = runNowTimeAukcionCollapse.scrollHeight+'px';
            }
        },
        runNowTimeAukcionClose() {
            let runNowTimeAukcionCollapse = document.getElementById('runNowTimeAukcionCollapse');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');

            if( runNowTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                    setTimeout( () => {
                        if( on_time_aukcion[0].style ) {
                            on_time_aukcion[0].style = 'border-bottom: 1px solid #0000002e;';
                        }
                    }, 210 )
                }
                runNowTimeAukcionCollapse.style.maxHeight = '0';
            }
        },
        newAukcion() {
            let collapse = document.getElementById('collapsePicker');
            let runCurrentTimeAukcion = document.getElementById('runCurrentTimeAukcion');

            if( collapse.style.maxHeight ) {
                collapse.style.maxHeight = null;
                collapse.style.overflow = 'hidden';
            }

            if( ! collapse.style.maxHeight ) {
                setTimeout( () => {
                    runCurrentTimeAukcion.style.maxHeight = runCurrentTimeAukcion.scrollHeight+'px'
                }, 300)
            }
        },
        laterAukcion() {
            this.run_current_time_aukcion = false;
            let collapse_id = document.getElementById('collapsePicker');
            let runCurrentTimeAukcion = document.getElementById('runCurrentTimeAukcion');

            if( ! collapse_id.style.maxHeight ) {
                runCurrentTimeAukcion.style.maxHeight = '0';

                if( runCurrentTimeAukcion.style.maxHeight === '0px' ) {
                    // console.log('MMMMMM = ',  runCurrentTimeAukcion.style.maxHeight )
                    setTimeout( () => {
                        collapse_id.style.maxHeight = collapse_id.scrollHeight+'px';
                    }, 300)
                }

                if( collapse_id.style.maxHeight ) {
                    setTimeout( () => {
                        collapse_id.style.overflow = 'unset';
                    }, 300)
                }
            }
        },
        hideDateTimePickers() {
            let collapse_id = document.getElementById('collapsePicker');
            if( collapse_id ) {
                collapse_id.style.maxHeight = null;
                collapse_id.style.overflow = 'hidden';
            }
        },
        modalBackdrop() {
            let modal_backdrop = document.getElementsByClassName('modal-backdrop');
            // console.log('COLOR - ', modal_backdrop)
            if( modal_backdrop && modal_backdrop.length )
                modal_backdrop[0].style = 'opacity: 0.3';
        },
    },
    mounted() {
        this.getCurrentTime(false);

    }
}
</script>

<style scoped>
    .modal-content {
        box-shadow: 1px 4px 11px 0 #00000059;
    }
    .aukcion__title_div {
        font-size: 1.3rem;
    }
        .aukcion__first_title {
            font-size: 1.2em;
            color: #41830b;
            font-weight: bold;
        }
        .aukcion__second_title {
            color: #5d5d5d;
            font-weight: bold;
        }

    .aukcion__add_button_text {
        font-size: 1.2rem;
        font-weight: bold;
        padding: 0 15px;
    }

    #collapsePicker{
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    #runCurrentTimeAukcion {
        max-height: 466px;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    #runNowTimeAukcionCollapse {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    .aukcion_date_icon {
        width: 40px;
        height: 43px;
        margin: -4px 0 0 0;
    }
    .aukcion_time_icon {
        position: relative;
        width: 35px;
        height: 40px;
        opacity: 0.9;
    }
    .reset__data_time {
        bottom: 0;
        font-size: 1rem;
        position: absolute;
        text-decoration: underline;
    }

    .on_time_aukcion {
        border-bottom: 1px solid #0000002e;
    }

    .do__akcion_on_time {
        color: #000;
        align-self: center;
    }

    .to_start_aukcion_title {
        color: #000;
    }

    .auksiyon_text_style {
        font-size: 1em;
        color: #41830b;
        font-weight: bold;
    }
</style>

