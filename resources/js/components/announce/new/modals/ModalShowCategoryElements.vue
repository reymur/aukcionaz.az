<template>
    <div class="">
        <!-- Modal button -->
        <a href="" class="text-decoration-none" data-bs-toggle="modal" :data-bs-target="'#id-'+category.name" data-bs-whatever="">
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
        <div class="modal fade modal-right all__catalog_z_index" :id="'id-'+category.name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        :id="category.name"
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
            this.$emit('sendSubCategoryNameToModalCategoryComponent', {
                category_name: this.makeSlug(event.target.id),
                sub_category_name: this.makeSlug(event.target.innerText)
            })
            // console.log('dddd = ', event.target)
        },
        makeSlug(word) {
            let latina_words = this.convertToLatinLetters(word);
                latina_words = latina_words.replace(/[^A-Za-z0-9]+/gi, ' ');
                latina_words = latina_words.toLowerCase();
                latina_words = latina_words.split(' ');

            return this.toCapitalize( latina_words );
        },
        convertToLatinLetters(word) {
            if( typeof word === 'string' ) {
                var new_word = "", obj = {};

                obj['ü'] = 'u'; obj['ö'] = 'o'; obj['ğ'] = 'q';obj['ə'] = 'e';
                obj['Ü'] = 'u'; obj['Ö'] = 'o'; obj['Ğ'] = 'q';obj['Ə'] = 'e';
                obj['ı'] = 'i'; obj['ş'] = 'sh'; obj['ç'] = 'c';obj['i'] = 'i';
                obj['I'] = 'i'; obj['Ş'] = 'sh'; obj['Ç'] = 'c';obj['İ'] = 'i';

                for(i in word) {
                    if( word.hasOwnProperty(i) ) {
                        if( obj[word[i]] === undefined ) {
                            new_word += word[i];
                        } else {
                            new_word += obj[word[i]];
                        }
                    }
                }
            }
            return new_word;
        },
        toCapitalize(word) {
            let new_str = '';
            if( typeof word === 'object' ) {
                for( i in word ) {
                    if( word[i] !== undefined )
                        new_str += word[i].charAt(0).toUpperCase() + word[i].slice(1);
                }
            }
            return new_str;
        }
    },
    computed: {
        
    },
    mounted() {
        
    }
}
</script>

<style>

</style>