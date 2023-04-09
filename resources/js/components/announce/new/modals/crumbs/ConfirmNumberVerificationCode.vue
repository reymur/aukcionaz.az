<template>
    <div class="col-12 col-sm-8 col-md-6 col-xl-6 col-xxl-6">

            <div class="d-flex fs-5 text-black-50 justify-content-center code__title">
                Kodu daxil edin
            </div>

            <div class="d-flex position-relative justify-content-center">
                <input @keydown="changeInputFocus" v-model="input_1" type="text" class="pincode1 code__styles" inputmode="numeric" maxlength="1">
                <input @keydown="changeInputFocus" v-model="input_2" type="text" class="pincode2 code__styles" inputmode="numeric" maxlength="1">
                <input @keydown="changeInputFocus" v-model="input_3" type="text" class="pincode3 code__styles" inputmode="numeric" maxlength="1">
                <input @keydown="changeInputFocus" v-model="input_4" type="text" class="pincode4 code__styles" inputmode="numeric" maxlength="1">
                <input @keydown="changeInputFocus" v-model="input_5" type="text" class="pincode5 code__styles" inputmode="numeric" maxlength="1">
            </div>
            <div v-if="code_error" class="d-block invalid-feedback error__div"> Yanlış kod! </div>

            <div v-if="show_timer" class="code__timer">00:00</div>
            <div v-if="!show_timer" class="code__timer_one">00:00</div>

            <div class="resend__new_cod_div">
                <div class="resend__new_cod_text"> Kod gəlmədi? </div>
                <a v-if="!is_resend_code" @click="e => e.preventDefault()" href="" disabled class="text-muted resend__new_cod_btn" > Yeni kod alın </a>
                <a v-if="is_resend_code" @click="resendCode" href="" disabled class="resend__new_cod_btn" > Yeni kod alın </a>
            </div>

<!--            <div class="">-->
<!--                <push></push>-->
<!--            </div>-->
        </div>
</template>

<script>

import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

