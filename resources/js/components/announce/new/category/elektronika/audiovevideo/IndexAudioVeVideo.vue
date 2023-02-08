<template>
    <div class="">
        <div class="col-12">
            <!-- ANNOUNCE NEW TOP ELEMENTS-->
            <announce-new-top-elements></announce-new-top-elements>

            <!-- NEW ANNOUNCE ADD CATEGORIES -->
            <div v-if="categories" class="bg-white position-relative w-100 mt-0 mb-2 p-0">
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
                            @showImageUploadSection="showImageUploadSection"
                            @sendSubCategoryTypeNameToIndexAudioVeVideoComponent="getSubCategoryTypeNameFromAudioVeVideoComponent"
                            @sendAnnounceTitleToNewAnnounceComponent="getAnnounceTitleFromAudioVeVideoComponent"
                            @sendCheckBoxVarsToNewAnnounceComponent="getCheckBoxVarsFromAudioVeVideoComponent"
                        ></audio-ve-video>
                    </div>
                </div>
            </div>

            <!-- NEW ANNOUNCE ADD INPUTS-->
            <div class="cbg-white position-relative w-100 mb-2 p-0 custom__border">
                <!-- ANNOUNCE NEW NEW PRICE -->
                <div class="border-0 position-relative">
                    <announce-new-modal-price
                        @sendPriceToNewAnnounceComponent="getPriceFromAnnounceNewPriceComponent"
                    ></announce-new-modal-price>
                </div>

                <div class="ms-3 border-bottom border-secondary border-opacity-10"></div>

                <!-- ANNOUNCE NEW NEW CITY -->
                <div v-if="cities" class="position-relative">
                    <announce-new-modal-city
                        :cities="cities"
                        @sendCityNameToNewAnnounceComponent="getCityNameFromAnnounceNewModalCity"
                    ></announce-new-modal-city>
                </div>

                <!-- ANNOUNCE NEW NEW ABOUT -->
                <div class="mt-2">
                    <announce-new-modal-about
                        @sendAboutToNewAnnounceComponent="getAboutFromAnnounceNewModalAbout"
                    ></announce-new-modal-about>
                </div>

                <!-- IMAGE UPLOAD SECTION -->
