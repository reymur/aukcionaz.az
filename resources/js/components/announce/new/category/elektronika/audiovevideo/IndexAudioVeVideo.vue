<template>
    <div class="">
        <div class="col-12">
            <!-- ANNOUNCE NEW TOP ELEMENTS-->
            <announce-new-top-elements></announce-new-top-elements>

            <!-- NEW ANNOUNCE ADD CATEGORIES -->
            <div v-if="categories" class="bg-white w-100 mt-0 mb-2 p-0">
                <modal-category
                    :categories="categories"
                    @sendSubCategoryTypeNameToIndexAudioVeVideoComponent="callSubCategoryComponent"
                ></modal-category>
            </div>

            <!-- ANNOUNCE NEW LOAD  COMPONENT  COLLAPSE-->
            <div v-if="sub_category_id" class="border__color shadow-sm mb-2" :style="load_component_border">
                <div class="collapse announce__new_collapse border-0" id="announce-new-collapse">
                    <div class="border-0">
                        <audio-ve-video
                            :sub_category_id="sub_category_id"
                            @sendSubCategoryTypeNameToIndexAudioVeVideoComponent="getSubCategoryTypeNameFromAudioVeVideoComponent"
                            @sendAnnounceTitleToNewAnnounceComponent="getAnnounceTitleFromAudioVeVideoComponent"
                            @sendCheckBoxVarsToNewAnnounceComponent="getCheckBoxVarsFromAudioVeVideoComponent"
                        ></audio-ve-video>
                    </div>
                </div>
            </div>

            <!-- NEW ANNOUNCE ADD INPUTS-->
            <div class="cbg-white w-100 mb-2 p-0 custom__border">
                <!-- ANNOUNCE NEW NEW PRICE -->
                <div class="border-0 ">
                    <announce-new-modal-price
                        @sendPriceToNewAnnounceComponent="getPriceFromAnnounceNewPriceComponent"
                    ></announce-new-modal-price>
                </div>

                <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>

                <!-- ANNOUNCE NEW NEW CITY -->
                <div v-if="cities" class="">
                    <announce-new-modal-city
                        :cities="cities"
                        @sendCityNameToNewAnnounceComponent="getCityNameFromAnnounceNewModalCity"
                    ></announce-new-modal-city>
                </div>

                <!-- ANNOUNCE NEW NEW ABOUT -->
                <div class="mt-3">
                    <announce-new-modal-about
                        @sendAboutToNewAnnounceComponent="getAboutFromAnnounceNewModalAbout"
                    ></announce-new-modal-about>
                </div>

                <!-- IMAGE UPLOADER -->
                <div class="mt-4 pb-2 shadow-sm">
                    <div class="input-group control-group mb-3">
                        <label for="formFileLg" class="form-control form-control-lg d-flex mx-3 align-self-center border-0 rounded-0 lh-lg w-100 justify-content-center custom__bg_image_uploade" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-camera-fill color__custom_photo_camera" viewBox="0 0 16 16">
                                <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                            </svg>
                            <span class="ms-2 fs-5 custom__image_uploade_text">Şəkil</span>
                        </label>

                        <input type="file" @change="getImages" multiple tabindex="-1" class="form-control opacity-0 border-0 bg-info rounded-0 position-absolute w-50" id="formFileLg">
                    </div>

                    <!-- APPEND UPLOAD IMAGES -->
                    <div class="col overflow-hidden" id="image__show_div"></div>
                </div>

                <!-- ANNOUNCE NEW USER INFO -->
                <div class="mt-2 announce__user_info_styles">
                    <new-announce-user-info
                        @sendUserNameToNewAnnounceComponent="getUserNameFromNewAnnounceUserInfoComponent"
                        @sendUserEmailToNewAnnounceComponent="getUserEmailFromNewAnnounceUserInfoComponent"
                        @sendUserPhoneNumberToNewAnnounceComponent="getUserPhoneNumberFromNewAnnounceUserInfoComponent"
                    ></new-announce-user-info>
                </div>

                <!-- SEND BUTTON -->
                <div class="p-3 mb-4 border-bottom-danger">
                    <button
                        @click="createNewAnnounce"
                        type="button" class="btn btn-success aukcionaz__main-color w-100"
                    >
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
    </div>
</template>

<script>
import * as bootstrap from 'bootstrap';
import { defineComponent, defineAsyncComponent } from "vue";

