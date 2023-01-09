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

                    <span class="text-dark fs-5">{{ city_name }}</span>
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
                    <ul  class="list-group">
                        <div class="">
                            <li
                                v-for="city in cities"
                                :key="city.id"
                                v-on:click="getCityName"
                                :id="city.name"
                                role="button"
                                class="list-group-item fs-5 py-2 pointer-event all_catalog_category_items_style"
                                data-bs-dismiss="offcanvas" aria-label="Close"
                            >
                                {{ city.name }}
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
                this.custom__padding = 'py-2 pt-3'
                this.custom__margin = 'mb-2'
            }
        }
    },
    methods: {
        getCityName(event) {
            if( event.target.id !== undefined ) {
                this.city_name = '';
                this.font_size = 'fs-5';
                setTimeout(() => {
                    this.city_name = event.target.id;
                    this.font_size = 'fs-6';
                }, 400);

                this.$emit('sendCityNameToNewAnnounceComponent', {
                    city: event.target.id
                });
            }
            console.log('City - ', event.target.id )
        }
    }
}
</script>

<style>

</style>
