<template>
   <div class="">
        <!-- ANNOUNCE NEW NEW CITY -->
        <ul class="list-group" data-bs-toggle="offcanvas" data-bs-target="#city" aria-controls="offcanvasRight">
            <li :class="'list-group-item shadow-sm col-12= d-flex border-0 '+custom__padding+' ps-3'">
                <div class="me-4 m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                </div>

                <div class="col text-black-50 lh-1">
                    <div class="">
                        <label :class="font_size+' '+custom__margin" for="floatingSelect">Şəhər</label>
                        <span class="text-danger text-opacity-75 ps-1">*</span>
                    </div>

                    <span v-if="city_name" class="text-dark fs-5">{{ city_name }}</span>
                </div>

                <div class="text-end m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" fill="gray" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            </li>
        </ul>

        <!-- offcanvas -->
        <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="city" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border border-bottom-1">
                <div class="">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" type="button" data-bs-dismiss="offcanvas" aria-label="Close" width="22" height="22" fill="currentColor" class="bi bi-chevron-left text-black-50" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </h5>
                </div>
                <div class="">
                    <h5 class="m-0">Şəhər və rayonlar</h5>
                </div>
                <div class=""></div>
            </div>
            <div class="offcanvas-body">
                <div class="">
                    <ul v-if="cities" class="list-group">
                        <div class="">
                            <li
                                v-for="city in cities"
                                :key="city.id"
                                v-on:click="getCityName"
                                :id="city.city"
                                role="button"
                                class="col list-group-item d-flex pointer-event
                                        justify-content-between fs-5 py-2 pointer-event
                                        all_catalog_category_items_style city__name_li"
                                data-bs-dismiss="offcanvas" aria-label="Close"
                                @click="changeColorToGreenOnClickLi"
                            >
                                {{ city.city }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="select_icon align-self-center bi bi-check2" viewBox="0 0 16 16">
                                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
export default {
    props: ['cities'],
    data() {
        return {
            city_name: '',
            font_size: 'fs-5',
            custom__padding: 'py-3',
            custom__margin: '',
        }
    },
    watch: {
        city_name(){
            if( this.city_name === '' ){
                this.custom__padding = 'py-3'
                this.custom__margin = ''
            } else {
                this.custom__padding = 'py-2'
                this.custom__margin = 'mb-2'
            }
        }
    },
    methods: {
        getCityName(event) {
            if( event.target.innerText !== undefined ) {
                let name = '';
                this.city_name = '';
                name = event.target.innerText;
                this.font_size = 'fs-5';
                setTimeout(() => {
                    this.city_name = name;
                    this.font_size = 'fs-6';
                    console.log('City - ', this.city_name )
                }, 400);

                this.$emit('sendCityNameToNewAnnounceComponent', {
                    city: event.target.id
                });
            }
        },
        changeColorToGreenOnClickLi(event){
            if( event !== undefined && event.target !== undefined ) {
                if( event.target.tagName !== undefined && event.target.tagName === 'LI' ) {
                    this.deleteGreenColorTextOnLi();

                    if( event.target !== undefined && event.target.childNodes !== undefined ) {
                        if( event.target.childNodes[1] !== undefined && event.target.childNodes[1].classList !== undefined ) {
                            if( event.target.childNodes[1].classList.contains('green_color') !== true ) {
                                event.target.childNodes[1].classList.add('green_color');
                                event.target.childNodes[1].classList.add('d-block');
                            }
                        }
                    }
                    if( event.target !== undefined && event.target.classList !== undefined) {
                        if( event.target.classList.contains('green_color') !== true ) {
                            event.target.classList.add('green_color')
                        }
                    }
                }
            }
        },
        deleteGreenColorTextOnLi() {
            let el = document.getElementsByClassName('city__name_li');
            if( el !== undefined && el.length !== undefined ) {
                for( let i=0; i < el.length; i++ ) {
                    if( el[i].classList !== undefined && el[i].classList.contains('green_color') ){
                        el[i].classList.remove('green_color');

                        // IF LI CLHILD ICON IS GREEN TO REMOVE GREEN COLOR
                        if( el[i].children !== undefined &&  el[i].children[0] !== undefined ) {
                            if( el[i].children[0].classList !== undefined ) {
                                if( el[i].children[0].classList.contains('green_color') ) {
                                    el[i].children[0].classList.remove('green_color')
                                }
                                if( el[i].children[0].classList.contains('d-block') ) {
                                    el[i].children[0].classList.remove('d-block')
                                }
                            }
                        }
                        console.log('lastChild = ', el[i].children[0].classList )
                    }
                }
            }
        }
    }
}
</script>

<style scoped>
    .select_icon {
        display: none;
    }

    .green_color {
        color: #179604;
    }
</style>
