<!--<template>-->
<!--    <div class="col-12">-->
<!--         &lt;!&ndash; ANNOUNCE NEW TOP ELEMENTS&ndash;&gt;-->
<!--        <announce-new-top-elements></announce-new-top-elements>-->

<!--        &lt;!&ndash; NEW ANNOUNCE ADD CATEGORIES &ndash;&gt;-->
<!--        <div class="bg-white w-100 mt-0 mb-2 p-0">-->
<!--            <modal-category-->
<!--                :categories="categories"-->
<!--                @sendSubCategoryInfoToNewAnnounceComponent="callSubCategoryComponent"-->
<!--            ></modal-category>-->
<!--        </div>-->

<!--        &lt;!&ndash; ANNOUNCE NEW LOAD  COMPONENT  COLLAPSE&ndash;&gt;-->
<!--        <div class="border__color shadow-sm mb-2" :style="load_component_border">-->
<!--            <div class="collapse announce__new_collapse border-0" id="announce-new-collapse">-->
<!--                <div class="border-0">-->
<!--                    <component-->
<!--                        :is="loadComponent"-->
<!--                        :sub_category_id="sub_category_id"-->
<!--                        @sendSubCategoryTypeNameToNewAnnounceComponent="getSubCategoryTypeNameFromAudioVeVideoComponent"-->
<!--                        @sendAnnounceTitleToNewAnnounceComponent="getAnnounceTitleFromAudioVeVideoComponent"-->
<!--                        @sendCheckBoxVarsToNewAnnounceComponent="getCheckBoxVarsFromAudioVeVideoComponent"-->
<!--                    ></component>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; NEW ANNOUNCE ADD INPUTS&ndash;&gt;-->
<!--        <div class="cbg-white w-100 mb-2 p-0 custom__border">-->
<!--            &lt;!&ndash; ANNOUNCE NEW NEW PRICE &ndash;&gt;-->
<!--            <div class="border-0 ">-->
<!--                <announce-new-modal-price-->
<!--                    @sendPriceToNewAnnounceComponent="getPriceFromAnnounceNewPriceComponent"-->
<!--                ></announce-new-modal-price>-->
<!--            </div>-->

<!--            <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>-->

<!--            &lt;!&ndash; ANNOUNCE NEW NEW CITY &ndash;&gt;-->
<!--            <div class="">-->
<!--                <announce-new-modal-city-->
<!--                    :cities="cities"-->
<!--                    @sendCityNameToNewAnnounceComponent="getCityNameFromAnnounceNewModalCity"-->
<!--                ></announce-new-modal-city>-->
<!--            </div>-->

<!--            &lt;!&ndash; ANNOUNCE NEW NEW ABOUT &ndash;&gt;-->
<!--            <div class="mt-3">-->
<!--                <announce-new-modal-about-->
<!--                    @sendAboutToNewAnnounceComponent="getAboutFromAnnounceNewModalAbout"-->
<!--                ></announce-new-modal-about>-->
<!--            </div>-->

<!--            &lt;!&ndash; ANNOUNCE NEW USER INFO &ndash;&gt;-->
<!--            <div class="mt-2">-->
<!--                <new-announce-user-info-->
<!--                    @sendUserNameToNewAnnounceComponent="getUserNameFromNewAnnounceUserInfoComponent"-->
<!--                    @sendUserEmailToNewAnnounceComponent="getUserEmailFromNewAnnounceUserInfoComponent"-->
<!--                    @sendUserPhoneNumberToNewAnnounceComponent="getUserPhoneNumberFromNewAnnounceUserInfoComponent"-->
<!--                ></new-announce-user-info>-->
<!--            </div>-->

<!--            &lt;!&ndash; SEND BUTTON &ndash;&gt;-->
<!--            <div class="p-3 mb-4 border-bottom-danger">-->
<!--                <button-->
<!--                    @click="createNewAnnounce"-->
<!--                    type="button" class="btn btn-success aukcionaz__main-color w-100"-->
<!--                >-->
<!--                    <p class="fs-5 p-2 m-auto text-white">Davam et</p>-->
<!--                </button>-->

<!--                <div class="p-3 text-secondary text-opacity-50">-->
<!--                    <p class="">Elan yrlərşdirərkən siz "Aukcionaz.az" saytının-->
<!--                        <a href="" class="text-secondary text-opacity-75">müşəri razılaşmasıyla</a>-->
<!--                        avtomatik razılaşırsınız.-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--import { defineComponent, defineAsyncComponent } from "vue";-->
<!--import * as bootstrap from 'bootstrap';-->

