<template>
    <div class="" id="new-announce-category">
        <!-- Button trigger modal -->
        <ul class="list-group" data-bs-toggle="offcanvas" data-bs-target="#sub-category-type" aria-controls="offcanvasRight">
            <li class="list-group-item col-12 d-flex border-0">
                <div class="col">
                    <div v-if="sub_category_name !== null" class="col lh-1 align-self-center py-2" role="button">
                        <div :class="'col text-black-50 mb-1 align-self-center '+font_size+ 'py-2'" role="button">
                            Malın tipi
                            <span class="text-danger text-opacity-75">*</span>
                        </div>
                        <div class="fs-5">{{ sub_category_name }}</div>
                    </div>
                    <div v-else class="col text-black-50 align-self-center py-2 fs-5" role="button">
                        Malın tipi
                        <span class="text-danger text-opacity-75">*</span>
                    </div>
                </div>

                <div class="d-flex align-self-center text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="gray" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            </li>
        </ul>
    
        <!-- offcanvas -->
        <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="sub-category-type" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header shadow-sm mb-1"> 
                <div class="col">
                    <h5 class="offcanvas-title m-auto" id="offcanvasRightLabel"> 
                        <svg xmlns="http://www.w3.org/2000/svg" type="button" data-bs-dismiss="offcanvas" aria-label="Close" width="22" height="22" fill="currentColor" class="bi bi-chevron-left text-black-50" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </h5>
                </div>
                <div class="col fs-5 d-flex justify-content-center">Kataloq</div>
                <div class="col"></div>
            </div>

            <div class="offcanvas-body p-0">
                <div class="">
                    <ul v-if="sub_category_types !== null" class="list-group">
                        <li v-for="item in sub_category_types"
                            :key="item.id"
                            role="button"
                            class="col d-flex list-group-item fs-5 py-2 pt-3 pointer-event justify-content-between all_catalog_category_items_style sub_category_type_li" 
                            data-bs-dismiss="offcanvas" aria-label="Close"
                            @click="changeSubCategoryTypeName"
                        >
                            {{ item.name }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="select_icon bi bi-check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['sub_category_id'],
    data() {
        return {
            id: null,
            sub_category_name: null,
            sub_category_types: null,
            font_size: ''
        }
    },
    methods:{
        getSubCategoryTypes(){
            if( this.sub_category_id !== undefined ) {
                this.id = this.sub_category_id;

                axios({
                    method: "POST",
                    url: '/announce/new/get_sub_category_types',
                    data: { id: this.id }
                }).then( res => {
                    if( res.data !== undefined && res.data.sub_category_types !== undefined ) {
                        this.sub_category_types = res.data.sub_category_types;
                    }
                    console.log('RES = ', res.data.sub_category_types )
                }).catch( err => {
                    console.log('ERR = ', err )
                });
            }
        },
        changeSubCategoryTypeName(event) {
            if( event !== undefined && event.target.innerText !== undefined ) {
                this.sub_category_name = event.target.innerText;
                this.font_size = 'fs-6';
            }
            this.changeColorToGreenOnClickLi(event);
        },
        changeColorToGreenOnClickLi(event){
            if( event !== undefined && event.target !== undefined ) {
                if( event.target.tagName !== undefined && event.target.tagName == 'LI' ) {
                    this.deleteGreenColorTextOnLi();

                    if( event.target !== undefined && event.target.childNodes !== undefined ) {
                        if( event.target.childNodes[1] !== undefined && event.target.childNodes[1].classList !== undefined ) {
                            if( event.target.childNodes[1].classList.contains('green_color') != true ) {
                                event.target.childNodes[1].classList.add('green_color');
                                event.target.childNodes[1].classList.add('d-block');
                            }
                        }
                    }
                    if( event.target !== undefined && event.target.classList !== undefined) {
                        if( event.target.classList.contains('green_color') != true ) {
                            event.target.classList.add('green_color') 
                        }
                    }
                }
            }
            console.log('lastChild = ', event.target.tagName )
        },
        deleteGreenColorTextOnLi() {
            let el = document.getElementsByClassName('sub_category_type_li');
            if( el !== undefined && el.length !== undefined ) {
                for( var i=0; i < el.length; i++ ) {
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
    },
    mounted() {
        this.getSubCategoryTypes();
        // console.log( 'XXXXXX = ',  this.id )
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