export default {
    props: ['categories','cities'],
    data() {
        return {
            images: [],
            loadComponentData: '',
            load_component_border: '',
            sub_category_id: null,
            sub_category_type_name: null,
            checkBoxElems: [],
            city_name: null,
            price: null,
            about: null,
            name: null,
            email: null,
            phone: null,
            errors: [],
        }
    },
    components: {

    },
    watch: {
        loadComponentData() {
            this.sub_category_id = this.loadComponentData.new_data.sub_category_id;
        },
        sub_category_id(){
            this.loadComponent();
        }
    },
    computed: {

    },
    methods: {
        getImages( file ){
            if( file && file.target && file.target.files ) {
                if( file.target.files.length && file.target.files.length > 0 ) {
                    for ( let i=0; i < file.target.files.length; i++ ) {
                        if( file.target.files[i] ) {
                            let image_show_div = document.getElementById('image__show_div');

                            if( image_show_div !== undefined && image_show_div !== null ) {
                                let new_img_div = document.createElement('div');
                                let new_img = document.createElement('img');
                                let upload_image_src = URL.createObjectURL( file.target.files[i] );

                                if( new_img_div && new_img && upload_image_src ) {
                                    new_img_div.classList.add('m-auto');
                                    new_img_div.classList.add('p-2');
                                    new_img_div.classList.add('col-sm-10');
                                    new_img_div.classList.add('col-md-6');
                                    new_img_div.classList.add('col-lg-3');
                                    new_img_div.classList.add('col-xl-2');
                                    new_img_div.classList.add('col-xxl-2');
                                    new_img_div.classList.add('float-md-start');
                                    new_img_div.classList.add('float-lg-start');
                                    new_img_div.classList.add('float-xl-start');
                                    new_img_div.classList.add('float-xxl-start');

                                    let ifIssetNewImageDiv = setInterval( () => {
                                        if( new_img_div.offsetWidth > 0 ) {
                                            new_img_div.style.height = ( (Number(new_img_div.offsetWidth) / 4) * 3)+'px';
                                            console.log('WIDTH = ', new_img_div.offsetHeight )

                                            clearInterval(ifIssetNewImageDiv);
                                        }
                                    }, 10)

                                    new_img.src = upload_image_src;
                                    new_img.id = file.target.files[i].name;
                                    new_img.classList.add('w-100');
                                    new_img.classList.add('h-100');
                                    new_img.style = 'box-shadow: 1px 1px 5px 1px #00000033;';

                                    new_img_div.appendChild(new_img);

                                    image_show_div.classList.add('image__show_div_styles');
                                    image_show_div.appendChild(new_img_div);
                                }
                            }
                        }
                    }
                }
            }

            console.log('IMAGE --- ',  file.target.files[0] )
        },
        callSubCategoryComponent(data){
            this.loadComponentData = data;
            this.loadComponent();

            this.$emit('callComponentInNewAnnounce',{
                sub_category_id: this.loadComponentData.new_data.sub_category_id,
                category_name: this.loadComponentData.new_data.category_name.toLowerCase(),
                load_component_name: this.loadComponentData.new_data.sub_category_name,
                load_component_folder: this.loadComponentData.new_data.sub_category_name.toLowerCase()
            } );
        },
        createNewAnnounce(){
            this.errors = [];
            console.log('Create res = ', this.checkBoxElems[0] )
            axios({
                method: "POST",
                url: '/announce/new/create/electronica/audio-ve-video',
                data: {
                    // category: this.if_isset_category_name( this.loadComponentData ) ,
                    sub_category_id: this.if_isset_original_sub_category_id( this.loadComponentData ),
                    type: this.if_isset( this.sub_category_type_name ),
                    title: this.if_isset( this.announce_title ),
                    check_box: this.if_isset( this.checkBoxElems ),
                    price: this.if_isset( this.price ),
                    city: this.if_isset( this.city_name ),
                    about: this.if_isset( this.about ),
                    name: this.if_isset( this.name ),
                    email: this.if_isset( this.email ),
                    phone: this.if_isset( this.phone ),
                }
            }).then( res => {
                console.log('Create res = ', res.data )
            }).catch( error => {
                if( error.response.status === 422 ) {
                    this.errors.push(error.response.data.errors);
                    console.log('Create Err === ', this.errors )
                }
            })
        },
        loadComponent(){
            if( this.loadComponentData !== undefined && this.loadComponentData.new_data !== undefined ) {
                if( this.loadComponentData.new_data.category_name !== undefined && this.loadComponentData.new_data.sub_category_name !== undefined ) {
                    let sub_category_modal_id = this.loadComponentData.new_data.category_name;
                    let category_name = this.loadComponentData.new_data.category_name.toLowerCase();
                    let folder_name   = this.loadComponentData.new_data.sub_category_name.toLowerCase();
                    let sub_category_name = this.loadComponentData.new_data.sub_category_name;

                    this.closeBeforeVisibleModals(sub_category_modal_id);
                    // this.sub_category_id = this.loadComponentData.new_data.sub_category_id;
                    // console.log('sub_category_id = ',  sub_category_name  )
                    this.openAnnounceNewCollapse('announce-new-collapse');
                    this.load_component_border = 'border:1px solid rgb(0 0 0 / 6%)';
                }
            }
        },
        getSubCategoryTypeNameFromAudioVeVideoComponent(data){
            if( data !== undefined && data.name !== undefined ) {
                this.sub_category_type_name = data.name;
            }
        },
        getCheckBoxVarsFromAudioVeVideoComponent(data){
            if( data !== undefined && data.checkBox !== undefined ) {
                this.checkBoxElems = data.checkBox;
                // console.log('MMMMMM = ', data.checkBox )
            }
        },
        getAnnounceTitleFromAudioVeVideoComponent(data) {
            if( data !== undefined && data.announce_title !== undefined ) {
                this.announce_title = data.announce_title;
            }
        },
        getCityNameFromAnnounceNewModalCity(data){
            if( data !== undefined && data.city !== undefined ) {
                this.city_name = data.city;
                // console.log('MMMMMM = ', data.checkBox )
            }
        },
        getPriceFromAnnounceNewPriceComponent(data){
            if( data !== undefined && data.price !== undefined ) {
                this.price = data.price;
                // console.log('MMMMMM = ', data.price )
            }
        },
        getAboutFromAnnounceNewModalAbout(data) {
            if( data !== undefined && data.about !== undefined ) {
                this.about = data.about;
            }
        },
        getUserNameFromNewAnnounceUserInfoComponent(data) {
            if( data !== undefined && data.name !== undefined ) {
                this.name = data.name;
            }
        },
        getUserEmailFromNewAnnounceUserInfoComponent(data) {
            if( data !== undefined && data.email !== undefined ) {
                this.email = data.email;
            }
        },
        getUserPhoneNumberFromNewAnnounceUserInfoComponent(data) {
            if( data !== undefined && data.phone !== undefined ) {
                this.phone = data.phone;
            }
        },
        if_isset_category_name(data){
            if( data !== undefined && data.new_data !== undefined ) {
                if( data.new_data.category_name !== undefined ){
                    return data.new_data.category_name
                } else return false;
            } else return false;
        },
        if_isset_original_sub_category_id(data){
            if( (data !== undefined && data !== null) && (data.new_data !== undefined && data.new_data !== null) ) {
                if( data.new_data.sub_category_id !== undefined ){
                    return data.new_data.sub_category_id
                } else return false;
            } else return false;
        },
        if_isset( el ) {
            if( el !== undefined && el !== null )
                return el;
            return false;
        },
        closeBeforeVisibleModals(sub_category_id){
            this.closeCategoryModal('announce-new-category');
            // this.closeSubCategoryModal(sub_category_id);
        },
        openAnnounceNewCollapse(id){
            let collapse_id = document.getElementById(id);
            // console.log('collapse_id = ', collapse_id )
            if( collapse_id !== undefined && collapse_id !== null ) {
                this.closeAnnounceNewCollapse('announce__new_collapse');
                setTimeout(() => {
                    new bootstrap.Collapse( collapse_id, {
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
            if( category_modal_id.classList !== undefined ){
                if( category_modal_id.classList.contains('show') ){
                    category_modal_id.classList.remove('show');
                }
            }

            new bootstrap.Offcanvas(category_modal_id, {
                toggle: false
            });
            this.removeBackDrops('offcanvas-backdrop');

            setTimeout( () => {
                body_style.removeAttribute("style")
            },400);
        },
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
        this.loadComponent();
        // console.log('AAAAAA = ', this.categories )
    }
}
</script>

<style scoped>
    .custom__border {
        border: 1px solid rgb(240 240 240);
    }
    .announce__user_info_styles {

    }
    .custom__bg_image_uploade {
        background-color: #12ae2433;
    }
        .color__custom_photo_camera {
            color: #176a0bb3;
        }
    .custom__image_uploade_text {
        color: #0f3f08b3;
    }
    .image__show_div_styles {
        border: 2px dashed #4cac3c45;
        margin: 15px;
        border-radius: 10px;
        background-color: #f4f4c89c;
        padding: 10px 10px;
    }
</style>
