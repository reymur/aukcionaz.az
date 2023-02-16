<template>
    <div class="bg-secondary d-flex justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 product__show_image" id="consumer-big-image-show-div">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :intro="src.image" :id="'consumer-big-image-show-'+id" :key="id" :src="new_image_path+src.image" class="d-flex">
                    <img v-if="id === 0" :src="new_image_path+imgList[0].image" class="big__mage_consumer">
                </photo-consumer>
            </photo-provider>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 pt-1" id="for-desktop-small-image-consumer-div">
            <div v-if="imgList" :class="'row row-cols-lg-'+num+' d-flex ps-0 pt-2 ps-2 pe-0 pb-3 desktop_small_image_div_parent'">
                <photo-provider>
                    <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-desktop-'+id" :intro="src.image" :src="new_image_path+src.image" class="d-flex px-1 py-1">
                        <div v-if="id > 0" class="col d-flex desktop_small_image_div" role="button" :key="id">
                            <img :src="new_image_path+src.image" class="small__mage_consumer">
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
            num: '',
            // docResize: window,
        }
    },
    components: {
        PhotoProvider,
        PhotoConsumer,
        PhotoSlider,
    },
    methods: {
        getImagesCount(){
            let set_i = setInterval( () => {
                // console.log('resize111 - ', this.num);
                let count = document.querySelectorAll('.small__mage_consumer');
                let for_desktop_small_image_consumer_div = document.getElementById('for-desktop-small-image-consumer-div');
                let consumer_big_image_show_div = document.getElementById('consumer-big-image-show-div');
                let small__mage_consumer = document.getElementsByClassName('small__mage_consumer');

                if( count && count.length ) {
                    if( count.length > 20 ) clearInterval(set_i);

                    // count = [1,1,1,1,1,1,1,1,1,1,1,1,1,1]
                    if ( count.length <= 2 || count.length <= 3 ) {
                        this.num = 4;
                        clearInterval(set_i);
                    }
                    if ( count.length > 3 && count.length <= 12 ) {
                        this.num = 4;
                        clearInterval(set_i);
                    }
                    if ( count.length > 12 && count.length <= 20 ) {
                        this.num = 5;
                        clearInterval(set_i);
                    }

                    if( count.length <= 12 ) {
                        if( small__mage_consumer && consumer_big_image_show_div && for_desktop_small_image_consumer_div ) {
                            for (let i = 0; i < small__mage_consumer.length; i++) {
                                small__mage_consumer[i].style.width = ((for_desktop_small_image_consumer_div.offsetWidth / 4) - 5)+'px';
                                small__mage_consumer[i].style.height = ((consumer_big_image_show_div.offsetHeight / 3) - 15)+'px';
                            }
                        }

                    }
                    else if( count.length > 12 ) {
                        for (let i = 0; i < small__mage_consumer.length; i++) {
                            small__mage_consumer[i].style.width = ((for_desktop_small_image_consumer_div.offsetWidth / 5) - 5)+'px';
                            small__mage_consumer[i].style.height = ((consumer_big_image_show_div.offsetHeight / 4) - 6.5)+'px';
                        }
                    }
                }
                else clearInterval(set_i);
            }, 1)
        },
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
        },
        resizeDesktopSmallImages() {

        }
    },
    watch: {
        docResize() {
            console.log('resize55555 - ', window.innerWidth )
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
        this.getImagesCount();
        this.deleteFakeBigConsumerImages();
        this.deleteFakeSmallConsumerImages();
        this.getImages();
        this.showOneImage;

        window.addEventListener('resize' , (e) => {
            this.getImagesCount();
        })

        if (document.getElementById('img-desktop-0')) {
            document.getElementById('img-desktop-0').style.display = 'none'
        }
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
    .small__mage_consumer {
        width: 100%;
        height: 100%;
    }
    .big__mage_consumer {
        max-width: 100%;
        max-height: 100%;
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
