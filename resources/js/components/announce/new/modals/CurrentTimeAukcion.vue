<template>
    <div class="" id="runCurrentTimeAukcion">
        <div class="card card-body pb-0">
            <div class="col">
                <div class="col">

                    <div class="ms-2 mb-3 pb-2">
                        <div class="d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex fs-5">
<!--                            <div class="d-flex me-2 justify-content-center"> Elan təstiqləndiyi andan </div>-->
                            <div class="d-flex m-auto fs-3">
                                <span class="me-2 auksiyon_text_style"> Auksion </span> indi başlasın
                            </div>
                        </div>
                    </div>

                    <div class="col mb-3 on_time_aukcion">
                        <div class="col d-block d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex">
                            <div class="d-flex align-self-center justify-content-center fs-5 mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0 me-2 rounded-0 do__akcion_on_time">
                                <span class="me-1 auksiyon_text_style">Auksion </span> saatla olsun?
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
                                <on-time-aukcion></on-time-aukcion>
                            </div>
                        </div>
                        <!-- RUN AUKCION NEW TIME COLLAPSE END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CurrentTimeAukcion",
    props:['close_current_time_aukcion'],
    data() {
        return {
            reset_al_time: false,
        }
    },
    watch: {
        close_current_time_aukcion() {
            let no_time = document.getElementById('no-time');

            if( no_time ) no_time.checked = true;
            this.runNowTimeAukcionClose();
        }
    },
    methods: {
        changeValueResetAlTime(data) {
            if( data ) {
                this.reset_al_time = false;
            }
        },
        resetDateAndTime() {
            this.reset_al_time = true;
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
    }
}
</script>

<style scoped>
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
    .do__akcion_on_time {
        color: #000;
        align-self: center;
    }
    .auksiyon_text_style {
        font-size: 1em;
        color: #41830b;
        font-weight: bold;
    }
    .do__akcion_on_time {
        color: #000;
        align-self: center;
    }

</style>
