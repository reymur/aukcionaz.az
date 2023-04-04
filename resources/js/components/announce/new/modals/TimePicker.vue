<template>
    <div v-if="options && options.length > 0" class="d-flex position-relative">

        <scroll-picker
            :options="options"
            v-model="selections"
        />

        <span class="double-dot">:</span>
    </div>
</template>

<script>

import ScrollPicker from 'vue3-scroll-picker';
import { defineComponent, reactive, toRefs } from 'vue';
import {toString} from "lodash";

export default {
    props: ['reset_al_time'],
    data() {
        return {
            selections: [],
            state: null,
            exampleOptions: [],
            horus: '',
            minutes: '',
            options: '',
            do_reset: this.reset_al_time,
        }
    },
    watch: {
        reset_al_time(){
            if( this.reset_al_time === true ) {
                this.resetTime();
            }
        },
        selections() {
            this.$emit( 'timePickerIsChanged', true );
        }
    },
    components: {
        ScrollPicker,
    },
    computed: {
        currentHorus() {
            let date = new Date();
            let horus = toString( date.getHours() );
            let minutes = toString( date.getMinutes() );

            if( horus.length < 2 ) horus = "0"+ date.getHours();
            else horus = date.getHours();

            if( minutes.length < 2 ) minutes = "0"+ date.getMinutes();
            else minutes = date.getMinutes();

            console.log( 'HORUS = ', minutes )

            this.selections = [ horus, minutes ];

            this.options = [
                [ { "label": "00", "value": "00" } ],
                [ { "label": "00", "value": "00" } ]
            ]

            // HORUS
            for( let i=0; i <= 23; i++ ) {
                if( i < 10 ) {
                    this.options[0][i] = { "label": "0"+i, "value": "0"+i }
                }
                else {
                    this.options[0][i] = { "label": i, "value": i }
                }
            }

            // MINUTES
            for( let j=0; j <= 59; j++ ) {
                if (j < 10) {
                    this.options[1][j] = {"label": "0" + j, "value": j}
                } else {
                    this.options[1][j] = {"label": j, "value": j}
                }
            }
        },
    },
    methods: {
        resetTime() {
            let date = new Date();
            let horus = toString( date.getHours() );
            let minutes = toString( date.getMinutes() );

            if( horus.length < 2 ) horus = "0"+ date.getHours();
            else horus = date.getHours();

            if( minutes.length < 2 ) minutes = "0"+ date.getMinutes();
            else minutes = date.getMinutes();

            this.selections = [ "00", 0 ];

            // console.log('reset time - ')
        },
        hideOtherTimeSections() {
            let scrollPickerI = setInterval( () => {
                let scrollPicker = document.getElementsByClassName('scroll-picker-container');

                if( scrollPicker && scrollPicker.length ) clearInterval( scrollPickerI );

                if( scrollPicker && scrollPicker.length ) {
                    scrollPicker.forEach( (e) => {
                        if( e.style ) e.style = "height: 40px"
                    });
                }
            }, 1 );

            let centerOverlayI = setInterval( () => {
                let centerOverlay = document.getElementsByClassName('center-overlay');

                if( centerOverlay && centerOverlay.length ) {
                    centerOverlay.forEach( (e) => {
                        if( e.style && e.style.height === '52px' ) {
                            e.style = "height: 46px";
                            if( e.style.height !== '52px' ) clearInterval( centerOverlayI );
                        }
                    });
                }
            }, 1 );

            let centerOverlayCustomI = setInterval( () => {
                let centerOverlayCustom = document.getElementsByClassName('center-overlay-customs');

                if( centerOverlayCustom && centerOverlayCustom.length ) {
                    centerOverlayCustom.forEach( (e) => {
                        if( e.style ) {
                            e.style = "border: none";
                            if( e.style.border === 'none' ) clearInterval( centerOverlayCustomI );
                        }
                    });
                }
            }, 1 );

            let rowOptionCustomI = setInterval( () => {
                let rowOptionCustom = document.getElementsByClassName('row-option-custom');

                if( rowOptionCustom && rowOptionCustom.length ) clearInterval( rowOptionCustomI );

                if( rowOptionCustom && rowOptionCustom.length ) {
                    rowOptionCustom.forEach( (e) => {
                        if( e.style ) {
                            e.style = "background-color: rgb(85 83 83 / 69%); color: #fff; bold; padding: 5px 10px 5px 10px;";
                        }
                    });
                }
            }, 1 );

            let columnContentI = setInterval( () => {
                let columnContent = document.getElementsByClassName('column-content');

                if( columnContent && columnContent.length ) clearInterval( columnContentI );

                if( columnContent && columnContent.length ) {
                    columnContent.forEach( (e) => {
                        if( e.style ) {
                            e.style = "margin: 0 7px 0 0;";
                        }
                    });
                }
            }, 1 );

            setTimeout( () => {
                clearInterval( centerOverlayI )
            }, 5000 );

            setTimeout( () => {
                clearInterval( scrollPickerI )
            }, 5000 )

            setTimeout( () => {
                clearInterval( centerOverlayCustomI )
            }, 5000 );

            setTimeout( () => {
                clearInterval( rowOptionCustomI )
            }, 5000 );

            setTimeout( () => {
                clearInterval( columnContentI )
            }, 5000 );
        }
    },
    mounted() {
        this.currentHorus;
        this.hideOtherTimeSections();
    }
}

</script>

<style scoped>

    .double-dot {
        margin: 4px 0 0 42px;
        font-weight: bold;
        font-size: 20px;
        width: 7px;
        background-color: rgb(85 83 83 / 69%);
        height: 33px;
        color: #fff;
        position: absolute;
    }
    .row-option-custom {
        background-color: darkseagreen;
        padding: 5px 10px 5px 10px;
    }

</style>
