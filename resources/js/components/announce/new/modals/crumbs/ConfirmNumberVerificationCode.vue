<template>
    <div class="col-12 col-sm-8 col-md-6 col-xl-6 col-xxl-6">

            <div class="form-floating">
                <input
                    @keydown="inputMask"
                    v-model="verification_code"
                    class="form-control pb-0 rounded-0 border-top-0
                               border-start-0 border-opacity-25 border-end-0
                               border-bottom-secondary bg-white fs-5"

                    id="verification-code"
                >

                <div class="invalid-feedback fs-6 mt-1" id="phone-error"> <!-- error text--> </div>
            </div>


            <div class="col-12 mt-5 d-flex justify-content-center">
                <div @click="checkVerificationCode" class="col-6 btn btn-outline-success rounded-0 fs-5 w-100">
                    Göndər
                </div>
            </div>
        </div>
</template>

<script>

export default {
    name: "ConfirmPVerificationCode",
    data() {
        return {
            verification_code: null,
        }
    },
    methods: {
        checkVerificationCode() {
            axios({
                method: "post",
                url: "/check-verification-code",
                data: {
                    verification_code: this.verification_code
                },
            })
                .then(res => {
                    if (res && res.data && res.data.success) {
                        this.success = true;
                        console.log('check-verification-code res - ', res.data.success)
                    }
                })
                .catch(err => {
                    console.log('check-verification-code err - ', err.response.data.message)
                })
        },
        inputMask() {
            // let m = new mask;
            console.log( 'XXXXXXXXXXXXXXX - ', this.verification_code )
            let verification_code = document.getElementById('verification-code');

            if( verification_code && verification_code[0] ) {
                verification_code[0].mask( "9.9.9.9", { placeholder: "_ _ _ _"  } );
            }
        }
    }
}
</script>

<style scoped>



</style>
