<template>
    <div class="col-12">
         <!-- ANNOUNCE NEW TOP ELEMENTS-->
        <announce-new-top-elements></announce-new-top-elements>

        <!-- NEW ANNOUNCE ADD CATEGORIES -->
        <div class="bg-white w-100 mt-0 mb-3 p-0">
            <modal-category
                :categories="categories"
                @sendSubCategoryInfoToNewAnnounceComponent="callSubCategoryComponent"
            ></modal-category>
        </div>
            
        <!-- ANNOUNCE NEW LOAD  COMPONENT  COLLAPSE-->
        <div class="border__color" :style="load_component_border">
            <div class="collapse announce__new_collapse border-0" id="announce-new-collapse">
                <div class="border-0">
                    <component 
                        :is="loadComponent"
                        :sub_category_id="sub_category_id"
                    ></component>
                </div>
            </div>
        </div>

        <div class="py-1" style="background-color:rgb(15 48 126 / 3%)"></div>

        <!-- NEW ANNOUNCE ADD INPUTS-->
        <div class="cbg-white w-100 mt-1 mb-2 p-0">
            <!-- ANNOUNCE NEW NEW PRICE -->
            <div class="border-0 ">
                <announce-new-modal-price></announce-new-modal-price>
            </div>

            <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>

            <!-- ANNOUNCE NEW NEW CITY -->
            <div class="">
                <announce-new-modal-city :cities="cities"></announce-new-modal-city>
            </div>

            <!-- ANNOUNCE NEW NEW ABOUT -->
            <div class="mt-3">
                <announce-new-modal-about></announce-new-modal-about>
            </div>
            
            <div class="mt-3">
                <input-phone-number></input-phone-number>
            </div>

            <div class="p-3 mb-4 border-bottom-danger">
                <button type="button" class="btn btn-success aukcionaz__main-color w-100">
                    <p class="fs-5 p-2 m-auto text-white">Davam et</p>
                </button>

                <div class="p-3 text-secondary text-opacity-50">
                    <p class="">Elan yrlərşdirərkən siz "Aukcionaz.az" saytının 
                        <a href="" class="text-secondary text-opacity-75">müşəri razılaşmasıyla</a>  
                        avtomatik razılaşırsınız.
                    </p>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { defineComponent, defineAsyncComponent } from "vue";
import * as bootstrap from 'bootstrap';

export default {
    props: ['categories','cities'],
    data() {
        return {
            loadComponentData: '',
            load_component_border: '',
            sub_category_id: null
        }
    },
    computed: {
        loadComponent(){   
            if( this.loadComponentData !== undefined && this.loadComponentData.new_data !== undefined ) {
                if( this.loadComponentData.new_data.category_name !== undefined && this.loadComponentData.new_data.sub_category_name !== undefined ) {
                    let sub_category_modal_id = this.loadComponentData.new_data.category_name;
                    let category_name = this.loadComponentData.new_data.category_name.toLowerCase();
                    let folder_name   = this.loadComponentData.new_data.sub_category_name.toLowerCase();
                    let sub_category_name = this.loadComponentData.new_data.sub_category_name;

                    this.closeBeforeVisibleModals(sub_category_modal_id);
                    this.openAnnounceNewCollapse('announce-new-collapse');
                    this.sub_category_id = this.loadComponentData.new_data.sub_category_id;
                    this.load_component_border = 'border:1px solid rgb(0 0 0 / 6%)';
                    // console.log( 'XXXXXX = ',  this.loadComponentData.new_data.sub_category_id )

                    return defineAsyncComponent( () => 
                            import(`../new/category/${category_name}/${folder_name}/${sub_category_name}`)
                        )
                }
            }
        }
    },
    methods: {
        callSubCategoryComponent(data){
            this.loadComponentData = data;
        },
        closeBeforeVisibleModals(sub_category_id){
            this.closeCategoryModal('announce-new-category');
            // this.closeSubCategoryModal(sub_category_id);
        },
        openAnnounceNewCollapse(id){
            let collapse_id = document.getElementById(id);
            if( collapse_id !== undefined  ) {
                this.closeAnnounceNewCollapse('announce__new_collapse');
                setTimeout(() => {
                    new bootstrap.Collapse(collapse_id, {
                        toggle: true
                    });
                }, 400);
            }
        },
        closeAnnounceNewCollapse(collapse_class_name){
            if( collapse_class_name !== undefined ) {
                let collapse_class = document.getElementsByClassName(collapse_class_name);
                if( collapse_class !== undefined && collapse_class[0] !== undefined ) {
                    if( collapse_class[0].classList !== undefined ) {
                        if( collapse_class[0].classList.contains('show') ) {
                            collapse_class[0].classList.remove('show')
                        }
                    }
                }
            }
        },
        closeCategoryModal(id){
            let body_style = document.querySelector('body');
            let category_modal_id = document.getElementById('announce-new-category');
            category_modal_id.classList.remove('show');
            new bootstrap.Offcanvas(category_modal_id, {
                toggle: false
            });
            this.removeBackDrops('offcanvas-backdrop');
            
            setTimeout( () => {
                body_style.removeAttribute("style")
            },400);
            // console.log( 'XXXXXX = ', body_style.style.overflow = 'auto' )
        },
        // closeSubCategoryModal(id) {
        //     if( id !== undefined ) {
        //         let new_id = document.getElementById('id-'+id);
        //         let modal = new bootstrap.Modal(new_id, {
        //             toggle: false,
        //             ariaHidden: 'true'
        //         });
        //         new_id.classList.remove("show");
        //         setTimeout( () => {
        //             new_id.style.display = 'none';
        //         },120);
        //         this.removeBackDrops('modal-backdrop')
        //     }
        // },
        removeBackDrops(backdrop_name){
            let backdrops = document.getElementsByClassName(backdrop_name);
            if( backdrops !== undefined && backdrops.length > 0 ) {
                for(var i=0; i < backdrops.length; i++){
                    if( backdrops[i] !== undefined ){
                        backdrops[i].style.display = 'none'
                    }
                }
            }
        },
    },
    mounted() {
        
    }
}
</script>

<style>

</style>