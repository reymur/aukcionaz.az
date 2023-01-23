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

        <!-- APPEND UPLOAD IMAGES -->
        <div class="col overflow-hidden" id="image__show_div"></div>
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
           console.log('CCCCCC - - - ', file.target.files[0].type )
            this.images = file.target.files;
            if( file && file.target && file.target.files ) {

                this.$emit('sendUploadFile', file.target.files );

                if( file && file.target && file.target.files ) {
                    if( file.target.files.length && file.target.files.length > 0 ) {

                        for ( let i=0; i < file.target.files.length; i++ ) {
                            this.showUploadImage( file.target.files[i] );
                        }
                    }
                }
            }
        },
        removeUploadValue(ev) {
            if( ev && ev.target && ev.target.value ) ev.target.value = null;
        },
        showUploadImage( upload_image ) {
            if( upload_image ) {
                let new_img = null;
                let new_img_div = null;
                let upload_image_src = null;
                let image_show_div = document.getElementById('image__show_div');

                if( image_show_div ) {
                    new_img = document.createElement('img');
                    new_img_div = document.createElement('div');
                    upload_image_src = URL.createObjectURL( upload_image );

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
                                clearInterval(ifIssetNewImageDiv);
                            }
                        }, 10)

                        new_img.src = upload_image_src;
                        new_img.id = upload_image.name + '_1';
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
</script>

<style scoped>
    .custom__image_upload_text {
        color: #0f3f08b3;
    }
    .color__custom_photo_camera {
        color: #176a0bb3;
    }
</style>
