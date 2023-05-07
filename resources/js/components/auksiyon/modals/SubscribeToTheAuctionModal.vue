<template>
    <div class="">
        <div class="modal-frame">
            <div class="modal">
                <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-4 col-xxl-4 d-flex modal-inset">
                    <div @click="close" class="button close subscribe__modal_close_btn"><i class="fa fa-close"></i></div>

                    <div v-if="!success && !isset_gamer" class="modal-body d-flex align-self-center justify-content-center">
                        <confirm-phone-and-name-for-auksiyon-gamer
                            @sendPhoneAndName="getPhoneAndName"
                            :isset_gamer="isset_gamer"
                            :isset_gamer_error_text="isset_gamer_error_text"
                            :not_user_error="not_user_error"
                            :remove_errors="remove_errors"
                        ></confirm-phone-and-name-for-auksiyon-gamer>
                    </div>
                    <div v-if="success && !isset_gamer && !show_success && !in_the_game" class="modal-body d-flex align-self-center justify-content-center verification__code_modal">
                        <confirm-number-verification-code-for-auksiyon-gamer
                            :user="user"
                            :code="code"
                            :timer="timer"
                            :auksiyon_id="auksiyon_id"
                            :delete_token="delete_token"
                            @setSuccessValue="setSuccessValueThis"
                            @showSuccessModal="showSuccessModal"
                        ></confirm-number-verification-code-for-auksiyon-gamer>
                    </div>

                    <!-- ISSET GAMER -->
                    <div v-if="isset_gamer" class="modal-body d-flex align-self-center justify-content-center verification__code_modal">
                        <isset-gamer-verification
                            :gamer="isset_gamer"
                            :code="code"
                            :auksiyon_id="auksiyon_id"
                        ></isset-gamer-verification>
                    </div>

                    <div v-if="show_success || in_the_game" class="modal-body d-flex align-self-center justify-content-center">
                        <success
                            :success_title="success_title"
                            :add_auksiyon="add_auksiyon"
                        ></success>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-overlay"></div>

        <button @click="subscribeOpen" type="button" class="subscribe-open btn btn-danger rounded-0 auksiyon_add_button">
<!--            <span class="aukcion__add_button_text"> İştirak et </span>-->
        </button>

<!--        <button class="fancy-btn open">Can I haz Modal?</button>-->
    </div>
</template>

<script>
import {maska} from "maska";
import Success from '../../../components/elements/Success.vue';
import IssetGamerVerification from '../../../components/auksiyon/modals/crumbs/IssetGamerVerification.vue';
import ConfirmPhoneAndName from '../../../components/announce/new/modals/crumbs/ConfirmPhoneAndName.vue';
import ConfirmPhoneAndNameForAuksiyonGamer from '../../../components/auksiyon/modals/crumbs/ConfirmPhoneAndNameForAuksiyonGamer.vue';
import ConfirmNumberVerificationCodeForAuksiyonGamer from '../../../components/auksiyon/modals/crumbs/ConfirmNumberVerificationCodeForAuksiyonGamer.vue';

