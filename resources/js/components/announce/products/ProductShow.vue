<template>
<div class="col-12">
    <div class="d-flex bg-secondary">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5 col-xxl-5 product__show_image">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :intro="src.image" :id="'consumer-big-image-show-'+id" :key="id" :src="new_image_path+src.image" class="d-flex">
                    <img v-if="id === 0" :src="new_image_path+imgList[0].image" class="">
                </photo-consumer>
            </photo-provider>
        </div>
        <div class="col-6 d-flex ps-0 pt-1 pe-3 pb-3">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-'+id" :intro="src.image" :src="new_image_path+src.image">
                    <div v-if="id > 0" class="col-12 p-2" :key="id">
                        <img :src="new_image_path+src.image" class="w-100">
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
        },
        deleteFakeBigConsumerImages() {
            let set = setInterval( () => {
                let ids = document.querySelectorAll('.PhotoConsumer');

                ids.forEach( (el, i) => {
                    if( el && el.id !== 'consumer-big-image-show-0' ) {
                        if( el.id === 'consumer-big-image-show-'+ i ){
                            el.parentNode.removeChild(el)
                        }
                    }
                });

                if( ids ) clearInterval( set );
            }, 1);
        },
        deleteFakeSmallConsumerImages() {
            let set = setInterval( () => {
                let id = document.getElementById('img-0');
                if( id ) {
                    id.parentNode.removeChild(id);
                    if( !id ) clearInterval( set );
                }
            }, 1);
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
        this.deleteFakeBigConsumerImages();
        this.deleteFakeSmallConsumerImages();
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
    .PhotoConsumer {
        display: flex;
        width: 100%;
        height: 100%;
    }
        .PhotoConsumer img {
            align-self: center;
            background-size: cover;
            margin: auto;
            display: block;
        }
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
