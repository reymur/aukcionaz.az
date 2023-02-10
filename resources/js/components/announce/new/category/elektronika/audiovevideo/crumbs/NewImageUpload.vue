<template>
    <div class="">
        <div class="input-group control-group mb-3" id="image">
            <label for="formFileLg" class="form-control form-control-lg d-flex mx-3 align-self-center border-0 rounded-0 lh-lg w-100 justify-content-center custom__bg_image_uploade" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-camera-fill color__custom_photo_camera" viewBox="0 0 16 16">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                </svg>
                <span class="ms-2 fs-5 custom__image_upload_text">Şəkil</span>
            </label>

            <input type="file" @change="getImages" multiple @click="removeUploadValue" accept="image/*"
                   tabindex="-1" class="form-control opacity-0 border-0 bg-info rounded-0 position-absolute w-50" id="formFileLg">

            <div v-if="errors && errors.length" class="invalid-feedback d-block fs-6 ms-4 mt-1" id="image-error">
                <div v-for="error in errors" class=""> {{ error }} </div>
            </div>
        </div>

        <!-- CLOSE UPLOAD IMAGES TITLE -->
        <div v-if="delete_all_images" @click="deleteAllImages" class="col d-flex">
            <div class="pe-3 pb-1 delete__all_images">Bütün şəkilləri sil</div>
        </div>

        <!-- APPEND UPLOAD IMAGES -->
        <div v-if="images.length" class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 row-cols-xl-8 d-flex overflow-hidden pt-3 px-3 mb-3" id="image__show_div"></div>
    </div>
</template>

