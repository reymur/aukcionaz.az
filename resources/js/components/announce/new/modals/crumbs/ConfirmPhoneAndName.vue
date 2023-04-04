<template>
    <div class="col-12 col-sm-8 col-md-6 col-xl-6 col-xxl-6">
            <div class="form-floating has-validation">
                <input
                    v-model="name"
                    class="form-control pb-0 rounded-0 border-top-0
                               border-start-0 border-opacity-25
                               border-end-0 border-bottom-secondary bg-white fs-5"
                    placeholder="Adınız"
                    type="text"
                    id="name"
                >
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
                <label for="name" class="text-secondary fs-5">
                    Adınız
                    <span class="text-danger text-opacity-75">*</span>
                </label>

                <div class="invalid-feedback fs-6 mt-1" id="name-error"> <!-- error text--> </div>
            </div>

            <div class="form-floating">
                <input
                    v-model="phone"
                    class="form-control pb-0 rounded-0 border-top-0
                               border-start-0 border-opacity-25 border-end-0
                               border-bottom-secondary bg-white fs-5"
                    placeholder="+994 (000) 000-00-00"
                    v-maska="'+994 (###) ###-##-##'"
                    id="phone"
                >
                <label for="floatingInput" class="text-secondary fs-5">
                    Mobil nömrə
                    <span class="text-danger text-opacity-75">*</span>
                </label>

                <div class="invalid-feedback fs-6 mt-1" id="phone-error"> <!-- error text--> </div>
            </div>


            <div class="col-12 mt-5 d-flex justify-content-center">
                <div @click="sendPhoneAndName" class="col-6 btn btn-outline-success rounded-0 fs-5 w-100">
                    Göndər
                </div>
            </div>
        </div>
</template>

<script>

import {maska} from "maska";
export default {
    name: "ConfirmPhoneAndName",
    directives: { maska },
    data() {
        return {
            name: null,
            phone: null,
        }
    },
    methods: {
        sendPhoneAndName() {
            this.$emit('sendPhoneAndName', {
                name: this.name,
                phone: this.generateNumber(this.phone)
            })
        },
        generateNumber(phone) {
            if( phone ) {
                let num = phone.match(/\d+/g).join('');
                let operator = num.substring(0, 3);
                    num = num.substring(4);

                return '+' + operator+''+num;
            }
        }
    },
}
</script>

<style scoped>

</style>
