<template>
    <div class="col-12 px-3">
        <div class="col">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 m-auto">

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
                        v-model="email"
                        class="form-control pb-0 rounded-0 border-top-0
                               border-start-0 border-opacity-25
                               border-end-0 border-bottom-secondary bg-white fs-5"
                        placeholder="E-mail"
                        type="email"
                        id="email"
                    >
                    <label for="email" class="text-secondary fs-5">
                        E-mail
                        <span class="text-danger text-opacity-75">*</span>
                    </label>

                    <div class="invalid-feedback fs-6 mt-1" id="email-error"> <!-- error text--> </div>
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

            </div>
        </div>
    </div>
</template>

<script>
   import { maska } from 'maska'
    export default {
        directives: { maska },
        data() {
            return {
                name: '',
                email: '',
                phone: '',
            }
        },
        watch: {
            name(){
                this.$emit('sendUserNameToNewAnnounceComponent', {
                    name: this.name
                });
            },
            email(){
                this.$emit('sendUserEmailToNewAnnounceComponent', {
                    email: this.email
                });
            },
            phone(){
                this.$emit('sendUserPhoneNumberToNewAnnounceComponent', {
                    phone: this.phone
                });
            }
        },
        methods: {

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    .form-control:focus, .form-control:active {
        outline: none;
        border: none;
        border-bottom: 1px solid #000;
        box-shadow: none !important;
        padding-bottom: 0;
    }

</style>