<!--                v-if="show_image_upload_section"-->
                <div  class="mt-4 pb-2 shadow-sm">
                    <new-image-upload
                        :image_errors="image_errors"
                        :upload_image_id="upload_image_id"
                        @sendUploadFile="getSendUploadFile"
                        @deleteAllImagesFromNewImageUpload="deleteAllImagesNow"
                    ></new-image-upload>
                </div>

                <!-- ANNOUNCE NEW USER INFO -->
                <div class="mt-2 mb-3 announce__user_info_styles">
                    <new-announce-user-info
                        :name_error="name_error"
                        :email_error="email_error"
                        :phone_error="phone_error"
                        @sendUserNameToNewAnnounceComponent="getUserNameFromNewAnnounceUserInfoComponent"
                        @sendUserEmailToNewAnnounceComponent="getUserEmailFromNewAnnounceUserInfoComponent"
                        @sendUserPhoneNumberToNewAnnounceComponent="getUserPhoneNumberFromNewAnnounceUserInfoComponent"
                    ></new-announce-user-info>
                </div>

                <!-- SEND BUTTON -->
                <div class="p-3 mb-4 border-bottom-danger">
                    <button
                        @click="createNewAnnounce"
                        type="button" :class="'btn btn-success aukcionaz__main-color w-100 '+ submit_button_disabled"
                    >
                        <p v-if="!submit_button_load" class="fs-5 p-2 m-auto text-white">Davam et</p>
                        <p v-else class="fs-5 p-2 m-auto text-white">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Gözləyin...
                        </p>
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
            upload_image_id: null,
            loadComponentData: '',
            load_component_border: '',
            sub_category_id: null,
            sub_category_type_name: '',
            title: '',
            checkBoxElems: [],
            city_name: '',
            price: '',
            about: '',
            name: '',
            email: '',
            phone: '',
            errors: [],
            name_error: null,
            email_error: null,
            phone_error: null,
            image_errors: null,
            sub_category_error_style: '',
            show_image_upload_section: false,
            images: [],
            submit_button_load: false,
            submit_button_disabled: '',
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
            this.deleteSubCategoryError();
        },
        sub_category_type_name(){
            this.deleteTypeError();
        },
        city_name(){
            this.deleteCityError();
        },
        errors() {
            if( this.errors ) {
                this.name_error = this.errors;
                console.log('AAAAA - ', this.errors )
            }
            if( this.errors && this.errors[0] && this.errors[0].email ) this.email_error = this.errors[0].email[0]
            if( this.errors && this.errors[0] && this.errors[0].phone )  this.phone_error = this.errors[0].phone[0]

            return this.errors;
        },
    },
    computed: {

    },
    methods: {
        ifIsSubCategoryError() {
            if( !this.sub_category_id ) {
                this.errors.forEach( el => {
                    if( el.sub_category_id ) {
                        let element = document.getElementById('category');
                        let category_error = document.getElementById('category-error');
                        let category_svg = document.getElementById('category-svg');
                        if( element && category_error && category_svg ) {
                            let elementPosition = element.getBoundingClientRect().top;
                            let topOffset = element.offsetHeight;

                            if( element.classList && category_error && category_svg && category_svg.classList ) {
                                if( category_svg.classList ) {
                                    category_svg.classList.add('pt-3');
                                    category_svg.classList.add('ps-3');
                                }
                                if( element.classList.contains('p-3') ){
                                    element.classList.remove('p-3');
                                    element.classList.add('p-1');
                                }
                                category_error.style.display = 'block';
                            }

                            window.scrollBy({
                                top: elementPosition - topOffset,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            }
        },
        ifIsTypeError() {
            if( !this.sub_category_type_name ) {
                this.errors.forEach( el => {
                    if( el.type ) {
                        let element = document.getElementById('sub-category-type-div');
                        let element_error = document.getElementById('sub-category-type-error');

                        if( element && element.classList ) {
                            let elementPosition = element.getBoundingClientRect().top;
                            let topOffset = element.offsetHeight;

                            if( element.classList && element_error && element_error.classList ) {
                                if( element.classList.contains('py-2') ) {
                                    element.classList.remove('py-2');
                                    element.classList.add('py-0');
                                }

                                if( el.type[0] ) {
                                    element_error.innerText = el.type[0] ;
                                    element_error.classList.add('d-block');
                                }
                            }

                            if( elementPosition && topOffset ) {
                                window.scrollBy({
                                    top: elementPosition - topOffset,
                                    behavior: 'smooth'
                                });
                            }
                        }
                    }
                });
            }
        },
        ifIsTitleError(error_name, parent, error_section, scroll) {
            let title_form = document.getElementById(parent);
            let title_label = document.getElementById('title-label');
            let title_error = document.getElementById(error_section);

            if( error_name ) {
                if( title_form && title_error && title_label ){
                    let elementPosition = title_form.getBoundingClientRect().top;
                    let topOffset = title_form.offsetHeight;

                    if( title_label.classList && title_error.classList ) {
                        title_form.classList.add('my-2')
                        // title_label.classList.add('pt-1')
                        if( error_name[0] ) {
                            title_error.innerText = error_name[0];
                            title_error.style.margin = '-4px 0px 0px 13px';
                            title_error.classList.add('d-block');
                        }
                    }

                    if( elementPosition && topOffset ) {
                        if( scroll ) {
                            window.scrollBy({
                                top: elementPosition - topOffset,
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            }else {
                if( title_label.classList && title_error.classList ) {
                    if( title_form.classList.contains('my-2') ) title_form.classList.remove('my-2')
                    if( title_error.classList.contains('d-block') ) {
                        title_error.classList.remove('d-block')
                    }
                }
            }
        },
        ifIsImageError(errors) {
            let count = 30;
            let image = document.getElementById('image');
            // console.log(' this.image_errors --- ',   errors[0] )
            if( errors && errors.length ) {
                let image_arr = [];
                errors.forEach( (error, key) => {
                    if( error['images'] ) image_arr[key] = error.images[0];
                    else {
                        for ( let i=0; i < count; i++ ) {
                            if( error['images.'+i] ) image_arr[i] = error['images.'+i][0];
                            // console.log(' this.image_errors --- ',   i )
                        }
                    }

                    if( !error.type &&! error.title && !error.price && !error.city && error.images ) {
                        let elementPosition = image.getBoundingClientRect().top;
                        let topOffset = image.offsetHeight;

                        if( elementPosition && topOffset ) {
                            if( scroll ) {
                                window.scrollBy({
                                    top: elementPosition - topOffset,
                                    behavior: 'smooth'
                                });
                            }
                        }
                    }
                });

                console.log(' this.image_errors --- ',   image_arr )
                return this.image_errors = image_arr;
            }
        },
        ifIsOtherErrors() {
            if( this.errors.length ) {
                this.errors.forEach( error => {
                    if( !error.sub_category_id ) {
                        if( !error.type ) this.ifIsTitleError( error.title, 'title-form', 'title-error', true );
                        else this.ifIsTitleError( error.title, 'title-form', 'title-error', false );

                        if( !error.type && !error.title && error.price ) this.isErrors( error.price, 'price', 'price-error', true );
                        else this.isErrors( error.price, 'price', 'price-error', false );

                        if( !error.type && !error.title && !error.price && error.city) this.isCityErrors( error.city, 'city', 'city-error', true );
                        else this.isCityErrors( error.city, 'city', 'city-error', false );

                        if( !error.type && !error.title && !error.price && !error.city && error.name ) this.isErrors( error.name, 'name', 'name-error', true );
                        else this.isErrors( error.name, 'name', 'name-error', false );

                        if( !error.type && !error.title && !error.price && !error.city && !error.name && error.email ) this.isErrors( error.email, 'email', 'email-error', true );
                        else this.isErrors( error.email, 'email', 'email-error', false );

                        if( !error.type && !error.title && !error.price && !error.city && !error.name && !error.email && error.phone ) this.isErrors( error.phone, 'phone', 'phone-error', true );
                        else this.isErrors( error.phone, 'phone', 'phone-error', false );
                    }
                })
            }
        },
        isErrors(error_name, parent, error_section, scroll){
            let parent_div = document.getElementById(parent);
            let error_div = document.getElementById(error_section);

            if( error_name ) {
                if( parent_div && error_div ){
                    let elementPosition = parent_div.getBoundingClientRect().top;
                    let topOffset = parent_div.offsetHeight;

                    if( parent_div.classList && error_div.classList ) {
                        if( error_name[0] ) {
                            error_div.innerText = error_name[0];
                            error_div.style.display = 'block';
                        }
                    }

                    if( elementPosition && topOffset ) {
                        if( scroll ) {
                            window.scrollBy({
                                top: elementPosition - topOffset,
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            }else {
                if( parent_div.classList && parent_div.classList.contains('border-danger') ) {
                    parent_div.classList.remove('border')
                    parent_div.classList.remove('border-danger')
                    error_div.style.display = 'none';
                }
                if( error_div ) error_div.style.display = 'none';
            }
        },
        isCityErrors( error_name, parent, error_section, scroll ){
            let parent_div = document.getElementById(parent);
            let error_div = document.getElementById(error_section);

            if( error_name ) {
                if( parent_div && error_div ){
                    let elementPosition = parent_div.getBoundingClientRect().top;
                    let topOffset = parent_div.offsetHeight;

                    if( parent_div.classList && error_div.classList ) {
                        if( parent_div.classList.contains('py-3')  ) {
                            parent_div.classList.remove('py-3');
                            parent_div.classList.add('pt-2');
                            parent_div.classList.add('pb-2');

                            if( error_name[0] ) {
                                error_div.innerText = error_name[0];
                                error_div.classList.add('mt-3');
                                error_div.style.display = 'block';
                            }
                        }
                    }

                    if( elementPosition && topOffset ) {
                        if( scroll ) {
                            window.scrollBy({
                                top: elementPosition - topOffset,
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            }else {
                if( parent_div.classList && parent_div.classList.contains('border-danger') ) {
                    parent_div.classList.remove('border')
                    parent_div.classList.remove('border-danger')
                    error_div.style.display = 'none';
                }
                if( error_div ) error_div.style.display = 'none';
            }
        },
        deleteSubCategoryError(){
            if( this.sub_category_id ) {
                this.errors.forEach( err => {
                    if( err.sub_category_id ) {
                        setTimeout( () => {
                            return delete this.errors[0].sub_category_id;
                        }, 200);
                    }
                });
            }
        },
        deleteTypeError(){
            if( this.sub_category_type_name ) {
                let element = document.getElementById('sub-category-type-div');
                let sub_category_type_invalid_tooltip = document.getElementById('sub-category-type-error');
                this.errors.forEach( el => {
                    if( el.type ) {
                        setTimeout( () => {
                            if( element && element.classList ) {
                                if( element.classList.contains('border') ) element.classList.remove('border');
                                sub_category_type_invalid_tooltip.style.display = 'none';
                                return delete this.errors[0].type;
                            }
                        }, 200);
                    }
                });
            }
        },
        deleteCityError() {
            if( this.city_name ) {
                let element = document.getElementById('city');
                let city_error = document.getElementById('city-error');
                if( element && city_error ) {
                    this.errors.forEach( el => {
                        if( el.city ) {
                            setTimeout( () => {
                                city_error.style.display = 'none';
                                return delete this.errors[0].city;
                            }, 200);
                        }
                    });
                }
            }
        },
        showImageUploadSection(data){
            if( data && data.data ) {
                setTimeout( () => {
                    this.show_image_upload_section = data.data
                }, 300 )
            }
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
        getSendUploadFile(data, index){
            let id = Number(index);
            // console.log('HAS111 = ', data, 'index111 = ', index );
            console.log('index111 = ', id );
            if( data && typeof id === "number" ) {
                console.log('data222 = ', id );
                this.images[id] = data
            }
            else if( ! data && typeof id === "number" ) {
                if( this.images && this.images.length ) {
                    console.log('index333 = ', id );
                    if( this.images[id] )
                        delete this.images[id];
                }
            }
            console.log('DELETED = ', this.images  );
        },
        deleteAllImagesNow( do_delete) {
            if( do_delete ) this.images = [];
            console.log('deleteAllImagesNow = ', this.images );
        },
        async createNewAnnounce(){
            this.submit_button_load = true;
            this.submit_button_disabled = 'disabled';
            this.errors = [];
            let data = new FormData();
            // console.log('FFFFFFFF = ', this.images );
            let category =  this.if_isset_category_name( this.loadComponentData )
            let sub_category_id =  this.if_isset_original_sub_category_id( this.loadComponentData )
            let type =  this.if_isset( this.sub_category_type_name );
            let title =  this.if_isset( this.title );
            let check_box =  this.if_isset( this.checkBoxElems );
            let price =  this.if_isset( this.price );
            let city =  this.if_isset( this.city_name );
            let about =  this.if_isset( this.about );
            let name =  this.if_isset( this.name );
            let email =  this.if_isset( this.email );
            let phone =  this.if_isset( this.phone );
            let images =  this.getUploadImages(this.images, data);

            console.log('ALL DATAS images = ', images );
            // console.log('ALL DATAS title = ', title );

            data.append('category', category );
            data.append('sub_category_id', sub_category_id );
            data.append('type', type );
            data.append('title', title );
            data.append('check_box', check_box );
            data.append('price', price );
            data.append('city', city );
            data.append('about', about );
            data.append('name', name );
            data.append('email', email );
            data.append('phone', phone );
            data.append('images', images );

            if( data ) {
                console.log('DATA +++ ', data );
                axios({
                    method: "post",
                    url: '/announce/new/create/electronica/audio-ve-video',
                    data,
                    processData: false,
                }).then( res => {
                    if( res && res.status && res.status === 200 && res.data ) {
                        this.submit_button_load = true;
                        this.submit_button_disabled = 'disabled';
                        // console.log('Create resA + = ', res.data.productable );
                        console.log('Create resA + = ', res );
                        if( res && res.data && res.data.productable && res.data.productable.id ) {
                            let id = res.data.productable.id;
                            document.location.href = 'https://public.test/product/'+id;
                        }
                        // REDIRECT TO NEW ADD PRODUCT SHOW PAGE
                        // document.location.href = 'https://public.test/product/';
                    }
                }).catch( error => {
                    if( error.response && error.response && error.response.status && error.response.status === 422 ) {
                        if( error.response && error.response.data && error.response.data.errors ) {
                            this.errors.push(error.response.data.errors);
                            this.ifIsSubCategoryError();
                            this.ifIsTypeError();
                            this.ifIsOtherErrors();
                            this.ifIsImageError(this.errors);

                            console.log('ERROR RESPONSE DATA STATUS 422 === ', this.errors )
                        }

                        else console.log('ERROR RESPONSE STATUS 422 === ', error.response.data )
                    }
                    else if( error.response && error.response && error.response.status && error.response.status === 500 ) {
                        console.log('ERROR STATUS 500 === ', JSON.stringify(error) )
                    }
                    else{
                        console.log('NO ERROR STATUS === ', JSON.stringify(error) )
                    }

                    this.submit_button_load = false;
                    this.submit_button_disabled = '';
                });
            }

        },
        getUploadImages( images, data ){
            if( images && images.length && data  ) {
                for ( let i = 0 ; i < images.length ; i++ ) {
                    if( typeof images[i] === "object" ) {
                        data.append('images[]', images[i])
                    }
                }
            }

            return data.get('images') ?? '';
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
            if( data !== undefined && data.title !== undefined ) {
                this.title = data.title;
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
            return null;
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
    .image__show_div_styles {
        border: 2px dashed #4cac3c45;
        margin: 15px;
        border-radius: 10px;
        background-color: #f4f4c89c;
        padding: 10px 10px;
    }
</style>
