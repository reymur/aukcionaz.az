<template>
    <div class="d-flex bg-secondary justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5 col-xxl-5 product__show_image">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :intro="src.image" :id="'consumer-big-image-show-'+id" :key="id" :src="new_image_path+src.image" class="d-flex">
                    <img v-if="id === 0" :src="new_image_path+imgList[0].image" class="w-100 h-100">
                </photo-consumer>
            </photo-provider>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5 col-xxl-5">
            <div class="row row-cols-sm-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-6 d-flex ps-0 pt-1 pe-3 pb-3">
                <photo-provider>
                    <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-desktop-'+id" :intro="src.image" :src="new_image_path+src.image">
                        <div v-if="id > 0" class="col d-flex p-2" role="button" :key="id">
                            <img :src="new_image_path+src.image" class="w-100 h-100">
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
        bigConsumerImageStyles(){
            let big_consumer_image = document.getElementById('consumer-big-image-show-0');
            if( big_consumer_image && big_consumer_image.style ) {
                big_consumer_image.style = "width:100%; height:100%";
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
                this.bigConsumerImageStyles();
                let id = document.getElementById('img-desktop-0');
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

        if (document.getElementById('img-desktop-0')) {
            document.getElementById('img-desktop-0').style.display = 'none'
        }

        console.log('new_image_path - ', location.protocol +'//'+this.new_image_path );
        console.log('$product - ', this.product.images[0].image );
    }
}
</script>

<style scoped>
    .PhotoConsumer {
        display: flex;
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
