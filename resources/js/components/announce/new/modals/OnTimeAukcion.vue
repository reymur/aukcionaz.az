<template>
    <div class=" mt-2 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0 mt-xxl-0">
        <div class="d-flex form-group">
            <select @change="horusFunc" v-model="horus" class="form-select rounded-0" aria-label="Default select example">
                <option disabled selected> Saat </option>
                <option v-for="h of 24" :value="h">{{ h }} saat</option>
            </select>

            <select @change="minuteFunc" v-model="minute" class="form-select rounded-0" aria-label="Default select example">
                <option disabled selected> Dəyqə </option>
                <option v-for="m of 59" :value="m">{{ m }} dəyqə</option>
            </select>
        </div>

        <div class="d-flex mt-2 fs-5 justify-content-center">
            <div class="d-flex align-self-center">
                <div class="d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex aukcion-load">
                    <div class="me-sm-3 me-md-3 me-lg-3 me-xl-3 me-xxl-3 d-flex">
                        <span class="me-2 auksiyon_text_style"> Auksion </span>
                        davam etsin:
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-center horus-and-minute-div">
                            <div class="horus-section me-1"> _ </div>
                            <div class="dot"> : </div>
                            <div class="minute-section ms-1"> _ </div>
                        </div>

                        <div v-if="show_close" class="d-flex ms-3">
                            <div @click="timeReset" class="fs-6 text-danger align-self-center" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OnTimeAukcion",
    data(){
        return {
            horus: 'Saat',
            minute: 'Dəyqə',
            show_close: false,
        }
    },
    watch:{
        horus() {
            let horus_and_minute_div = document.getElementsByClassName('horus-and-minute-div');

            if( typeof this.horus === 'number' ) {
                setTimeout( () => {
                    this.show_close = true;
                }, 200 );
            } else {
                this.show_close = false;
            }

            if( horus_and_minute_div && horus_and_minute_div[0] ) {
                horus_and_minute_div[0].style = 'border-bottom: 1px solid #000'
            }
        },
        minute() {
            let horus_and_minute_div = document.getElementsByClassName('horus-and-minute-div');

            if( typeof this.minute === 'number' ) {
                setTimeout( () => {
                    this.show_close = true;
                }, 100 );
            } else {
                this.show_close = false;
            }

            if( horus_and_minute_div && horus_and_minute_div[0] ) {
                horus_and_minute_div[0].style = 'border-bottom: 1px solid #000'
            }
        }
    },
    methods:{
        horusFunc() {
            this.setInnerText( this.horus, 'saat', 'horus-section');
        },
        minuteFunc() {
            this.setInnerText( this.minute, 'dəyqə', 'minute-section');
        },
        timeReset() {
            this.horus = 'Saat';
            this.minute = 'Dəyqə'
            this.setInnerText( '_', false, 'horus-section');
            this.setInnerText( '_', false, 'minute-section');

            let border_remove = setInterval( () => {
                let horus_and_minute_div = document.getElementsByClassName('horus-and-minute-div');

                if( horus_and_minute_div && horus_and_minute_div[0] ) {
                    horus_and_minute_div[0].style = 'border: none;';
                    clearInterval( border_remove );
                }
            }, 0.1);

            setTimeout( () => {
                clearInterval( border_remove );
            }, 3000);
        },
        setInnerText( text, time, className ) {
            let class_name = document.getElementsByClassName(className);
            let time_text = '<span class="fs-6">'+ time +'</span>'
            if( text && time && className ) {
                if( class_name && class_name[0] ) class_name[0].innerHTML = text +' '+ time_text;
            }
            else {
                if( class_name && class_name[0] ) class_name[0].innerText = text;
            }
        }
    }
}
</script>

<style scoped>
    .form-select:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #bdc3c9;
    }
    .form-select:active {
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #bdc3c9;
    }
    .auksiyon_text_style {
        font-size: 1em;
        color: #41830b;
        font-weight: bold;
    }
</style>