export default {
    name: "ConfirmPVerificationCode",
    props:['user','code','timer', 'delete_token'],
    data() {
        return {
            input_1: '',
            input_2: '',
            input_3: '',
            input_4: '',
            input_5: '',
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
            if( this.this_user_id && this.this_code ) this.deleteToken()
        }
    },
    methods: {
        resendCode(e) {
            e.preventDefault();
            this.is_resend_code = false;
            this.show_timer = false;
            this.verificationTimer( this.getCurrentTimes(), this.this_timer, false );

            setTimeout( () => {
                if( this.this_user_id && this.this_code ) {
                    axios({
                        method:"post",
                        url:"/resend-verification-code",
                        data: {
                            user_id: this.this_user_id,
                            code: this.this_code,
                            save_time: this.getCurrentTimes(),
                        },
                    })
                        .then(res => {
                            if ( res && res.data && res.data.user_id && res.data.new_code && res.data.timer ) {
                                this.deleteNotificationByMessage( 'Gözləmə vaxtı bitdiyi üçün' );
                                this.show_timer = true;
                                this.this_code = res.data.new_code;
                                this.this_timer = res.data.timer;
                                this.this_user_id = res.data.user_id;

                                this.verificationTimer( this.getCurrentTimes(), res.data.timer, true );

                                // Display an error notification
                                let message = 'Yeni kod <b>Email</b> addresinizə göndərildi.';
                                this.callNotification('success', message, 12000, true, 'green', 'right','top' );
                                // let notyf = new Notyf({
                                //     dismissible: true,
                                //     duration: 12000,
                                //     position: {
                                //         x:'right',
                                //         y:'top'
                                //     },
                                //     types:[{}]
                                // });
                                // notyf.open({
                                //     type:'success',
                                //     message: 'Yeni kod <b>Email</b> addresinizə göndərildi.',
                                // });

                                console.log( 'NEW-VERIFICATION CODE 1 res - ',  this.this_user_id+' - '+ this.this_code+' - '+ this.this_timer )
                            }

                            console.log( 'NEW-VERIFICATION CODE 2 - ', res.data )
                        })
                        .catch(err => {
                            console.log('NEW-VERIFICATION CODE err - ', err.response )
                        });
                }
            }, 2000 );
        },
        deleteToken() {
            if( this.this_user_id && this.this_code ) {
                axios({
                    method:"post",
                    url:"/delete-token",
                    data: {
                        user_id: this.this_user_id,
                        code: this.this_code,
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
        verificationTimer(current_timer, timer, show=false) {
            if( current_timer && timer ) {
                let timer_div = document.getElementsByClassName('code__timer');
                let time = ( current_timer - Number(timer) );
                let sec = 30 - (time  / 1000);

                if( localStorage.getItem('clear') ) clearInterval(localStorage.getItem('clear'));

                if( show ) {
                    let timer_set = setInterval(() => {
                        if ( sec >= 0 && timer_div && timer_div[0] ) {
                            timer_div[0].innerHTML = sec;
                            sec -= 1

                            if (sec < 0) {
                                sec = '00:00';
                                timer_div[0].innerHTML = sec;

                                let message = 'Gözləmə vaxtı bitdiyi üçün <br/> <b>kod</b> etibarsızdir!, <br/> Yeni <b>kod</b> alın';
                                this.callNotification('warning', message,12000,true, 'orange', 'right', 'top');

                                clearInterval(timer_set);
                            }
                            // console.log('TTTTTTTTT - ',  this.getCurrentTimes() +' - '+ this.timer +' - '+ show )
                        }
                        this.is_resend_code = true;
                    }, 1000);

                    localStorage.setItem( 'clear', timer_set );
                }
            }
        },
        setInSessionCode(user_id, code, timer){
            if( timer ) localStorage.setItem('timer', timer );
        },
        removeSessionItems(items) {
            if( items && items.length ) {
                let count = 0;
                items.forEach( item => {
                    localStorage.removeItem( item );
                    if( localStorage.getItem(item) ) return false;
                    count++;
                })

               if(  count === items.length ) return true;
            }
            return false;
        },
        issetSessionItems(items) {
            if( items && items.length ) {
                let count = 0;
                let isset = null;
                items.forEach( item => {
                    isset = localStorage.getItem( item );
                    if( ! localStorage.getItem( item ) ) return false;
                    count++;
                    console.log('issetSessionItems - ', isset )
                });

                if( count === items.length ) return true;
            }
            return false;
        },
        changeInputFocus(event) {
            let class_name = event.target.classList[0];
            let key = event.which || event.keyCode || event.charCode;
            let input_1 = document.getElementsByClassName('pincode1');
            let input_2 = document.getElementsByClassName('pincode2');
            let input_3 = document.getElementsByClassName('pincode3');
            let input_4 = document.getElementsByClassName('pincode4');
            let input_5 = document.getElementsByClassName('pincode5');

            // console.info( 'key key key - ', key );

            if( key && key >= 48 && key <= 57 ) {
                if( event && event.target && event.target.classList && event.target.classList[0] ) {
                    if ( class_name === 'pincode1' && input_2 && input_2[0] ) {
                        this.detectInputs(input_2);
                        let inter1 = setInterval( () => {
                            if( this.input_1 ) this.setVerificationCode(inter1, this.input_1, 0);
                            this.checkCountCode();
                        }, 0.1 );
                        this.setIntervalClear(inter1);
                    }
                    if ( class_name === 'pincode2' && input_2 && input_2[0] ) {
                        this.detectInputs(input_3);
                        let inter2 = setInterval( () => {
                            if( this.input_2 ) this.setVerificationCode(inter2, this.input_2, 1);
                            this.checkCountCode();
                        }, 0.1 );
                        this.setIntervalClear(inter2);
                    }
                    if ( class_name === 'pincode3' && input_3 && input_3[0] ) {
                        this.detectInputs(input_4);
                        let inter3 = setInterval( () => {
                            if( this.input_3 ) this.setVerificationCode(inter3, this.input_3, 2);
                            this.checkCountCode();
                        }, 0.1 );
                        this.setIntervalClear(inter3);
                    }
                    if ( class_name === 'pincode4' && input_4 && input_4[0] ) {
                        this.detectInputs(input_5);
                        let inter4 = setInterval( () => {
                            if( this.input_4 )  this.setVerificationCode(inter4, this.input_4, 3);
                            this.checkCountCode();
                        }, 0.1 );
                        this.setIntervalClear(inter4);
                    }
                    if ( class_name === 'pincode5' && input_5 && input_5[0] ) {
                        let inter5 = setInterval( () => {
                            if( this.input_5 )  this.setVerificationCode(inter5, this.input_5, 4);
                            this.checkCountCode();
                        }, 0.1 );
                        this.setIntervalClear(inter5);
                    }
                }
            }
            else if( key === 8 || key === 46 ) {
                if ( class_name === 'pincode1' && input_2 && input_2[0] ) {
                    if( this.vrf_code.length && this.vrf_code[0] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 0 } );
                        this.deleteNotificationByMessage('Yanlış kod!');
                    }
                }
                if ( class_name === 'pincode2' && input_2 && input_2[0] ) {
                    this.detectInputs(input_1);
                    if( this.vrf_code.length && this.vrf_code[1] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 1 } );
                        this.deleteNotificationByMessage('Yanlış kod!')
                    }
                }
                if ( class_name === 'pincode3' && input_2 && input_2[0] ) {
                    this.detectInputs(input_2);
                    if( this.vrf_code.length && this.vrf_code[2] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 2 } );
                        this.deleteNotificationByMessage('Yanlış kod!');
                    }
                }
                if ( class_name === 'pincode4' && input_3 && input_3[0] ) {
                    this.detectInputs(input_3);
                    if( this.vrf_code.length && this.vrf_code[3] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 3 } );
                        this.deleteNotificationByMessage('Yanlış kod!');
                    }
                }
                if ( class_name === 'pincode5' && input_4 && input_4[0] ) {
                    this.detectInputs(input_4);
                    if( this.vrf_code.length ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 4 } );
                        this.deleteNotificationByMessage('Yanlış kod!');
                    }
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
        checkCountCode() {
            if( this.vrf_code && this.vrf_code.length === 5 ) {
                let code = null;
                let vrf_code = null;

                if( this.vrf_code && this.vrf_code.length && typeof this.vrf_code === 'object' ) {
                    code = this.code ? String( this.code ) : localStorage.getItem('code');
                    vrf_code = String( this.vrf_code.join('').replace(', ','') );
                }

                if( code === vrf_code ) {
                    console.info( 'send_verification_code - ', this.code === this.vrf_code );
                    this.checkVerificationCode();
                }
                else this.callNotification( 'error','<b>Yanlış kod!</b>',13000,true, 'red', 'right', 'bottom');

                console.info( 'watch - ', code +' - '+ vrf_code );
            }
            return false;
        },
        deleteNotificationByMessage(message) {
            if( message ) {
                let find = setInterval(() => {
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
                }, 0.1);

                setTimeout(() => {
                    clearInterval(find)
                }, 10000)
            }
        },
        recursiveDelete(parent, child, text) {
            if( parent && child && child.length && text ){
                child.forEach( el => {
                    if( el.classList && el.classList.contains('notyf__message') && el.innerText.indexOf(text) !== -1 ) {
                        console.info( 'el.remove - ',  parent );
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
                        if( res.data.auth_user ) {
                            this.success = true;
                            document.location.href = '/product/'+Number( this.getProductID() );
                            console.log( 'check-verification-code res - ', res.data.auth_user )
                        }

                        console.log( 'check-verification-code res 111 - ', res.data.auth_user )
                    }

                    console.log( 'check-verification-code ressss 222 - ', res.data.user )
                })
                .catch(err => {
                    console.log('check-verification-code err - ', err.response.data.message)
                })
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
        this.verificationTimer( this.getCurrentTimes(), this.timer, true );

        document.addEventListener('DOMContentLoaded', () => {
            if( this.this_user_id && this.this_code ) this.deleteToken()
        })

        // console.log('""""""""""""" - ', this.this_user_id+" - "+this.code+" - "+this.timer )
    }
}
</script>

<style scoped>

.code__title {
    margin-top: -20px;
    margin-bottom: 25px;
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

.code__styles {
    width: 45px;
    height: 40px;
    border-radius: 0;
    border: 1px solid #6361614d;
    box-shadow: 1px 1px 2px 0 #b7b2b2bd;
    margin-right: 10px;
    text-align: center;
    font-size: 1.52rem;
}

</style>