export default {
    name: "ConfirmForAddOnAuksiyon",
    directives: { maska },
    props:['confirm_to_subscribe'],
    data() {
        return {
            user: null,
            code: null,
            timer: null,
            name: null,
            phone: null,
            success: null,
            success_title: null,
            delete_token: null,
            remove_errors: null,
            in_the_game: null,
            isset_gamer: null,
            isset_gamer_error_text: null,
            not_user_error: null,
            auksiyon_id: null,
            add_auksiyon: null,
            show_success: null,
            is_verification_session_code: null,
        }
    },
    components: {
        Success,
        IssetGamerVerification,
        ConfirmPhoneAndNameForAuksiyonGamer,
        ConfirmNumberVerificationCodeForAuksiyonGamer,
    },
    watch: {
        confirm_to_subscribe() {
            let subscribe_open = document.getElementsByClassName('subscribe-open');
            if( subscribe_open && subscribe_open[0] ) {
                subscribe_open[0].click();
                console.log( 'confirm_to_subscribe - ', this.confirm_to_subscribe )
            }
        }
    },
    methods:{
        showSuccessModal(data) {
            if( data ) {
                this.show_success = true;

                setTimeout( () => {
                    this.add_auksiyon = true;
                },2000 );
            }
        },
        setSuccessValueThis(data){
            this.success = null;
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        getPhoneAndName(data) {
            if( data && data.name && data.phone ) {
                this.sendConfirm(data.name, data.phone);
                console.log( 'DATA - ', data )
            }
        },
        sendConfirm(name, phone) {
            if( name && phone ) {
                axios({
                    method: "post",
                    url: "/send/confirmation-for-gamer",
                    data: {
                        name: name,
                        number: phone,
                        product_id: this.getProductID(),
                        save_time: this.getCurrentTimes(),
                      /*  name: name*/
                    },
                })
                .then(res => {
                    if ( res && res.data && res.data && res.data.code && res.data.timer && res.data.user && res.data.auksiyon_id ) {
                        this.user = res.data.user;
                        this.code = res.data.code;
                        this.timer = res.data.timer;
                        this.auksiyon_id = res.data.auksiyon_id;
                        //
                        // this.showSuccess();
                        this.success = true;
                        this.not_user_error = null;
                        console.log('send-confirmation PHONE res - ', res.data )
                        // console.log('send-confirmation AAA res - ', res.data.user)
                    }
                    if( res && res.data && res.data && res.data.product_owner ) {
                        console.log('=============||| - ', res.data.product_owner )
                        this.success = true;
                        this.show_success = true;
                        this.success_title =  res.data.product_owner.name;
                        setTimeout( () => {document.location.reload()}, 1300);
                    }
                    if( res && res.data && res.data && res.data.in_the_game ) {
                        console.log('>>>>>>>>>>>>> - ', res.data.in_the_game )
                        this.success = true;
                        this.in_the_game = true;
                        setTimeout( () => {document.location.reload()}, 1300);
                    }
                    console.log('send-confirmation res PHONE 222 - ', res.data )
                })
                .catch(err => {
                    if( err && err.response && err.response.status === 419 && err.response.data.message === 'not user' ) {
                        this.not_user_error = Math.floor(Math.random() * 999);
                    }
                    if( err && err.response && err.response.status === 500 && err.response.data.isset_gamer ) {
                        this.isset_gamer = err.response.data.isset_gamer;
                        this.isset_gamer_error_text = err.response.data.isset_gamer;
                        console.log('send-confirmation err 1 AAA - ', err.response.data.isset_gamer)
                    }
                    console.log('send-confirmation err 2 AAA - ', err.response)
                })
            }
        },
        // showSuccess() {
        //     this.show_success = true;
        //
        //     setTimeout( () => {
        //         this.success = true;
        //         this.show_success = true;
        //     }, 3000 );
        // },
        getCurrentTimes() {
            let date    = new Date();
            let h       = Number( date.getHours() ) * 3600000;
            let m       = Number( date.getMinutes() )  * 60000;
            let s       = Number( date.getSeconds() )  * 1000;

            return (h + m + s);
        },
        subscribeOpen() {
            let subscribe_open = document.getElementsByClassName('subscribe-open');
            let modal = document.getElementsByClassName('modal');
            let modal_frame = document.getElementsByClassName('modal-frame');
            let overlay = document.getElementsByClassName('modal-overlay');
            let body = document.body;

            if( body && modal && modal[0] && subscribe_open && subscribe_open[0] && overlay && overlay[0] && modal_frame && modal_frame[0] ) {
                body.style = 'overflow: hidden';
                overlay[0].classList.add("state-show");
                modal_frame[0].classList.remove("state-leave");
                modal_frame[0].classList.add("state-appear");
                modal[0].style = 'background-color: rgb(246 234 208 / 87%)'
            }
        },
        close() {
            this.delete_token = Math.floor(Math.random() * 100);
            let body = document.body;
            let close = document.getElementsByClassName('close');
            let modal = document.getElementsByClassName('modal');
            let modal_frame = document.getElementsByClassName('modal-frame');
            let overlay = document.getElementsByClassName('modal-overlay');

            if( body && close && close[0] && overlay && overlay[0] && modal_frame && modal_frame[0] ) {
                body.style = 'overflow: none';
                overlay[0].classList.remove("state-show");
                modal_frame[0].classList.remove("state-appear");
                // modal[0].classList.add("state-leave");
            }

            this.remove_errors = Math.random(0, 999);
        }
    },
    mounted() {

        console.log(' SSSSSSSSSS- ', this.user)
    }
}
</script>

<style scoped>

.aukcion__add_button_text {
    font-size: 1.2rem;
    font-weight: bold;
    padding: 0 15px;
}

* {
    box-sizing: border-box;
}

html, body {
    width: 100%;
    height: 100%;
    position: relative;
    margin: 0;
    padding: 0;
    font-family: 'Noto Sans', sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
    background-color: #F2E1AC;
}

.subscribe__modal_close_btn {
    z-index: 100;
}

.fancy-btn {
    -webkit-appearance: none;
    cursor: pointer;
    outline: none;
    border: none;
    position: relative;
    top: 50%;
    display: block;
    min-width: 10%;
    line-height: 55px;
    font-size: 14px;
    text-transform: uppercase;
    margin: 0 auto;
    padding: 0 10px;
    background-color: #F2594B;
    color: #FFF;
    border-radius: 3px;
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
}
.fancy-btn:hover {
    background-color: #f46f63;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    background-color: #fff;
    opacity: 0;
    visibility: hidden;
    z-index: 40;
    -moz-transition: opacity 0.25s ease 0s, visibility 0.35s linear;
    -o-transition: opacity 0.25s ease 0s, visibility 0.35s linear;
    -webkit-transition: opacity 0.25s ease, visibility 0.35s linear;
    -webkit-transition-delay: 0s, 0s;
    transition: opacity 0.25s ease 0s, visibility 0.35s linear;
}
.modal-overlay.state-show {
    opacity: .7;
    visibility: visible;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -moz-transition-duration: 0.2s, 0s;
    -o-transition-duration: 0.2s, 0s;
    -webkit-transition-duration: 0.2s, 0s;
    transition-duration: 0.2s, 0s;
}

.modal-frame {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    z-index: 50;
    /*     display: table; */
    display: -webkit-flex;
    display: flex;
    -webkit-align-items: center;
    align-items: center;
    -moz-box-align: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -moz-box-pack: center;
    -ms-flex-pack: center;
    width: 100%;
    text-align: center;
    visibility: hidden;
}
.modal-frame.state-appear {
    visibility: visible;
}
.modal-frame.state-appear .modal-inset {
    -moz-animation: modalComeIn 0.25s ease;
    -webkit-animation: modalComeIn 0.25s ease;
    animation: modalComeIn 0.25s ease;
    visibility: visible;
    /* to keep @ final state */
}
.modal-frame.state-appear .modal-body {
    opacity: 1;
    -moz-transform: translateY(0) scale(1, 1);
    -ms-transform: translateY(0) scale(1, 1);
    -webkit-transform: translateY(0) scale(1, 1);
    transform: translateY(0) scale(1, 1);
}
.modal-frame.state-leave {
    visibility: visible;
}
.modal-frame.state-leave .modal-inset {
    -moz-animation: modalHeadOut 0.35s ease 0.1s;
    -webkit-animation: modalHeadOut 0.35s ease 0.1s;
    animation: modalHeadOut 0.35s ease 0.1s;
    visibility: visible;
}
.modal-frame.state-leave .modal-body {
    opacity: 0;
    -moz-transition-delay: 0s;
    -o-transition-delay: 0s;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -moz-transition-duration: 0.35s;
    -o-transition-duration: 0.35s;
    -webkit-transition-duration: 0.35s;
    transition-duration: 0.35s;
    -moz-transition-timing-function: ease;
    -o-transition-timing-function: ease;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    -moz-transform: translateY(25px);
    -ms-transform: translateY(25px);
    -webkit-transform: translateY(25px);
    transform: translateY(25px);
}

@-moz-document url-prefix() {
    .modal-frame {
        height: calc(100% - 55px);
    }
}
.modal {
    display: block;
    vertical-align: middle;
    text-align: center;
}

.modal-inset {
    position: absolute;
    background-color: rgb(255 254 250);
    //min-width: 320px;
    max-height: 320px;
    margin: auto;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    visibility: hidden;
    -moz-box-shadow: 2px 2px 8px 1px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 2px 2px 8px 1px rgba(0, 0, 0, 0.2);
    box-shadow: 2px 2px 8px 1px rgba(0, 0, 0, 0.2);
    -moz-backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -moz-transform-style: preserve-3d;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
}
.modal-inset .close {
    display: block;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 10px;
    opacity: .4;
}
.modal-inset .close:hover {
    opacity: 1;
}

.modal-body {
    margin: auto;
    opacity: 0;
    -moz-transform: translateY(0) scale(0.8, 0.8);
    -ms-transform: translateY(0) scale(0.8, 0.8);
    -webkit-transform: translateY(0) scale(0.8, 0.8);
    transform: translateY(0) scale(0.8, 0.8);
    -moz-transition-property: opacity, -moz-transform;
    -o-transition-property: opacity, -o-transform;
    -webkit-transition-property: opacity, -webkit-transform;
    transition-property: opacity, transform;
    -moz-transition-duration: 0.25s;
    -o-transition-duration: 0.25s;
    -webkit-transition-duration: 0.25s;
    transition-duration: 0.25s;
    -moz-transition-delay: 0.1s;
    -o-transition-delay: 0.1s;
    -webkit-transition-delay: 0.1s;
    transition-delay: 0.1s;
}
.modal-body h3 {
    font-weight: 700;
    padding-bottom: 22px;
    display: block;
    color: #F2594B;
    text-align: center;
}
.modal-body p {
    padding-bottom: 20px;
}
.modal-body .ps {
    font-size: 12px;
    opacity: .3;
}

@-webkit-keyframes modalComeIn {
    0% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: scale(0.8, 0.8);
        -ms-transform: scale(0.8, 0.8);
        -webkit-transform: scale(0.8, 0.8);
        transform: scale(0.8, 0.8);
    }
    65.5% {
        -moz-transform: scale(1.03, 1.03);
        -ms-transform: scale(1.03, 1.03);
        -webkit-transform: scale(1.03, 1.03);
        transform: scale(1.03, 1.03);
    }
    100% {
        visibility: visible;
        opacity: 1;
        -moz-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}
@-moz-keyframes modalComeIn {
    0% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: scale(0.8, 0.8);
        -ms-transform: scale(0.8, 0.8);
        -webkit-transform: scale(0.8, 0.8);
        transform: scale(0.8, 0.8);
    }
    65.5% {
        -moz-transform: scale(1.03, 1.03);
        -ms-transform: scale(1.03, 1.03);
        -webkit-transform: scale(1.03, 1.03);
        transform: scale(1.03, 1.03);
    }
    100% {
        visibility: visible;
        opacity: 1;
        -moz-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}
@keyframes modalComeIn {
    0% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: scale(0.8, 0.8);
        -ms-transform: scale(0.8, 0.8);
        -webkit-transform: scale(0.8, 0.8);
        transform: scale(0.8, 0.8);
    }
    65.5% {
        -moz-transform: scale(1.03, 1.03);
        -ms-transform: scale(1.03, 1.03);
        -webkit-transform: scale(1.03, 1.03);
        transform: scale(1.03, 1.03);
    }
    100% {
        visibility: visible;
        opacity: 1;
        -moz-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}
@-webkit-keyframes modalHeadOut {
    0% {
        visibility: visible;
        opacity: 1;
        -moz-transform: translateY(0) scale(1, 1);
        -ms-transform: translateY(0) scale(1, 1);
        -webkit-transform: translateY(0) scale(1, 1);
        transform: translateY(0) scale(1, 1);
    }
    100% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: translateY(35px) scale(0.97, 0.97);
        -ms-transform: translateY(35px) scale(0.97, 0.97);
        -webkit-transform: translateY(35px) scale(0.97, 0.97);
        transform: translateY(35px) scale(0.97, 0.97);
    }
}
@-moz-keyframes modalHeadOut {
    0% {
        visibility: visible;
        opacity: 1;
        -moz-transform: translateY(0) scale(1, 1);
        -ms-transform: translateY(0) scale(1, 1);
        -webkit-transform: translateY(0) scale(1, 1);
        transform: translateY(0) scale(1, 1);
    }
    100% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: translateY(35px) scale(0.97, 0.97);
        -ms-transform: translateY(35px) scale(0.97, 0.97);
        -webkit-transform: translateY(35px) scale(0.97, 0.97);
        transform: translateY(35px) scale(0.97, 0.97);
    }
}
@keyframes modalHeadOut {
    0% {
        visibility: visible;
        opacity: 1;
        -moz-transform: translateY(0) scale(1, 1);
        -ms-transform: translateY(0) scale(1, 1);
        -webkit-transform: translateY(0) scale(1, 1);
        transform: translateY(0) scale(1, 1);
    }
    100% {
        visibility: hidden;
        opacity: 0;
        -moz-transform: translateY(35px) scale(0.97, 0.97);
        -ms-transform: translateY(35px) scale(0.97, 0.97);
        -webkit-transform: translateY(35px) scale(0.97, 0.97);
        transform: translateY(35px) scale(0.97, 0.97);
    }
}

</style>
