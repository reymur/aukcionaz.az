<template>
    <div class="col-12">
        <div class="col-12">
            <div class="text-decoration-none d-flex" type="button">
                <div class="col-12 d-flex p-4 justify-content-center product__info">
                    <div class="col-1 me-2">
                        <photo-provider>
                            <photo-consumer v-for="(src, id) in imgList" :intro="src" :key="src" :id="id" :src="src">
                                <img :src="src" class="view-box rounded-circle product__avatar">
                            </photo-consumer>
                        </photo-provider>
                    </div>

                    <div class="col-8 d-flex align-items-center">
                        Range rover voge / 2005 / 12000 km
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

export default {
    name: "OnAukcion",
    data() {
        return {
            imgList: [
                'https://i.ytimg.com/vi/LfO2U9gw2iE/hqdefault.jpg',
                'https://lockandkeypros.com/wp-content/uploads/2021/11/Challenger-PNG-Photo-500x270-1.png',
                'https://cdn.jdpower.com/ChromeImageGallery/Expanded/White/640/2014DOD004b_640/2014DOD004b_640_05.jpg',
            ],
        }
    },
    components: {
        PhotoProvider,
        PhotoConsumer,
        PhotoSlider
    },
    methods: {

    },
    computed: {
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
        this.showOneImage;

        // console.log('PhotoConsumer - ',
        //     document.getElementsByClassName('PhotoConsumer')
        // );
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
}
</style>
