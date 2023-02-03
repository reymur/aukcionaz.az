<template>
<div class="col-12">
    <div class="d-flex bg-secondary">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5 col-xxl-5 d-flex justify-content-center">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :intro="src" :key="id" :src="src">
                    <img v-if="id === 0" :src="new_image_path+imgList[0].image" class="">
                </photo-consumer>
            </photo-provider>
        </div>
        <div class="col-6 d-flex p-3">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-'+id" :intro="src" :src="src">
                    <div class="col-12 p-2" key="id">
                        <img v-if="id > 0" :src="new_image_path+src.image" class="w-100">
                    </div>
                </photo-consumer>
            </photo-provider>
        </div>
    </div>
</div>
</template>

<script>
import {
    PhotoProvider,
    PhotoConsumer,
    PhotoSlider
} from 'vue3-photo-preview';
// images/products/
export default {
    name: "ProductShow",
    props:['product'],
    data() {
        return {
            new_image_path: location.protocol +'//'+location.host+'/storage/images/products/',
            imgList: null,
        }
    },
    components: {
        PhotoProvider,
        PhotoConsumer,
        PhotoSlider
    },
    methods: {
        getImages() {
            if( this.product && this.product.images && this.product.images ) {
                return this.imgList = this.product.images
            }
        }
    },
    computed: {
        showOneImage() {
            let el = document.getElementsByClassName('PhotoConsumer');

            if ( el && this.product && this.product.images ) {
                if ( el.length === this.product.images.length ) {
                    for (let i = 0; i < el.length; i++) {
                        if ( el[i].id > 0 ) {
                            if ( el[i].classList ) {
                                el[i].classList.add('d-none')
                            }
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.getImages();
        this.showOneImage;

        if (document.getElementById('img-0')) {
            document.getElementById('img-0').style.display = 'none'
        }

        console.log('new_image_path - ', location.protocol +'//'+this.new_image_path );
        console.log('$product - ', this.product.images[0].image );
    }
}
</script>

<style scoped>
/* .product__info {
    background-color: #fff;
    text-transform: capitalize;
    font-size: 21px;
    color: #000;
    letter-spacing: 1px;
    font-family: sans-serif;
} */

/* .close__style {
    color: #fa1f1f;
} */
</style>
