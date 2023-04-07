<template>
    <div class="col-12 col-sm-8 col-md-6 col-xl-6 col-xxl-6">

<!--            <div class="form-floating">-->
<!--                <input-->
<!--                    @keydown="inputMask"-->
<!--                    v-model="vrf_code"-->
<!--                    class="form-control pb-0 rounded-0 border-top-0-->
<!--                               border-start-0 border-opacity-25 border-end-0-->
<!--                               border-bottom-secondary bg-white fs-5"-->

<!--                    id="verification-code"-->
<!--                >-->

<!--                <div class="invalid-feedback fs-6 mt-1" id="phone-error"> &lt;!&ndash; error text&ndash;&gt; </div>-->
<!--            </div>-->


<!--            <div class="col-12 mt-5 d-flex justify-content-center">-->
<!--                <div @click="checkVerificationCode" class="col-6 btn btn-outline-success rounded-0 fs-5 w-100">-->
<!--                    Göndər-->
<!--                </div>-->
<!--            </div>-->


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

            <div class="code__timer">2 : 34</div>

            <div class="resend__new_cod_div">
                <div class="resend__new_cod_text"> Kod gəlmədi? </div>
                <a v-if="is_resend_code" @click="e => e.preventDefault()" href="" disabled class="text-muted resend__new_cod_btn" > Yeni kod alın </a>
                <a v-if="! is_resend_code" @click="resendCode" href="" disabled class="resend__new_cod_btn" > Yeni kod alın </a>
            </div>

        </div>
</template>

<script>


export default {
    name: "ConfirmPVerificationCode",
    props:['user','code','timer'],
    data() {
        return {
            input_1: '',
            input_2: '',
            input_3: '',
            input_4: '',
            input_5: '',
            set_focus: null,
            vrf_code: [],
            code_error: false,
            is_resend_code: false,
            send_verification_code: false,
        }
    },
    computed: {
        // setInSessionCode(){
        //     if( this.code ) localStorage.setItem('code', this.code );
        // }
    },
    watch:{

    },
    methods: {
        resendCode(e) {
            e.preventDefault();
            this.is_resend_code = true;
            let code = localStorage.getItem('code');
            let user_id = localStorage.getItem('user_id');

            setTimeout( () => {
                if( user_id && code ) {
                    axios({
                        method:"post",
                        url:"/resend-verification-code",
                        data: {
                            user_id: user_id,
                            code: code,
                        },
                    })
                        .then(res => {
                            if ( res && res.data && res.data.user_id && res.data.new_code && res.data.timer ) {
                                this.removeSessionItems(['user_id','code','timer']);
                                if( ! this.issetSessionItems(['user_id','code','timer']) )
                                    this.setInSessionCode(res.data.user_id, res.data.new_code, res.data.timer);

                                if( this.issetSessionItems(['user_id','code','timer']) ) this.is_resend_code = false;

                                console.log( 'NEW-VERIFICATION CODE 1 res - ', localStorage.getItem('user_id')+' - '+localStorage.getItem('code')+' - '+localStorage.getItem('timer') )
                            }

                            console.log( 'NEW-VERIFICATION CODE 2 - ', res.data )
                        })
                        .catch(err => {
                            console.log('NEW-VERIFICATION CODE err - ', err.response )
                        })
                }
            }, 2000 );
        },
        setInSessionCode(user_id, code, timer){
            if( user_id && code && timer ) {
                localStorage.setItem('user_id', user_id);
                localStorage.setItem('code', code );
                localStorage.setItem('timer', timer );
            }
        },
        removeSessionItems(items) {
            if( items && items.length ) {
                items.forEach( item => {
                    localStorage.removeItem( item )
                })
            }
        },
        issetSessionItems(items) {
            if( items && items.length ) {
                let count = 0;
                let isset = null;
                items.forEach( item => {
                    isset = localStorage.getItem( item );
                    if( !isset ) return false;
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
                        this.removeErrorText();
                    }
                }
                if ( class_name === 'pincode2' && input_2 && input_2[0] ) {
                    this.detectInputs(input_1);
                    if( this.vrf_code.length && this.vrf_code[1] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 1 } );
                        this.removeErrorText();
                    }
                }
                if ( class_name === 'pincode3' && input_2 && input_2[0] ) {
                    this.detectInputs(input_2);
                    if( this.vrf_code.length && this.vrf_code[2] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 2 } );
                        this.removeErrorText();
                    }
                }
                if ( class_name === 'pincode4' && input_3 && input_3[0] ) {
                    this.detectInputs(input_3);
                    if( this.vrf_code.length && this.vrf_code[3] ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 3 } );
                        this.removeErrorText();
                    }
                }
                if ( class_name === 'pincode5' && input_4 && input_4[0] ) {
                    this.detectInputs(input_4);
                    if( this.vrf_code.length ) {
                        this.vrf_code = this.vrf_code.filter( (e, index) => { return index !== 4 } );
                        this.removeErrorText();
                    }
                }
            }
            else {
                event.preventDefault();
            }
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
                else this.code_error = true;

                console.info( 'watch - ', code +' - '+ vrf_code );
            }
            return false;
        },
        removeErrorText() {
            this.code_error = false;
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
                    console.info( 'vrf_code value - ', this.value_var );
                    if( this.value_var ) {
                        clearInterval(inter);
                        return this.value_var;
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
                    user_id: this.user ? this.user.id : localStorage.getItem('user_id'),
                    code: this.code ? this.code : localStorage.getItem('code'),
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
    },
    mounted(){
        console.log('user and code - ', this.user+' - '+this.code )
        if( this.user && this.user.id && this.code && this.timer) this.setInSessionCode(this.user.id, this.code, this.timer);
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
