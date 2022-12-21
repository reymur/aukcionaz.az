<template>
<div class="col-12">
    <div class="d-flex bg-secondary">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5 col-xxl-5 d-flex justify-content-center">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :intro="src" :key="id" :src="src">
                    <img v-if="id == 0" :src="imgList[0]" class="">
                </photo-consumer>
            </photo-provider>
        </div>
        <div class="col-6 d-flex p-3">
            <photo-provider>
                <photo-consumer v-for="(src, id) in imgList" :key="id" :id="'img-'+id" :intro="src" :src="src">
                    <div class="col-12 p-2" key="id">
                        <img v-if="id> 0" :src="src" class="w-100">
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
    name: "ProductShow",
    data() {
        return {
            imgList: [
                'https://i.ytimg.com/vi/LfO2U9gw2iE/hqdefault.jpg',
                'https://lockandkeypros.com/wp-content/uploads/2021/11/Challenger-PNG-Photo-500x270-1.png',
                'https://lockandkeypros.com/wp-content/uploads/2021/11/Challenger-PNG-Photo-500x270-1.png',
                'https://lockandkeypros.com/wp-content/uploads/2021/11/Challenger-PNG-Photo-500x270-1.png',
                'https://cdn.jdpower.com/ChromeImageGallery/Expanded/White/640/2014DOD004b_640/2014DOD004b_640_05.jpg',
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

            if (el !== undefined && el !== null) {
                if (el.length === this.imgList.length) {
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
    mounted() {
        this.showOneImage;

        if (document.getElementById('img-0')) {
            document.getElementById('img-0').style.display = 'none'
        }

        // console.log('PhotoConsumer - ',
        //     document.getElementsByClassName('PhotoConsumer')
        // );
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
