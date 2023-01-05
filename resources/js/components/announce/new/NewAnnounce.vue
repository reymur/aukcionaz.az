<template>
    <div class="col-12">
         <!-- ANNOUNCE NEW TOP ELEMENTS-->
        <announce-new-top-elements></announce-new-top-elements>

        <!-- NEW ANNOUNCE ADD CATEGORIES -->
        <div class="bg-white w-100 mt-0 mb-3 p-0">
            <modal-category
                :categories="categories"
                @sendSubCategoryNameToNewAnnounceComponent="callSubCategoryComponent"
            ></modal-category>
        </div>
            
        <!-- ANNOUNCE NEW COMPONENT  COLLAPSE-->
        <div class="mb-3">
            <div class="collapse announce__new_collapse border-0" id="announce-new-collapse">
                <div class="card card-body border-0">
                    <component :is="loadComponent"></component>
                </div>
            </div>
        </div>

        <!-- NEW ANNOUNCE ADD INPUTS-->
        <div class="cbg-white w-100 mt-1 mb-2 p-0">
            <!-- <div class="border-0 ">
                @include('announce.modals.modal_price')
            </div> -->

            <!-- <div class="ms-3 border-bottom border-secondary border-opacity-10"></div> -->

            <!-- <div class="">
                @include('announce.modals.modal_city')
            </div>

            <div class="mt-3">
                @include('announce.modals.modal_about')
            </div> -->
            
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
    props: ['categories'],
    data() {
        return {
            loadComponentData: ''
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

                    return defineAsyncComponent( () => 
                            import(`../new/forms/category/${category_name}/${folder_name}/${sub_category_name}`)
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
            let category_modal_id = document.getElementById('announce-new-category');
            category_modal_id.classList.remove('show');
            new bootstrap.Offcanvas(category_modal_id, {
                toggle: false
            });
            this.removeBackDrops('offcanvas-backdrop');
            // console.log( 'XXXXXX = ', offcanvas )
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
    
}
</script>

<style>

</style>