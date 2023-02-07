<template>
    <div class="d-flex bg-secondary justify-content-center p-0 for__phone_image_consumer_div">
        <div class="col-12 ps-3 d-flex phone_image_consumer_styles">
            <div class="col d-flex p-1 align-self-center justify-content-center">
                <photo-provider>
                    <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-'+id" :intro="src.image" :src="new_image_path+src.image">
                        <div class="d-flex p-2 phone_image_consumer_img_div_styles" role="button" :key="id">
                            <img :src="new_image_path+src.image" class="phone__mage_consumer">
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
export default {
    name: "ShowForPhoneScreen",
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
        // deleteFakeSmallConsumerImages() {
        //     let set = setInterval( () => {
        //         let id = document.getElementById('img-0');
        //         if( id ) {
        //             id.parentNode.removeChild(id);
        //             if( !id ) clearInterval( set );
        //         }
        //     }, 1);
        // }
    },
    computed: {
        // showOneImage() {
        //     let el = document.getElementsByClassName('PhotoConsumer');
        //
        //     if ( el && this.product && this.product.images ) {
        //         if ( el.length === this.product.images.length ) {
        //             for (let i = 0; i < el.length; i++) {
        //                 if ( el[i].id > 0 ) {
        //                     if ( el[i].classList ) {
        //                         el[i].classList.add('d-none')
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    },
    mounted() {
        // this.deleteFakeSmallConsumerImages();
        this.getImages();
        // this.showOneImage;

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
    //background-color: #322f2c;
}
.PhotoConsumer img {
    align-self: center;
    background-size: cover;
    margin: auto;
    display: block;
}
.phone_image_consumer_styles {
    height: 150px;
}

.phone_image_consumer_img_div_styles {
    width: 200px;
    height: 150px;
    //background-color: #322f2c;
}
.phone__mage_consumer {
    //max-width: 100%;
    //max-height: 100%;
    width: 100%;
    height: 100%;
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

