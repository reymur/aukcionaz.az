<template>
    <div class="col-12">
        <div class="col-12">
            <div class="text-decoration-none d-flex" type="button">
                <div class="col-12 d-flex p-4 justify-content-center product__info">
                    <div class="col-1 me-2">
                        <photo-provider>
                            <photo-consumer v-for="(src, id) in imgList" :intro="src" :key="src" :id="id" :src="src">
                                <img v-if="id === 0" :src="src" class="view-box rounded-circle product__avatar">
                            </photo-consumer>
                        </photo-provider>
                    </div>

                    <div v-if="product" class="col-8 d-flex align-items-center">

                        <component
                            :is="importAuksiyonComponentElements"
                            :product="product"
                        ></component>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="collapse" id="collapseExample">-->
<!--            <div class="d-flex justify-content-center pt-3">-->
<!--                <div class="card w-auto">-->
<!--                    <photo-provider>-->
<!--                        <photo-consumer v-for="(src, id) in imgList" :intro="src" :key="src" :id="id" :src="src">-->
<!--                            <img :src="src" class="view-box">-->
<!--                        </photo-consumer>-->
<!--                    </photo-provider>-->

<!--                    <div class="card-body">-->
<!--                        <h5 class="card-title">Range Rove Voqe</h5>-->
<!--                        <p class="card-text"> 2005 </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

    </div>
</template>

<script>

import {PhotoProvider, PhotoConsumer, PhotoSlider } from 'vue3-photo-preview';
import { defineComponent, defineAsyncComponent } from "vue";

export default {
    name: "OnAukcion",
    props:['product'],
    data() {
        return {
            imgList: [],
            image_path: 'https://auksiyonaz.test/storage/images/products/'
        }
    },
    components: {
        PhotoProvider,
        PhotoConsumer,
        PhotoSlider
    },
    methods: {
        getImages(){
            if( this.product && this.product.images ) {
                this.product.images.forEach( img => {
                    let image = this.image_path+img.image;
                    this.imgList.push(image)
                });

                this.showOneImage;
            }
        }
    },
    computed: {
        importAuksiyonComponentElements(){
            if( this.product && this.product.sub_category && this.product.sub_category.slug ) {
                let name = this.product.sub_category.slug;
                let new_name = '';
                let name_arr = name.split('-');


                name_arr.forEach( str => {
                    if( str[0] && str.substring(1) )
                        new_name += str[0].toUpperCase() + str.substring(1);
                })

                return defineAsyncComponent(() =>
                    import( '../auksiyon/elements/'+ new_name +'Element.vue' )
                );
            }
        },
        showOneImage() {
            let el = document.getElementsByClassName('PhotoConsumer');

            if( el !== undefined && el !== null ) {
                if( el.length === this.imgList.length ) {
                    for (let i = 0; i < el.length; i++) {
                        if (el[i].id > 0) {
                            if (el[i].classList !== undefined && el[i].classList !== null) {
                                el[i].classList.add('d-none')
                            }
                        }
                    }
                }
            }
        }
    },
    mounted () {
        this.getImages();
        // this.showOneImage;

        // console.log('PhotoConsumer - ',
        //     document.getElementsByClassName('PhotoConsumer')
        // );

        console.log('PhotoConsumer - ',
            // this.product.sub_category.slug
            // this.generateComponentName(this.product.sub_category.slug)
        );
    }
}
</script>

<style scoped>
.product__info {
    background-color: #fff;
    text-transform: capitalize;
    font-size: 21px;
    color: #000;
    letter-spacing: 1px;
    font-family: sans-serif;
}

.close__style {
    color: #fa1f1f;
}
.product__avatar {
    width: 60px;
    height: 60px;
}
</style>
