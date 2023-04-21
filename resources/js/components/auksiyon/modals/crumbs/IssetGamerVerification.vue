<template>
    <div class="col-12">

            <div class="fs-5 justify-content-center pin__title">
                <h4 class="text-bold">Sizin seans bitib!</h4>
                <br/>
                <div class="text-black-50">Pin kodu daxil edin</div>
            </div>

            <div class="d-flex position-relative justify-content-center">
                <input @keydown="changeInput" type="text" class="pin pin__styles" inputmode="numeric" maxlength="5">
            </div>
            <div v-if="code_error" class="d-block invalid-feedback error__div"> Yanlış kod! </div>

<!--            <div v-if="show_timer" class="code__timer">00:00</div>-->
<!--            <div v-if="!show_timer" class="code__timer_one">00:00</div>-->

<!--            <div class="resend__new_cod_div">-->
<!--                <div class="resend__new_cod_text"> Kod gəlmədi? </div>-->
<!--                <a v-if="!is_resend_code" @click="e => e.preventDefault()" href="" disabled class="text-muted resend__new_cod_btn" > Yeni kod alın </a>-->
<!--                <a v-if="is_resend_code" @click="resendCode" href="" disabled class="resend__new_cod_btn" > Yeni kod alın </a>-->
<!--            </div>-->

<!--            <div v-if="show_success" class="modal-body d-flex align-self-center justify-content-center">-->
<!--                <success></success>-->
<!--            </div>-->

        </div>
</template>

<script>

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";
// import Success from '../../../../../components/elements/Success.vue';

