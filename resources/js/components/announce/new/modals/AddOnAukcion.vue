<template>
    <div class="">
        <!-- LIN TO ACTIVE AUKSIYON -->
        <a v-if="auksiyon_status" :href="'/realtime/auksiyon/'+1" type="button" class="btn btn-success rounded-0 auksiyon_add_button">
            <span class="aukcion__add_button_text"> Auksion-a keçid </span>
        </a>

        <!-- Button trigger modal -->
        <button v-if="!auksiyon_status" @click="modalBackdrop" type="button" class="btn btn-danger rounded-0 auksiyon_add_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <span class="aukcion__add_button_text"> Auksion əlavə et </span>
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
                                <current-time-aukcion
                                    :close_current_time_aukcion="close_current_time_aukcion"
                                    @nowAuksiyonWithTimerYesOrNo="getNowAuksiyonWithTimerYesOrNo"
                                    @sendHorusToAddOnauksiyon="getHorusFromACurrentTimeAuksiyon"
                                    @sendMinuteToAddOnauksiyon="getMinuteFromACurrentTimeAuksiyon"
                                ></current-time-aukcion>
                            <!-- CURRENT TIME AUKCION END -->

                            <!-- LATER TIME DATA AND TIME PICKERS COLLAPSE START -->
                                <later-time-aukcion
                                    :close_later_time_aukcion="close_later_time_aukcion"
                                ></later-time-aukcion>
                            <!-- LATER TIME DATA AND TIME PICKERS COLLAPSE END -->

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="sendProductOnAuksiyon" type="button" class="btn btn-success m-auto col-8 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">Təstiqlə</button>
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
    props: ['product_info'],
    data () {
        return {
            // bodyColor: null,
            product_id: this.getProductID(),
            site_name: window.location.hostname,
            auksiyon_status: false,
            now: true,
            later: false,
            now_auksiyon_current_with_timer_no: true,
            now_auksiyon_current_with_timer_yes: false,
            now_auksiyon_later_with_timer_no: true,
            now_auksiyon_later_with_timer_yes: false,
            horus: null,
            minute: null,
            collapse: 'collapse',
            show_later_aukcion: true,
            current_time_show: '',
            today: new Date(),
            date_format: { year: 'numeric', month: 'long', day: 'numeric' },
            run_current_time_aukcion: true,
            close_later_time_aukcion: false,
            close_current_time_aukcion: false,
        }
    },
    computed:{
        checkAuksiyon() {
            let product_id = this.product_id;

            if( product_id ) {
                axios({
                    method:'POST',
                    url: '/check-auksiyon',
                    data: { product_id: Number(product_id) }
                })
                    .then( res => {
                        if( res && res.data && res.data.auksiyon ) {
                            if( res.data.auksiyon === 'ok' ) {
                                this.auksiyon_status = true;

                                window.location.href = '/realtime/auksiyon/'+ product_id;
                            }
                            else if( res.data.auksiyon === 'no' ) {
                                this.auksiyon_status = false;
                            }

                            console.log( 'res is on auksiyon1111 - ', res.data.auksiyon )
                        }
                    })
                    .catch( err => {
                        console.log( 'err is on auksiyon1111 - ', err.response.data )
                    });
            }
        },
    },
    methods: {
        addOnlyNowAuksiyon(product_id) {
            axios({
                method:'POST',
                url: '/add-only-now-auksiyon',
                data: { product_id: Number(product_id) }
            })
                .then( res => {
                    if( res && res.data && res.data.auksiyon ) {
                        if( res.data.auksiyon.status === 1 ) {
                            this.checkAuksiyon;
                            console.log( 'res auksiyon 1- ', res.data.auksiyon.status )
                        }
                        console.log( 'res auksiyon 2 - ', res )
                    }
                })
                .catch( err => {
                    console.log( 'err auksiyon - ', err )
                });
        },
        addOnlyNowAuksiyonWithTimer(product_id) {
            axios({
                method:'POST',
                url: '/add-only-now-auksiyon-with-timer',
                data: {
                    product_id: Number(product_id),
                    current_auksiyon_with_time_horus: this.horus,
                    current_auksiyon_with_time_minute: this.minute,
                }
            })
                .then( res => {
                    if( res && res.data && res.data.auksiyon ) {
                        if( res.data.auksiyon.status === 1 ) {
                            this.checkAuksiyon;
                        }
                        console.log( 'res auksiyon WithTimer - ', res.data.auksiyon.status )
                    }
                })
                .catch( err => {
                    console.log( 'err auksiyon WithTimer - ', err.response.data )
                });
        },
        sendProductOnAuksiyon() {
            let product_id = this.product_id;

            if(
                this.now && !this.later && this.now_auksiyon_current_with_timer_no &&
                !this.now_auksiyon_current_with_timer_yes && this.now_auksiyon_later_with_timer_no &&
                !this.now_auksiyon_later_with_timer_yes
            ) {
                this.addOnlyNowAuksiyon(product_id);
            }
            if(
                this.now && !this.later && !this.now_auksiyon_current_with_timer_no &&
                this.now_auksiyon_current_with_timer_yes && this.now_auksiyon_later_with_timer_no &&
                !this.now_auksiyon_later_with_timer_yes
            ) {
                console.log('addOnlyNowAuksiyonWithTimer = ', 'yes' )
                this.addOnlyNowAuksiyonWithTimer(product_id);
            }
            // alert('TIMER')
        },
        getNowAuksiyonWithTimerYesOrNo(data) {
            if( data && data.status ) {
                this.now_auksiyon_current_with_timer_yes = data.status;
                this.now_auksiyon_current_with_timer_no = false;
                console.log('now_auksiyon_current_with_timer_yes = ', this.now_auksiyon_current_with_timer_yes )
            }
            else if( data && !data.status ) {
                this.now_auksiyon_current_with_timer_yes = data.status;
                this.now_auksiyon_current_with_timer_no = true;
                this.horus = false;
                this.minute = false;
                // alert('horus - '+this.horus +' / minute - '+ this.minute)
            }
        },
        getHorusFromACurrentTimeAuksiyon(data) {
            if( data && data.horus ) this.horus = data.horus;
            // alert('horus - '+this.horus)
        },
        getMinuteFromACurrentTimeAuksiyon(data) {
            if( data && data.minute ) this.minute = data.minute;
            // alert('minute - '+this.minute)
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

            this.now = true;
            this.later = false;
            this.current_time_aukcion_no = true;
            this.current_time_aukcion_yes = false;
            // this.changeVarsValue( true, false, true, false);
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        changeVarsValue( n, l, c_t_a_no, c_t_a_yes){
            this.now = n;
            this.later = l;
            this.current_time_aukcion_no = c_t_a_no;
            this.current_time_aukcion_yes = c_t_a_yes;
        },
        laterAukcion() {
            this.run_current_time_aukcion = false;
            let collapse_id = document.getElementById('collapsePicker');
            let runCurrentTimeAukcion = document.getElementById('runCurrentTimeAukcion');

            if( ! collapse_id.style.maxHeight ) {
                runCurrentTimeAukcion.style.maxHeight = '0';

                if( runCurrentTimeAukcion.style.maxHeight === '0px' ) {
                    setTimeout( () => {
                        collapse_id.style.maxHeight = collapse_id.scrollHeight+'px';
                    }, 300)
                }

                setTimeout( () => {
                    collapse_id.style.overflow = 'unset';
                }, 500);
            }

            this.later = true;
            this.now = false;
        },
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
        runNowTimeAukcion() {
            let runNowTimeAukcionCollapse = document.getElementById('runNowTimeAukcionCollapse');
            let runCurrentTimeAukcion = document.getElementById('runCurrentTimeAukcion');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');
            let card = document.getElementsByClassName('card');

            if( runNowTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                        if( on_time_aukcion[0].style ) {
                            on_time_aukcion[0].style.border = 'none';
                        }
                }

                let he = setInterval( () => {
                    if( runCurrentTimeAukcion.style.maxHeight && card && card[0] ) clearInterval(he);
                    console.log('card[0] - ', card[0].scrollHeight )
                    let heig = Number( runCurrentTimeAukcion.scrollHeight );
                    let heig_2 = Number( runCurrentTimeAukcion.scrollHeight );
                    runCurrentTimeAukcion.style.maxHeight = (heig+heig_2)+'px';
                    runNowTimeAukcionCollapse.style.maxHeight = (runNowTimeAukcionCollapse.scrollHeight + 5 )+'px';
                    runNowTimeAukcionCollapse.style.marginTop = '15px';
                }, 0.1 );

                setTimeout( () => {
                    clearInterval(he);
                }, 3000 );
            }
        },
        runNowTimeAukcionClose() {
            let runNowTimeAukcionCollapse = document.getElementById('runNowTimeAukcionCollapse');
            let on_time_aukcion = document.getElementsByClassName('on_time_aukcion');

            if( runNowTimeAukcionCollapse ) {
                if( on_time_aukcion && on_time_aukcion[0] && on_time_aukcion[0].classList ) {
                    setTimeout( () => {
                        if( on_time_aukcion[0].style ) {
                            on_time_aukcion[0].style.marginTop = '0';
                        }
                    }, 210 )
                }

                runNowTimeAukcionCollapse.style.maxHeight = '0';

                setTimeout( () => {
                    runNowTimeAukcionCollapse.style.marginTop = '0';
                }, 100);
            }
        },
        hideDateTimePickers() {
            let collapse_id = document.getElementById('collapsePicker');
            let runCurrentTimeAukcion = document.getElementById('runCurrentTimeAukcion');
            let newButton = document.getElementById('new-button');

            if( collapse_id ) {
                collapse_id.style.maxHeight = null;
                collapse_id.style.overflow = 'hidden';
            }

            newButton.checked = true;
            runCurrentTimeAukcion.style.maxHeight = runCurrentTimeAukcion.scrollHeight+'px'

            this.close_later_time_aukcion = Math.random();
            this.close_current_time_aukcion = Math.random();
        },
        modalBackdrop() {
            let modal_backdrop = document.getElementsByClassName('modal-backdrop');
            // console.log('COLOR - ', modal_backdrop)
            if( modal_backdrop && modal_backdrop.length )
                modal_backdrop[0].style = 'opacity: 0.3';
        },
        ifProductNoPublished() {
            let btn = document.getElementsByClassName('auksiyon_add_button');

            if( btn && btn[0] && btn[0].classList ) {
                if( this.product_info.publish === 0 ) {
                    btn[0].classList.add('disabled')
                }
            }
        }
    },
    mounted() {
        this.ifProductNoPublished();
        this.getCurrentTime(false);
        this.checkAuksiyon;

        console.log('URL INDEXOF = ', window.location.pathname )
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

    .on_time_aukcion {
        //border-bottom: 1px solid #0000002e;
    }

    .do__akcion_on_time {
        color: #000;
        align-self: center;
    }

    .to_start_aukcion_title {
        color: #000;
    }


</style>