<!--export default {-->
<!--    props: ['categories','cities'],-->
<!--    data() {-->
<!--        return {-->
<!--            loadComponentData: '',-->
<!--            load_component_border: '',-->
<!--            sub_category_id: null,-->
<!--            sub_category_type_name: null,-->
<!--            checkBoxElems: [],-->
<!--            city_name: null,-->
<!--            price: null,-->
<!--            about: null,-->
<!--            name: null,-->
<!--            email: null,-->
<!--            phone: null,-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        loadComponent(){-->
<!--            if( this.loadComponentData !== undefined && this.loadComponentData.new_data !== undefined ) {-->
<!--                if( this.loadComponentData.new_data.category_name !== undefined && this.loadComponentData.new_data.sub_category_name !== undefined ) {-->
<!--                    let sub_category_modal_id = this.loadComponentData.new_data.category_name;-->
<!--                    let category_name = this.loadComponentData.new_data.category_name.toLowerCase();-->
<!--                    let folder_name   = this.loadComponentData.new_data.sub_category_name.toLowerCase();-->
<!--                    let sub_category_name = this.loadComponentData.new_data.sub_category_name;-->

<!--                    this.closeBeforeVisibleModals(sub_category_modal_id);-->
<!--                    this.openAnnounceNewCollapse('announce-new-collapse');-->
<!--                    this.sub_category_id = this.loadComponentData.new_data.sub_category_id;-->
<!--                    this.load_component_border = 'border:1px solid rgb(0 0 0 / 6%)';-->
<!--                    // console.log( 'XXXXXX = ',  this.loadComponentData.new_data.sub_category_id )-->

<!--                    return defineAsyncComponent( () =>-->
<!--                            import(`../new/category/${category_name}/${folder_name}/${sub_category_name}`)-->
<!--                        )-->
<!--                }-->
<!--            }-->
<!--        }-->
<!--    },-->
<!--    methods: {-->
<!--        callSubCategoryComponent(data){-->
<!--            this.loadComponentData = data;-->
<!--            // console.log('AAAAAA = ', this.loadComponentData.new_data.category_name)-->
<!--            // console.log('BBBBBB = ', this.loadComponentData.new_data.original_sub_category_name)-->
<!--        },-->
<!--        getSubCategoryTypeNameFromAudioVeVideoComponent(data){-->
<!--            if( data !== undefined && data.name !== undefined ) {-->
<!--                this.sub_category_type_name = data.name;-->
<!--            }-->
<!--        },-->
<!--        getCheckBoxVarsFromAudioVeVideoComponent(data){-->
<!--            if( data !== undefined && data.checkBox !== undefined ) {-->
<!--                this.checkBoxElems = data.checkBox;-->
<!--                // console.log('MMMMMM = ', data.checkBox )-->
<!--            }-->
<!--        },-->
<!--        getAnnounceTitleFromAudioVeVideoComponent(data) {-->
<!--            if( data !== undefined && data.announce_title !== undefined ) {-->
<!--                this.announce_title = data.announce_title;-->
<!--            }-->
<!--        },-->
<!--        getCityNameFromAnnounceNewModalCity(data){-->
<!--            if( data !== undefined && data.city !== undefined ) {-->
<!--                this.city_name = data.city;-->
<!--                // console.log('MMMMMM = ', data.checkBox )-->
<!--            }-->
<!--        },-->
<!--        getPriceFromAnnounceNewPriceComponent(data){-->
<!--            if( data !== undefined && data.price !== undefined ) {-->
<!--                this.price = data.price;-->
<!--                // console.log('MMMMMM = ', data.price )-->
<!--            }-->
<!--        },-->
<!--        getAboutFromAnnounceNewModalAbout(data) {-->
<!--            if( data !== undefined && data.about !== undefined ) {-->
<!--                this.about = data.about;-->
<!--            }-->
<!--        },-->
<!--        getUserNameFromNewAnnounceUserInfoComponent(data) {-->
<!--            if( data !== undefined && data.name !== undefined ) {-->
<!--                this.name = data.name;-->
<!--            }-->
<!--        },-->
<!--        getUserEmailFromNewAnnounceUserInfoComponent(data) {-->
<!--            if( data !== undefined && data.email !== undefined ) {-->
<!--                this.email = data.email;-->
<!--            }-->
<!--        },-->
<!--        getUserPhoneNumberFromNewAnnounceUserInfoComponent(data) {-->
<!--            if( data !== undefined && data.phone !== undefined ) {-->
<!--                this.phone = data.phone;-->
<!--            }-->
<!--        },-->
<!--        createNewAnnounce(){-->
<!--            console.log('Create res = ', this.checkBoxElems[0] )-->
<!--            axios({-->
<!--                method: "POST",-->
<!--                url: '/announce/new/create',-->
<!--                data: {-->
<!--                    data: {-->
<!--                        category: this.if_isset_category_name( this.loadComponentData ) ,-->
<!--                        sub_category: this.if_isset_original_sub_category_name( this.loadComponentData ),-->
<!--                        sub_category_type: this.if_isset( this.sub_category_type_name ),-->
<!--                        checkBoxElems: this.if_isset( this.checkBoxElems ),-->
<!--                        city: this.if_isset( this.city_name ),-->
<!--                        price: this.if_isset( this.price ),-->
<!--                        about: this.if_isset( this.about ),-->
<!--                        announce_title: this.if_isset( this.announce_title ),-->
<!--                        name: this.if_isset( this.name ),-->
<!--                        email: this.if_isset( this.email ),-->
<!--                        phone: this.if_isset( this.phone ),-->
<!--                    }-->
<!--                }-->
<!--            }).then( res => {-->
<!--                console.log('Create res = ', res.data )-->
<!--            }).catch( err => {-->
<!--                console.log('Create Error = ', err )-->
<!--            })-->
<!--        },-->
<!--        if_isset_category_name(data){-->
<!--            if( data !== undefined && data.new_data !== undefined ) {-->
<!--                if( data.new_data.category_name !== undefined ){-->
<!--                    return data.new_data.category_name-->
<!--                } else return false;-->
<!--            } else return false;-->
<!--        },-->
<!--        if_isset_original_sub_category_name(data){-->
<!--            if( data !== undefined && data.new_data !== undefined ) {-->
<!--                if( data.new_data.original_sub_category_name !== undefined ){-->
<!--                    return data.new_data.original_sub_category_name-->
<!--                } else return false;-->
<!--            } else return false;-->
<!--        },-->
<!--        if_isset( el ) {-->
<!--            if( el !== undefined && el !== null )-->
<!--                return el;-->
<!--            return false;-->
<!--        },-->
<!--        closeBeforeVisibleModals(sub_category_id){-->
<!--            this.closeCategoryModal('announce-new-category');-->
<!--            // this.closeSubCategoryModal(sub_category_id);-->
<!--        },-->
<!--        openAnnounceNewCollapse(id){-->
<!--            let collapse_id = document.getElementById(id);-->
<!--            if( collapse_id !== undefined  ) {-->
<!--                this.closeAnnounceNewCollapse('announce__new_collapse');-->
<!--                setTimeout(() => {-->
<!--                    new bootstrap.Collapse(collapse_id, {-->
<!--                        toggle: true-->
<!--                    });-->
<!--                }, 400);-->
<!--            }-->
<!--        },-->
<!--        closeAnnounceNewCollapse(collapse_class_name){-->
<!--            if( collapse_class_name !== undefined ) {-->
<!--                let collapse_class = document.getElementsByClassName(collapse_class_name);-->
<!--                if( collapse_class !== undefined && collapse_class[0] !== undefined ) {-->
<!--                    if( collapse_class[0].classList !== undefined ) {-->
<!--                        if( collapse_class[0].classList.contains('show') ) {-->
<!--                            collapse_class[0].classList.remove('show')-->
<!--                        }-->
<!--                    }-->
<!--                }-->
<!--            }-->
<!--        },-->
<!--        closeCategoryModal(id){-->
<!--            let body_style = document.querySelector('body');-->
<!--            let category_modal_id = document.getElementById('announce-new-category');-->
<!--            category_modal_id.classList.remove('show');-->
<!--            new bootstrap.Offcanvas(category_modal_id, {-->
<!--                toggle: false-->
<!--            });-->
<!--            this.removeBackDrops('offcanvas-backdrop');-->

<!--            setTimeout( () => {-->
<!--                body_style.removeAttribute("style")-->
<!--            },400);-->
<!--        },-->
<!--        removeBackDrops(backdrop_name){-->
<!--            let backdrops = document.getElementsByClassName(backdrop_name);-->
<!--            if( backdrops !== undefined && backdrops.length > 0 ) {-->
<!--                for(var i=0; i < backdrops.length; i++){-->
<!--                    if( backdrops[i] !== undefined ){-->
<!--                        backdrops[i].style.display = 'none'-->
<!--                    }-->
<!--                }-->
<!--            }-->
<!--        },-->
<!--    },-->
<!--    mounted() {-->
<!--        // console.log('AAAAAA = ', this.loadComponentData.data.sub_category_name)-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->
<!--    .custom__border {-->
<!--        border: 1px solid rgb(240 240 240);-->
<!--    }-->
<!--</style>-->
