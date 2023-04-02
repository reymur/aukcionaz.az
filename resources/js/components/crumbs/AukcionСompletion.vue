<template>
    <div class="col-12">

        <div class="background" id="success_auksiyon_fon"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="modalbox success col-10 col-sm-8 col-md-6 col-lg-6 col-xl-6 col-xxl-6 center animate">
                    <div v-if="!out_timer" class="d-flex icon icon_stop">
                        <div class="text-white m-auto fs-2 fw-bold">STOP</div>
                    </div>
                    <div v-if="out_timer" class="d-flex icon icon_success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="white" class="bi bi-check-lg m-auto align-self-center" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>

                    <h2 class="mt-2 text-danger time_is_over"> Vaxt bitdi! </h2>

                    <div v-if=" !is_auth_user " class="waviy fw-bold time__add_waiting">
                        <span class="d-flex justify-content-center timer_div_parent" style="--i:1">
                            Vaxt artımı gözlənilir
                            <div v-if="timer" class="ms-1 timer_div"></div>
                        </span>
                    </div>
<!--                    <p v-if=" !is_auth_user " class="fw-bold time__add_waiting"> Vaxt artımı gözlənilir! </p>-->

                    <div class="mb-4">
                        <div v-if="is_auth_user" @click="extendAuksiyonTime" type="button" class="btn btn-success w-75 mb-1 fs-5">Vaxtı artır</div>
                        <div v-if="is_auth_user" type="button" class="btn btn-danger w-75 fs-5">Sonlandır</div>
                        <a :href="'/product/'+product_id" v-if=" !is_auth_user " type="button" class="btn btn-danger w-75 fs-5">Çıxış</a>
                    </div>
                </div>
                <!--/.success-->
            </div>

            <div class="d-none add_on_aukcion_div">
                <add-on-aukcion
                    :product_info="product"
                ></add-on-aukcion>
            </div>
            <!--/.row-->
<!--            <div class="row">-->
<!--                <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate" style="display: none;">-->
<!--                    <div class="icon">-->
<!--                        <span class="glyphicon glyphicon-thumbs-down"></span>-->
<!--                    </div>-->
<!--                    &lt;!&ndash;/.icon&ndash;&gt;-->
<!--                    <h1>Oh no!</h1>-->
<!--                    <p>Oops! Something went wrong,-->
<!--                        <br> you should try again.</p>-->
<!--                    <button type="button" class="redo btn">Try again</button>-->
<!--                    <span class="change">&#45;&#45; Click to see opposite state &#45;&#45;</span>-->
<!--                </div>-->
<!--                &lt;!&ndash;/.success&ndash;&gt;-->
<!--            </div>-->
            <!--/.row-->
        </div>

    </div>
</template>