<script>
export default {
    name: "NewImageUpload",
    props: ['upload_image_id','image_errors'],
    data() {
        return {
            images: '',
            errors: null,
            image_arr: [],
            delete_all_images: null,
        }
    },
    watch: {
        image_errors(){
            this.errors = this.image_errors;
        },
        upload_image_id() {
            // this.getUploadImage();
        }
    },
    methods: {
        getImages( file ){
            let new_image = null;
            this.image_arr = [];
            this.images = file.target.files;
            if( file && file.target && file.target.files ) {

                if( file && file.target && file.target.files ) {
                    if( file.target.files.length && file.target.files.length > 0 ) {
                        for ( let i=0; i < file.target.files.length; i++ ) {
                            new_image = this.showUploadImage( file.target.files[i], i );

                            if( new_image ) this.image_arr.push( new_image );

                            let id = setInterval( () => {
                                console.log( 'ID - ', this.image_arr.length );
                                if( id ) clearInterval(id);
                            },1 );
                        }

                        let sendUploadFile = setInterval( () => {
                            if( file.target.files.length && this.image_arr.length ) {
                                for (let i = 0; i < file.target.files.length; i++) {
                                    if( this.image_arr[i].id ) clearInterval( sendUploadFile );

                                    if( file.target.files[i] && this.image_arr[i].id ) {
                                        this.sendUploadImages( file.target.files[i], this.image_arr[i].id );
                                    }
                                }
                            }
                        },1 );
                    }
                }
            }
        },
        sendUploadImages( files, id ){
            this.$emit('sendUploadFile', files, id );
        },
        closeUploadImage( element ) {
            console.log( 'return c - ', element.target );
            if( element ) {
                let c = 0;
                let image_id = null;
                let which_image = null;

                if( element.target && element.target.parentNode && element.target.parentNode.parentNode ) {
                    if( element.target.parentNode.parentNode.id ) {
                        let parent_id = element.target.parentNode.parentNode.id;

                        if( parent_id.indexOf('upload-image-close') !== -1 ) {
                            if( element.target.parentNode.parentNode.parentNode ) {
                                which_image = element.target.parentNode.parentNode.parentNode.firstChild;
                                if( which_image && which_image.id ) image_id = which_image.id;

                                element.target.parentNode.parentNode.parentNode.remove();
                            }
                        } else if( parent_id.indexOf('new_img_div-') !== -1 ) {
                            if( element.target.parentNode.parentNode ) {
                                which_image = element.target.parentNode.parentNode.firstChild;
                                if( which_image && which_image.id ) image_id = which_image.id;

                                element.target.parentNode.parentNode.remove();
                            }
                        } else if ( parent_id.indexOf('image__show_div') !== -1 ) {
                            if( element.target.childNodes ) {
                                which_image = element.target.parentNode.firstChild;
                                if( which_image && which_image.id ) image_id = which_image.id;

                                element.target.parentNode.remove();
                            }
                        }

                        if( image_id ) {
                            let id = Number( image_id );
                            console.log( 'NuM c - ', image_id );
                            this.sendUploadImages( null, id );
                        }
                        // console.log( 'image_name - ', image_name.substring(0, 1) );
                    }
                }

                console.log( 'return c - ', image_id );
            }
        },
        removeUploadValue(ev) {
            if( ev && ev.target && ev.target.value ) ev.target.value = null;
        },
        showUploadImage( upload_image, id ) {
            if( upload_image ) {
                let new_img = null;
                let new_img_close = null;
                let new_img_div = null;
                let upload_image_src = null;
                let image_show_div = document.getElementById('image__show_div');

                if( image_show_div ) {
                    new_img = document.createElement('img');
                    new_img_close = document.createElement('div');
                    new_img_div = document.createElement('div');
                    upload_image_src = URL.createObjectURL( upload_image );

                    if( new_img_div && new_img && new_img_close && upload_image_src ) {
                        new_img_div.classList.add('position-relative');
                        // new_img_div.classList.add('m-auto');
                        new_img_div.classList.add('p-2');
                        new_img_div.classList.add('col-6');
                        new_img_div.classList.add('col-sm-4');
                        new_img_div.classList.add('col-md-3');
                        new_img_div.classList.add('col-lg-2');
                        new_img_div.classList.add('col-xl-2');
                        new_img_div.classList.add('col-xxl-2');
                        new_img_div.classList.add('float-start');
                        new_img_div.classList.add('float-sm-start');
                        new_img_div.classList.add('float-md-start');
                        new_img_div.classList.add('float-lg-start');
                        new_img_div.classList.add('float-xl-start');
                        new_img_div.classList.add('float-xxl-start');
                        new_img_close.style = 'position: absolute; top: 9px; right: 9px; cursor:pointer; padding:10px 10px;'

                        let ifIssetNewImageDiv = setInterval( () => {
                            if( new_img_div.offsetWidth > 0 ) {
                                new_img_div.style.height = ( (Number(new_img_div.offsetWidth) / 4) * 3)+'px';
                                clearInterval(ifIssetNewImageDiv);
                            }
                        }, 10)

                        new_img.src = upload_image_src;
                        new_img.classList.add('has_new_img');
                        new_img.classList.add('w-100');
                        new_img.classList.add('h-100');
                        new_img.style = 'box-shadow: 1px 1px 5px 1px #00000033;';

                        let new_img_count = setInterval( () => {
                            if( document.getElementsByClassName('has_new_img') ) {
                                let has_new_img = document.getElementsByClassName('has_new_img');
                                if (has_new_img.length) clearInterval(new_img_count);

                                //DELETE ALL IMAGES VAR delete_all_images
                                setTimeout( () => {
                                    if( has_new_img.length > 1 ) this.delete_all_images = true;
                                    else this.delete_all_images = false;
                                }, 300 )


                                for ( let i = 0; i < has_new_img.length; i++ ) {
                                    if( ! has_new_img[i].id ) {
                                        let id = null;
                                        if( has_new_img[i - 1] && has_new_img[i - 1].id ) {
                                            id = Number(has_new_img[i - 1].id) + 1;
                                            has_new_img[i].id = id;
                                        }
                                        else {
                                            id = i;
                                            has_new_img[i].id = i;
                                        }
                                    }
                                }
                            }
                        }, 1);

                        // CLOSE UPLOAD IMAGES
                        new_img_close.id = 'upload-image-close-'+Math.floor( Math.random() * 100 );
                        new_img_close.addEventListener( 'click', this.closeUploadImage );
                        new_img_close.classList.add('close-upload-image');
                        new_img_close.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x" viewBox="0 0 16 16">\n' +
                                                    '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>\n' +
                                                  '</svg>';

                        new_img_div.id = 'new_img_div-'+upload_image.name+'_'+ Math.floor( Math.random() * 100 );
                        new_img_div.classList.add('new_img_div');
                        new_img_div.appendChild(new_img);
                        new_img_div.appendChild(new_img_close);

                        // image_show_div.id = upload_image.name;
                        image_show_div.classList.add('image__show_div_styles');
                        image_show_div.appendChild(new_img_div);
                    }
                }

                return new_img;
            }
        },
        deleteAllImages() {
            let all_images = document.getElementsByClassName('new_img_div');
            let image__show_div = document.getElementById('image__show_div');
            console.log( 'all_images.length111 - ', all_images.length );
            if( image__show_div && all_images && all_images.length ) {
                image__show_div.innerHTML = '';
            }
            console.log( 'all_images.length222 - ', document.getElementsByClassName('new_img_div') );
            if( ! all_images.length ) {
                console.log( '33333333333 - ', document.querySelectorAll('.new_img_div') );
                this.delete_all_images = false;
                this.$emit('deleteAllImagesFromNewImageUpload', true );
            }
        },
    }
}
</script>

<style scoped>
    .custom__image_upload_text {
        color: #0f3f08b3;
    }
    .color__custom_photo_camera {
        color: #176a0bb3;
    }
    .delete__all_images {
        color: #6279ff;
        text-decoration: underline;
        cursor: pointer;
        position: absolute;
        right: 0;
        margin: -8px 5px 0 0;
    }
</style>
