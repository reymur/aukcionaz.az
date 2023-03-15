<template>
    <div class="">
        <Datepicker
            v-model="picked"
            placeholder="Tarix seçin"
        />
    </div>
</template>

<script>
import Datepicker from 'vue3-datepicker'
import { ref } from 'vue'
import {toString} from "lodash";
export default {
    props: ['reset_al_time'],
    data() {
        return {
            picked: ref(new Date())
        }
    },
    components: {
        Datepicker
    },
    watch: {
        reset_al_time(){
            if( this.reset_al_time === true ) {
                this.resetDate();
            }
        },
        picked() {
            this.$emit( 'timePickerIsChanged', true );
        }
    },
    methods: {
        resetDate() {
            this.picked = null;
            // console.log('reset Date')
        },
        changeDataPickerInputStyles() {
            let input_parent = document.getElementsByClassName('v3dp__input_wrapper');
            let v3dp__clearable = document.getElementsByClassName('v3dp__clearable');

            if( input_parent && input_parent.length ) {
                for (let i = 0; i < input_parent.length; i++) {
                    if( input_parent[i].children && input_parent[i].children[0] ) {
                        if ( input_parent[i].children[0].style ) {
                            input_parent[i].children[0].style = 'display:block; position:relative; top:2px; cursor:pointer; background-color: rgb(245 246 250); margin-left:5px; height:37px; border:none; font-size:1.2rem; color:rgb(65 63 63); width:100%; text-align:center;';

                            // console.log( 'AAAAAA111 = ', input_parent[i].children )
                        }
                    }
                }
            }

            if( v3dp__clearable && v3dp__clearable.length ) {
                if( v3dp__clearable[0] && v3dp__clearable[0].children ) {
                    if ( v3dp__clearable[0].children && v3dp__clearable[0].children[0] ) {
                        // v3dp__clearable[0].children[0].innerHTML =  '<div class="position-relative">'+
                        //     '<img src="/storage/images/icons/aukcion_date_close_icon.png" alt="" class="aukcion_date_close_icon">'
                        //     +'</div>';
                        // v3dp__clearable[0].children[0].style = 'position: absolute; margin: -39px 0px 0px 165px; padding: 8px 15px 5px 5px;';
                        // console.log( 'v3dp__clearable[0].children = ', v3dp__clearable[0].children )
                    }
                    // v3dp__clearable[0].style = 'position: absolute; margin: -40px 0 0 190px; padding: 10px 17px;';
                }
            }

            let v3dp__elements_I = setInterval( () => {
                let v3dp__elements = document.getElementsByClassName('v3dp__elements');

                if( v3dp__elements && v3dp__elements.length ) {
                    v3dp__elements.forEach( e => {
                        if( e.style ) {
                            e.style = 'font-size: 1.1em';
                            // console.log( 'e.style = ', e.style.fontSize )
                        }
                    });
                }
            },1 );

            let v3dp__heading_I = setInterval( () => {
                let v3dp__heading = document.getElementsByClassName('v3dp__heading');

                if( v3dp__heading && v3dp__heading.length ) {
                    v3dp__heading.forEach( e => {
                        if( e.style ) {
                            e.style = 'font-size: 1.3em';
                            // console.log( 'e.style = ', e.style.fontSize )
                        }
                    });
                }
            },1 );

            let v3dp__subheading_I = setInterval( () => {
                let v3dp__subheading = document.getElementsByClassName('v3dp__subheading');

                if( v3dp__subheading && v3dp__subheading.length ) {
                    v3dp__subheading.forEach( e => {
                        if( e.style ) {
                            e.style = 'font-size: 1.1em';
                            // console.log( 'e.style = ', e.style.fontSize )
                        }
                    });
                }
            },1 );

            setTimeout( () => {
                clearInterval(v3dp__elements_I);
                clearInterval(v3dp__heading_I);
                clearInterval(v3dp__subheading_I);
            }, 5000 );
        }
    },
    mounted() {
        this.changeDataPickerInputStyles();
    }
}

</script>

<style scoped>
    .v3dp__elements {
        --elem-font-size: 1.1em;
    }
</style>
