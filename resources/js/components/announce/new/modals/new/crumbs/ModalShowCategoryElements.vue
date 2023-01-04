<template>
    <div class="">
        <!-- Modal button -->
        <a href="#offcanvasExample" class="text-decoration-none" data-bs-toggle="modal" :data-bs-target="'#id-'+category.id" data-bs-whatever="@mdo">
            <div class="col-12 d-flex py-2 ps-3">
                <div class="col-1 vertical__all_catalog_img_div">
                    <img :src="'/images/category/'+ category.image" class="card-img-top vertical__all_catalog_img" alt="...">
                </div>
                
                <li class="col-11 list-group-item d-flex vertical__all_catalog_li">
                    <h5 class="col-11 vertical__all_catalog_title"> {{ category.name }} </h5>
                    <div class="col-1 m-auto">1412</div>
                </li>
            </div>
        </a>
    
        <!-- Modal -->
        <div class="modal fade modal-right all__catalog_z_index" :id="'id-'+category.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-xxl-down">
                <div class="modal-content">
                    <div class="col-12 modal-header border-0">
                        <div class="col-5 m-0" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                        
                        <h1 class="col-7 modal-title fs-5 ms-3 fw-bolder all__category_image_li" id="exampleModalLabel">Elektronika</h1>
                    </div>

                    <div class="py-1 bg-light"></div>

                    <div class="modal-body pt-0">
                        <div class="">
                            <ul  class="list-group">
                                <div class="">
                                    <li 
                                        v-for="sub_category in category.sub_categories" 
                                        :key="sub_category.id" 
                                        v-on:click="getSubCategoryName" 
                                        :id="sub_category.id"
                                        role="button"
                                        class="list-group-item fs-5 py-2 mt-3 pointer-event all_catalog_category_items_style" 
                                    >
                                        {{ sub_category.name }}
                                    </li>
                                </div>  
                            </ul>
                        </div>
                    </div>

                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['category'],
    methods: {
        getSubCategoryName(event) {
            this.$emit('sendSubCategoryName', {
                name: this.transliteToLatinWords(event.target.innerText)
            })
            // console.log( event.target.innerText )
        },
        transliteToLatinWords(word) {
            var res = "", a = {};

            a['ü'] = 'u'; a['ö'] = 'o'; a['ğ'] = 'q';a['ə'] = 'e';
            a['ı'] = 'i'; a['ş'] = 's'; a['ç'] = 's';

            for(i in word) {
                if( word.hasOwnProperty(i) ) {
                    if( a[word[i]] === undefined ) {
                        res += word[i];
                    } else {
                        res += a[word[i]];
                    }
                }
            }
            var el =  res.split(' ');
            return this.deleteSybolsInWord( el );
        },
        deleteSybolsInWord(word) {
            var res = '';

            if( Array.isArray(word) ) {
                for(var i=0; i < word.length; i++ ) {
                    console.log('indexOf - ', word[i].indexOf('-'))
                    if( word[i].indexOf(',') !== -1 ) {
                        // console.log('111 --- ', word[i])
                       res += word[i].replace(',','');
                    } else if( word[i].indexOf('-') !== -1 ){
                        res += word[i].replace('-','');
                        // console.log('222 --- ', res )
                    } else{
                        res += word[i]
                    }
                }
            }
            return res;
        }
    },
    computed: {
        // showSubCategoryElement() {
        //     alert(222222)
        // }
    },
    mounted() {
        
    }
}
</script>

<style>

</style>