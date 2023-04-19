<template>
    <div class="col-12 col-sm-8 col-md-6 col-xl-6 col-xxl-6">
            <div v-if="not_user_error" class="mb-3 fs-4 text-danger">
                Elan sizə aid deyil!
            </div>

            <div class="form-floating has-validation">
                <input
                    v-model="name"
                    class="form-control pb-0 rounded-0 border-top-0 border-start-0 border-opacity-25 border-end-0 bg-white fs-5"
                    placeholder="Adınız"
                    type="text"
                    id="name"
                >
                <label for="name" class="text-secondary fs-5 for__name">
                    Adınız <span class="text-danger text-opacity-75">*</span>
                </label>
                <div v-if="name_error" class="invalid-feedback d-block fs-6 mt-1" id="name-error">
                    {{ name_error_text }}
                </div>
            </div>

            <div class="form-floating">
                <input
                    v-model="phone"
                    class="form-control pb-0 rounded-0 border-top-0 border-start-0 border-opacity-25 border-end-0 bg-white fs-5"
                    placeholder="+994 (000) 000-00-00"
                    v-maska="'+994## ###-##-##'"
                    id="phone"
                >
                <label for="floatingInput" class="text-secondary fs-5">
                    Mobil nömrə
                    <span class="text-danger text-opacity-75">*</span>
                </label>

                <div v-if="phone_error" class="invalid-feedback d-block fs-6 mt-1" id="name-error">
                    {{ phone_error_text }}
                </div>
            </div>


            <div class="col-12 mt-5 d-flex justify-content-center">
                <div v-if="!btn_spinner" @click="sendPhoneAndName" class="col-6 btn btn-outline-success rounded-0 fs-5 w-100">
                    Göndər
                </div>

                <button v-if="btn_spinner" class="col-6 btn btn-outline-success rounded-0 fs-5 w-100" id="spinner-btn" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Göndər...
                </button>
            </div>
        </div>
</template>

<script>

import {maska} from "maska";
export default {
    name: "ConfirmPhoneAndName",
    directives: { maska },
    props: ['not_user_error','remove_errors'],
    data() {
        return {
            name: null,
            phone: null,
            invalid: '',
            name_error: null,
            phone_error: null,
            name_error_text: '',
            phone_error_text: '',
            btn_spinner: null,
        }
    },
    watch: {
        remove_errors() {
            this.removeErrors();
        },
        not_user_error(){
            if( this.not_user_error ) this.btn_spinner = false;
        }
    },
    methods: {
        checkInputName() {
            // console.log( 'checkInputName - ' , this.name.length )
            let input_div = document.getElementById('name');
            this.name = !this.name ? this.name : this.name.trim();
            if( !this.name || this.name.length === 0 ) {
                this.name_error = true;
                this.name_error_text = 'Ad mütləqdir!';
            } else if( this.name.length < 3 ) {
                console.log( 'checkInputName - ' , this.name.length )
                this.name_error = true;
                this.name_error_text = 'Ad üç hərfdən az olmamalıdır!';
            } else {
                this.name_error = null;
                this.name_error_text = '';
            }

            if( this.name_error_text ) {
                if( input_div && input_div.classList && !input_div.classList.contains('border-danger') ) {
                    input_div.classList.add('border-danger');
                }
            } else {
                if( input_div.classList.contains('border-danger') ) {
                    input_div.classList.remove('border-danger');
                    input_div.classList.add('border-secondary');
                }
            }
        },
        checkInputPhone() {
            // console.log( 'checkInputPhone - ' , this.phone )
            let input_div = document.getElementById('phone');
            this.phone = !this.phone ? this.phone : this.phone.trim();
            if( !this.phone || this.phone.length === 0 ) {
                this.phone_error = true;
                this.phone_error_text = 'Nömrə mütləqdir!';
            } else if( this.phone.length < 16 ) {
                this.phone_error = true;
                this.phone_error_text = 'Nömrə tam qeyd olunmalıdır!';
            } else {
                this.phone_error = null;
                this.phone_error_text = '';
            }

            if( this.phone_error_text ) {
                if( input_div && input_div.classList && !input_div.classList.contains('border-danger') ) {
                    input_div.classList.add('border-danger');
                }
            } else {
                if( input_div.classList.contains('border-danger') ) {
                    input_div.classList.remove('border-danger');
                    input_div.classList.add('border-secondary');
                }
            }
        },
        removeErrors() {
            let name_div = document.getElementById('name');
            let phone_div = document.getElementById('phone');

            this.name_error = null;
            this.name_error_text = '';
            this.phone_error = null;
            this.phone_error_text = '';

            if( name_div && name_div.classList && name_div.classList.contains('border-danger') ) {
                name_div.classList.remove('border-danger');
                name_div.classList.add('border-secondary');
            }

            if( phone_div && phone_div.classList && phone_div.classList.contains('border-danger') ) {
                phone_div.classList.remove('border-danger');
                phone_div.classList.add('border-secondary');
            }
        },
        sendPhoneAndName() {
            this.btn_spinner = true;
            this.checkInputName();
            this.checkInputPhone();

            // setTimeout( () => {
                if( !this.name_error && !this.phone_error )
                    this.$emit('sendPhoneAndName', { name: this.name, phone: this.generateNumber(this.phone) });
                else {
                    this.btn_spinner = false;
                }
            // },3000);
        },
        addClassFunc(element, add_class) {
            let el = document.getElementById(element);
            if( el && el.classList && !el.classList.contains(add_class) )
                el.classList.add(add_class);
        },
        removeClassFunc(element, remove_class) {
            let el = document.getElementById(element);
            if( el && el.classList && el.classList.contains(remove_class) )
                el.classList.remove(remove_class);
        },
        generateNumber(phone) {
            if( phone ) {
                let num = phone.match(/\d+/g).join('');
                let operator = num.substring(0, 3);
                    num = num.substring(3);

                return '+' + operator+''+num;
            }
        }
    },
}
</script>

<style scoped>

</style>