export default {
    name: "IssetGamerVerification",
    props:['gamer','code', 'auksiyon_id'],
    data() {
        return {
            test:22222,
            pin:'',
            set_focus: null,
            vrf_code: [],
            this_code: this.code,
            this_timer: this.timer,
            this_user_id: this.user ? this.user.id : null,
            code_error: false,
            show_timer: true,
            is_resend_code: true,
            this_delete_token: this.delete_token,
            send_verification_code: false,
        }
    },
    components: {

    },
    computed: {
        // setInSessionCode(){
        //     if( this.code ) localStorage.setItem('code', this.code );
        // }
    },
    watch:{
        delete_token() {
            if( this.this_user_id && this.this_code ) this.deleteToken( this.user.id, this.auksiyon_id )
        }
    },
    methods: {
        deleteToken( auksiyon_gamer_id=null, auksiyon_id=null ) {

            if( this.this_user_id && this.this_code ) {
                axios({
                    method:"post",
                    url:"/delete-token",
                    data: {
                        code: this.this_code,
                        user_id: this.this_user_id,
                        auksiyon_id: auksiyon_id,
                        auksiyon_gamer_id: auksiyon_gamer_id,
                    },
                })
                    .then(res => {
                        if ( res && res.data && res.data.deleted ) {
                            this.$emit('setSuccessValue', true);
                            console.log( 'delete-token 1 res - ', res.data.deleted )
                        }

                        console.log( 'delete-token 2 - ', res.data )
                    })
                    .catch(err => {
                        console.log('delete-token err - ', err.response )
                    })
            }
        },
        changeInput(event) {
            let value = event.target.value;
            let key = event.which || event.keyCode || event.charCode;
            if( (key && key >= 48 && key <= 57) || (key >= 96 && key <= 105 ) ) {

                if( this.pin.length < 5 ) this.pin += event.key;

                if( this.pin.length === 5 ) {
                    console.info( 'this.pin.length - ', this.pin );
                    console.info( 'this.pin.length 111 - ', this.pin.length );
                    if( this.test === this.pin ) {
                        console.info( 'send_verification_code - ', this.test === this.pin );
                        this.checkVerificationCode();
                    }
                    else {
                        this.callNotification('error', '<b>Yanlış kod!</b>', 13000, true, 'red', 'right', 'bottom');
                    }
                    console.info( 'watch 222 - ', this.test +' - '+ this.pin );
                }
            }
            else if( key === 8 || key === 46 ) {
                if( this.pin && this.pin.length !== 0 ) {
                    event.target.value = '';
                    this.pin = '';
                    this.deleteNotificationByMessage('Yanlış kod!');
                }
            }
            else {
                event.preventDefault();
            }
        },
        callNotification( type, message, duration, dismiss, background, horizontal,vertical) {
            let notyfErr = new Notyf({
                duration:duration,
                position:{x: horizontal, y: vertical},
                types: [{type:type, icon: { className: 'material-icons', tagName: 'i', text: 'warning'}}]
            });
            notyfErr.error({ type:type,  message:message,dismissible: dismiss, background:background });
        },
        deleteNotificationByMessage(message) {
            if( message ) {
                // let find = setInterval(() => {
                    let notyf_announcer = document.querySelectorAll('.notyf-announcer');
                    let notyf = document.querySelectorAll('.notyf');

                    if (notyf && notyf.length && notyf_announcer && notyf_announcer.length) {
                        notyf.forEach(el => {
                            if (el && el.children) {
                                this.recursiveDelete(el, el.children, message);
                            }
                        });

                        notyf_announcer.forEach(el => {
                            if (el) el.remove();
                        });

                        clearInterval(find);
                    }
                // }, 0.1);

                setTimeout(() => {
                    clearInterval(find)
                }, 10000)
            }
        },
        recursiveDelete(parent, child, text) {
            if( parent && child && child.length && text ){
                child.forEach( el => {
                    if( el.classList && el.classList.contains('notyf__message') && el.innerText.indexOf(text) !== -1 ) {
                        // console.info( 'el.remove - ',  parent );
                        parent.remove();
                    }
                    else if( el.children ) this.recursiveDelete(parent, el.children, text);
                })
            }
        },
        setVerificationCode(clear, input, key) {
            if( clear && input ) {
                clearInterval(clear);
                if( key === 0 ) {
                    this.vrf_code[key] = String(input);
                    if ( this.vrf_code[key] && this.vrf_code[key] === String(input) ) {
                    } else this.vrf_code[key] = String(input);
                    // console.info('vrf_code value - ', this.vrf_code)
                } else if( key > 0 ){
                    this.vrf_code[key] = String(input);
                    if (this.vrf_code.length && this.vrf_code[key] && this.vrf_code[key] === String(input)) {
                    } else this.vrf_code[key] = String(input);
                    // console.info('vrf_code value - ', this.vrf_code)
                }
            }
        },
        getInputValue(value_var) {
                let inter = setInterval( () => {
                    console.info( 'vrf_code value - ', value_var );
                    if( value_var ) {
                        clearInterval(inter);
                        return value_var;
                    }
                }, 0.1 );

                this.setIntervalClear(inter);
        },
        detectInputs(input){
            if( input ) {
                let clear = setInterval(() => {
                    this.setIntervalFunc(input);
                    // this.setIntervalFunc(input_2);
                    clearInterval(clear);
                }, 0.1);

                this.setIntervalClear(clear);
            }
        },
        setIntervalFunc( input ) {
            let set_f = setInterval( () => {
                if( input && input[0] ) {
                    input[0].focus();
                }
            }, 100 );

            setTimeout( () => {
                clearInterval(set_f);
            }, 100 )
        },
        setIntervalClear(name) {
            if( name ) {
                setTimeout( () => {
                    // console.log( 'setIntervalClear - '+ name )
                    clearInterval(name);
                }, 10000 )
            }
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        checkVerificationCode() {
            axios({
                method: "post",
                url: "/check-verification-code",
                data: {
                    user_id: this.this_user_id,
                    code: this.this_code,
                    verification_code: this.vrf_code.join('').replace(', ','')
                },
            })
                .then(res => {
                    if ( res && res.data && res.data.auth_user ) {
                        this.success = true;
                        this.showSuccess();
                        this.$emit('showSuccessModal', true);

                        console.log( 'check-verification-code res - ', res.data.user )
                    }

                    // console.log( 'check-verification-code ressss 222 - ',  res.data.user+' - '+res.data.code+' - '+res.data.timer )
                    console.log( 'check-verification-code ressss 222 - ',  res.data.user )
                })
                .catch(err => {
                    console.log('check-verification-code err - ', err.response.data.message)
                })
        },
        showSuccess() {

        },
        getCurrentTimes() {
            let date    = new Date();
            let h       = Number( date.getHours() ) * 3600000;
            let m       = Number( date.getMinutes() )  * 60000;
            let s       = Number( date.getSeconds() )  * 1000;

            return (h + m + s);
        }
    },
    mounted(){
        document.addEventListener('DOMContentLoaded', () => {
            if( this.this_user_id && this.this_code ) this.deleteToken(this.user.id, this.auksiyon_id)
        })

        // console.log('KKKKKKKK - ', this.user.id+" - "+this.auksiyon_id )
    }
}
</script>

<style scoped>

.pin__title {
    margin-top: -20px;
    margin-bottom: 15px;
}

.resend__new_cod_div {
    margin-top: 15px;
    display: flex;
    justify-content: center;
}
    .resend__new_cod_text {
        margin-right: 10px;
        color: #656161;
        font-size: 0.89rem;
    }
    .resend__new_cod_btn {
        letter-spacing: 0.5px;
        z-index: 10;
    }
.error__div {
    margin-top: 10px;
    font-size: 1rem;
    letter-spacing: 0.5px;
}

.code__timer_one {
    margin-top: 15px;
    font-size: 1.1rem;
    color: #878585;
}
.code__timer {
    margin-top: 15px;
    font-size: 1.1rem;
    color: #878585;
}

.code__title_div {

}
    .code__title_text {
        width: 100%;
    }

.pin__styles {
    width: 110px;
    height: 40px;
    border-radius: 0;
    border: 1px solid #6361614d;
    margin-right: 10px;
    text-align: center;
    font-size: 1.52rem;
}

</style>
