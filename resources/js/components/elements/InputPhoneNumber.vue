<template>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">

                    <div class="form-floating">
                        <input class="form-control rounded-0 border-top-0 border-start-0 border-opacity-25
                                        border-end-0 border-bottom-secondary bg-white"
                            v-maska="'+994 (###) ###-##-##'" 
                            placeholder="+994 (000) 000-00-00">

                            <label for="floatingInput" class="text-secondary fs-5">
                                    Adınız
                                    <span class="text-danger text-opacity-75">*</span>
                            </label>
                    </div>

                    <div class="form-floating">
                        <input class="form-control rounded-0 form-control border-top-0 border-start-0 border-opacity-25
                                        border-end-0 border-bottom-secondary bg-white"
                            v-maska="'+994 (###) ###-##-##'" 
                            placeholder="+994 (000) 000-00-00">

                            <label for="floatingInput" class="text-secondary fs-5">
                                    E-mail
                                    <span class="text-danger text-opacity-75">*</span>
                            </label>
                    </div>

                    <div class="form-floating">
                        <input class="form-control rounded-0 form-control border-top-0 border-start-0 border-opacity-25
                                        border-end-0 border-bottom-secondary bg-white"
                            v-maska="'+994 (###) ###-##-##'" 
                            placeholder="+994 (000) 000-00-00">

                            <label for="floatingInput" class="text-secondary fs-5">
                                    Mobil nömrə
                                    <span class="text-danger text-opacity-75">*</span>
                            </label>
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
                value: '7321234567',
            }
           
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
