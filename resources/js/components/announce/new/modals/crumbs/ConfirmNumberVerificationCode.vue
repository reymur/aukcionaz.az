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

            <div class="code__title">
                <div class=""> Telefona gələn 5 rəqmli kodu daxil edin </div>
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

        </div>
</template>

<script>


export default {
    name: "ConfirmPVerificationCode",
    props:['user','code','is_visible'],
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
            send_verification_code: false,
        }
    },
    computed: {
        // setInSessionCode(){
        //     if( this.code ) localStorage.setItem('code', this.code );
        // }
    },
    watch:{
        send_verification_code() {
            if( this.send_verification_code ) {
                let code = null;
                // let vrf_code = null;

                if( this.vrf_code && this.vrf_code.length && typeof this.vrf_code === 'object' ) {
                    code = this.code ? String( this.code ) : localStorage.getItem('code');
                    this.vrf_code = String( this.vrf_code.join('').replace(', ','') );
                }

                if( code === this.vrf_code ) {
                    console.info( 'send_verification_code - ', this.code === this.vrf_code );
                    this.checkVerificationCode();
                }
                else this.code_error = true;

                console.info( 'watch - ', this.code +' - '+ this.vrf_code );
            }
        }
    },
    methods: {
        setInSessionCode(){
            if( this.code ) localStorage.setItem('code', this.code );
            if( this.user ) localStorage.setItem('user_id', this.user.id );
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
                        this.vrf_code[0] = null;
                        this.vrf_code = this.vrf_code.filter( e => { return e !== null });
                        // console.info( 'vrf_code value delete - ', this.vrf_code );
                    }
                }
                if ( class_name === 'pincode2' && input_2 && input_2[0] ) {
                    this.detectInputs(input_1);
                    if( this.vrf_code.length && this.vrf_code[1] ) {
                        this.vrf_code[1] = null;
                        this.vrf_code = this.vrf_code.filter( e => { return e !== null });
                        // console.info( 'vrf_code value delete - ', this.vrf_code );
                    }
                }
                if ( class_name === 'pincode3' && input_2 && input_2[0] ) {
                    this.detectInputs(input_2);
                    if( this.vrf_code.length && this.vrf_code[2] ) {
                        this.vrf_code[2] = null;
                        this.vrf_code = this.vrf_code.filter( e => { return e !== null });
                        // console.info( 'vrf_code value delete - ', this.vrf_code );
                    }
                }
                if ( class_name === 'pincode4' && input_3 && input_3[0] ) {
                    this.detectInputs(input_3);
                    if( this.vrf_code.length && this.vrf_code[3] ) {
                        this.vrf_code[3] = null;
                        this.vrf_code = this.vrf_code.filter( e => { return e !== null });
                        // console.info( 'vrf_code value delete - ', this.vrf_code );
                    }
                }
                if ( class_name === 'pincode5' && input_4 && input_4[0] ) {
                    this.detectInputs(input_4);
                    if( this.vrf_code.length && this.vrf_code[4] ) {
                        this.vrf_code[4] = null;
                        this.vrf_code = this.vrf_code.filter( e => { return e !== null });
                        console.info( 'vrf_code value delete - ', this.vrf_code );
                    }
                }
            }
            else {
                event.preventDefault();
            }
        },
        checkCountCode() {
            if( this.vrf_code && this.vrf_code.length === 5 ) {
                return this.send_verification_code = true;
            }
            return false;
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
                    verification_code: this.vrf_code
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

        this.setInSessionCode();
    }
}
</script>

<style scoped>

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

.code__title {
    margin: auto;
    position: absolute;
    top: -45px;
    right: 0;
    bottom: 0;
    left: 0;
    color: #858282;
    font-size: 1.1rem;
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