<script>
export default {
    name: "AukcionСompletion",
    props:['product','auksiyon','is_auth_user','stop_auksiyon'],
    data() {
        return {
            timer: null,
            out_timer: null,
            is_stop_auksiyon: this.stop_auksiyon,
            is_auth_user: this.is_auth_user,
            product_id: this.getProductID(),
            extend_tmie: null,
            is_product: null,
        }
    },
    components:{
        AukcionСompletionSuccess: 'complete-success'
    },
    watch: {
        is_stop_auksiyon() {
            if( this.stop_auksiyon ) {
                this.timeAddWaiting();
            }
        }
    },
    methods:{
        timeAddWaiting() {
            let time = new Date().getSeconds();
            axios({
                method:"post",
                url:"/complete-time-extend-timer",
                data: { product_id: this.product_id, current_time: this.getCurrentTime()  }
            })
            .then( res => {
                if( res && res.data && res.data.current_save_time ) {
                    this.timer = true;
                    this.getTimer( res.data.current_save_time );
                    console.log("complete-time-extend-timer RES === ", res.data.current_save_time)
                }
            })
            .catch( err => {
                console.log("complete-time-extend-timer ERR === ", err.response.data.message )
            })
        },
        getTimer( time ) {
            if( time ) {
                let timer = 30000 - (this.getCurrentTime() - Number(time));
                let time_is_over = document.getElementsByClassName('time_is_over');
                let time__add_waiting = document.getElementsByClassName('time__add_waiting');
                let timer_div_parent = document.getElementsByClassName('timer_div_parent');
                let icon_stop = document.getElementsByClassName('icon_stop');
                let modalbox = document.getElementsByClassName('modalbox');

                let setTimer = setInterval( () => {
                    let timer_div = document.getElementsByClassName('timer_div');

                    if( timer_div && timer_div[0] ) {
                        timer_div[0].innerHTML = ' - '+ timer / 1000;
                    }

                    timer -= 1000;

                    if( timer < 0 ) {
                        this.out_timer = true;
                        if( time_is_over && time_is_over[0] && time__add_waiting && time__add_waiting[0] ) {
                            if( time__add_waiting[0].classList ) {
                                time__add_waiting[0].classList.add('other-animation');
                                time__add_waiting[0].innerText = '00:00';
                                modalbox[0].classList.remove('other-animation');
                                console.log("LLLLLLLLL - ",  modalbox )
                            }

                            if( time_is_over[0].classList.contains('text-danger') ) {
                                time_is_over[0].classList.remove('text-danger');
                                modalbox[0].classList.add('animation');
                                time_is_over[0].classList.add('other-animation');
                                time_is_over[0].classList.add('text-success');
                                time_is_over[0].innerHTML = 'Auksiyon sonlandı!'

                                let set_icon_success = setInterval( () => {
                                    let icon_success = document.getElementsByClassName('icon_success');

                                    if( icon_success && icon_success[0] ) {
                                        icon_success[0].style = 'background-color: #4caf50;';
                                        clearInterval(set_icon_success);
                                    }
                                }, 0.1 );

                                setTimeout( () => {
                                    clearInterval(set_icon_success);
                                }, 10000 );
                            }
                        }

                        clearInterval(setTimer);
                    }
                }, 1000 );

                setTimeout( () => {
                    clearInterval(setTimer);
                }, 60000 );
            }
        },
        extendAuksiyonTime() {
            let auksiyon_button = setInterval( () => {
                let addAuksiyonCloseButton = document.getElementById('addAuksiyonCloseButton');
                let auksiyon_add_button = document.getElementsByClassName('auksiyon_add_button');
                let add_on_aukcion_div  = document.getElementsByClassName('add_on_aukcion_div');
                let auksion_completion  = document.getElementsByClassName('modalbox');
                let fon = document.getElementById('fon');
                let body = document.body;

                if( body && auksiyon_add_button && add_on_aukcion_div && auksion_completion && fon ) {
                    if( auksiyon_add_button[0] && add_on_aukcion_div[0] && auksion_completion[0] && fon ) {
                        auksion_completion[0].style.display = 'none';
                        fon.style.display = 'none';
                        body.style = 'overflow: none';

                        setTimeout( () => {
                            auksiyon_add_button[0].click();
                        }, 100 );
                    }

                    clearInterval(auksiyon_button);
                }

            }, 0.1);

            setTimeout( () => {
                clearInterval(auksiyon_button)
            }, 30000);
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        getSuccessModal() {
            // alert(333333)
            // document.ready(function() {
            let fon = document.getElementById('fon');
            let body = document.body;
            let success = document.getElementsByClassName('success');

            if( fon && success && success[0] ) {
                setTimeout( () => {
                    // success[0].click( function() {
                    //     success[0].toggle();
                    // });

                    if( fon.style.display && success[0].style.display === 'none' ) {
                        fon.style.display = 'block';
                        body.style = 'overflow: hidden';
                        success[0].style.display = 'block';
                    }
                }, 500 );
            }
        },
        getCurrentTime() {
            let date    = new Date();
            let h       = Number( date.getHours() ) * 3600000;
            let m       = Number( date.getMinutes() )  * 60000;
            let s       = Number( date.getSeconds() )  * 1000;

            return (h + m + s);
        },
    },
    computed: {
        hideAuksiyonAddButton() {
            let auksiyon_button = setInterval( () => {
                let fon = document.getElementById('fon');
                let auksiyon_add_button = document.getElementsByClassName('auksiyon_add_button');
                let add_on_aukcion_div = document.getElementsByClassName('add_on_aukcion_div');
                let body = document.body;

                if( body && auksiyon_add_button && auksiyon_add_button[0] && add_on_aukcion_div && add_on_aukcion_div[0] ) {
                    auksiyon_add_button[0].style = 'display:none: position: absolute; opacity: 0; z-index: -1;';

                    body.style = 'overflow: hidden;';
                    fon.style.display = 'block';

                    setTimeout( () => {
                        if ( add_on_aukcion_div && add_on_aukcion_div[0] && add_on_aukcion_div[0].classList ) {
                            add_on_aukcion_div[0].classList.remove('d-none');
                            add_on_aukcion_div[0].classList.add('d-block');
                            add_on_aukcion_div[0].style.width = '0px'
                            add_on_aukcion_div[0].style.height = '0px'
                        }
                    }, 1000 );

                    clearInterval(auksiyon_button);
                }
            }, 0.1);
        },
    },
    mounted() {
        this.hideAuksiyonAddButton;
        this.getSuccessModal();
        this.timeAddWaiting();

        let auksiyon_add_button = document.getElementsByClassName('auksion_completion')

        console.log("BBBBBBBBBBFFFFFHHHHHKKK - ", this.stop_auksiyon );

    }
}
</script>

<style scoped>

.animation {
    position: relative;
    margin: auto;
    animation: fall-in-ecfd07e4 0.75s;
}
.other-animation {
    position: relative;
    margin: auto;
    animation: fall-in-ecfd07e4 0.75s;
}
.modalbox {
    position: relative;
    margin: auto;
    animation: fall-in-ecfd07e4 0.75s;
}
/* waviy start */
.waviy {
    position: relative;
    -webkit-box-reflect: below -20px linear-gradient(transparent, rgba(0,0,0,.2));
//font-size: 60px;
}
.waviy span {
//font-family: 'Alfa Slab One', cursive;
    position: relative;
    display: inline-block;
    color: #494848;
    //text-transform: uppercase;
    animation: waviy 1s infinite;
    animation-delay: calc(.1s * var(--i));
}
@keyframes waviy {
    0%,40%,100% {
        transform: translateY(0)
    }
    20% {
        transform: translateY(-1px)
    }
}
/* waviy end*/

.modalbox.success,
.modalbox.error {
    position: absolute;
    //box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    box-shadow: 0 4px 15px -1px #333232;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    background: #fff;
    padding: 25px 25px 15px;
    text-align: center;
    z-index: 101;
}

.modalbox.success.animate .icon,
.modalbox.error.animate .icon {
    -webkit-animation: fall-in 0.75s;
    -moz-animation: fall-in 0.75s;
    -o-animation: fall-in 0.75s;
    animation: fall-in 0.75s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.modalbox.success h1,
.modalbox.error h1 {
    font-family: 'Montserrat', sans-serif;
}

.modalbox.success p,
.modalbox.error p {
    font-family: 'Open Sans', sans-serif;
}

.modalbox.success button,
.modalbox.error button,
.modalbox.success button:active,
.modalbox.error button:active,
.modalbox.success button:focus,
.modalbox.error button:focus {
    -webkit-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    margin-top: 15px;
    width: 80%;
    background: transparent;
    color: #4caf50;
    border-color: #4caf50;
    outline: none;
}

.modalbox.success button:hover,
.modalbox.error button:hover,
.modalbox.success button:active:hover,
.modalbox.error button:active:hover,
.modalbox.success button:focus:hover,
.modalbox.error button:focus:hover {
    color: #fff;
    background: #4caf50;
    border-color: transparent;
}

.modalbox.success .icon,
.modalbox.error .icon {
    position: relative;
    margin: 0 auto;
    margin-top: -75px;
    background: #de4d44;
    //background: #4caf50;
    height: 100px;
    width: 100px;
    border: 3px solid #fff;
    border-radius: 50%;
}

.modalbox.success .icon span,
.modalbox.error .icon span {
    postion: absolute;
    font-size: 4em;
    color: #fff;
    text-align: center;
    padding-top: 20px;
}

.modalbox.error button,
.modalbox.error button:active,
.modalbox.error button:focus {
    color: #f44336;
    border-color: #f44336;
}

.modalbox.error button:hover,
.modalbox.error button:active:hover,
.modalbox.error button:focus:hover {
    color: #fff;
    background: #f44336;
}

.modalbox.error .icon {
    background: #f44336;
}

.modalbox.error .icon span {
    padding-top: 25px;
}

.time__add_waiting {
    letter-spacing: 0.5px;
    font-size: 1.4rem;
    margin: 25px 0 35px 0;
}

.center {
    float: none;
    margin-left: auto;
    margin-right: auto;
    /* stupid browser compat. smh */;
}

.center .change {
    clearn: both;
    display: block;
    font-size: 10px;
    color: #ccc;
    margin-top: 10px;
}

@-webkit-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-moz-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-o-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-webkit-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-moz-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-o-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-moz-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-webkit-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-o-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-moz-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@-webkit-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@-o-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

</style>
