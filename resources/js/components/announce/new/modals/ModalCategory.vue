<template>
    <div class="" id="new-announce-category">
        <!-- Button trigger modal -->
        <ul class="list-group" data-bs-toggle="offcanvas" data-bs-target="#announce-new-category" aria-controls="offcanvasRight">
            <li :class="'list-group-item col-12 d-flex border-0 '+image_padding+' shadow-sm'">
                <div v-if="category_image !== null" class="col-1 vertical__all_catalog_img_div">
                    <img :src="'/images/category/'+ category_image" class="card-img-top vertical__all_catalog_img" alt="...">
                </div>
                <div v-else class="me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="gray" class="bi bi-grid" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                    </svg>
                </div>
                
                <div v-if="category_name !== null && sub_category_name !== null" class="col lh-1 ms-2 align-self-center" role="button">
                    <div class="d-block mb-1 text-black-50 fs-6">
                        {{ category_name }}
                        <span class="text-danger text-opacity-75">*</span>
                    </div>
                    <div class="d-block fs-5">
                        {{ sub_category_name }}
                    </div>
                </div>
                <div v-else class="col text-black-50 align-self-center fs-5" role="button">
                    Kateqoriya
                    <span class="text-danger text-opacity-75">*</span>
                </div>

                <div class="d-flex align-self-center text-end">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="gray" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            </li>
        </ul>
    
        <!-- offcanvas -->
        <div class="offcanvas offcanvas-end w-100" tabindex="-1" id="announce-new-category" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header shadow-sm mb-1"> 
                <div class="col">
                    <h5 class="offcanvas-title m-auto" id="offcanvasRightLabel"> 
                        <svg xmlns="http://www.w3.org/2000/svg" type="button" data-bs-dismiss="offcanvas" aria-label="Close" width="22" height="22" fill="currentColor" class="bi bi-chevron-left text-black-50" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </h5>
                </div>
                <div class="col fs-5 d-flex justify-content-center">Kataloq</div>
                <div class="col"></div>
            </div>

            <div class="offcanvas-body p-0">
                <div v-if="categories !== undefined && categories !== null && categories.length > 0"  class="">
                    <ul class="list-group">
                        <li 
                            v-for="category in categories" 
                            :key="category.id" 
                            :id="category.id" 
                            class="list-item"
                        >
                            <modal-show-category-elements
                                :category="category"
                                @sendSubCategoryNameToModalCategoryComponent="sendSubCategoryNameToNewAnnounceComponent"
                            ></modal-show-category-elements>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['categories'],
    data() {
        return {
            loadFirst: false,
            category_name: null,
            category_image: null,
            sub_category_name: null,
            image_padding: 'p-3',
            first_category_top_padding: 'p-3',
        }
    },
    methods: {
        sendSubCategoryNameToNewAnnounceComponent(data){
            this.category_name = data.category.name;
            this.category_image = data.category.image.toLowerCase();
            this.sub_category_name = data.original_sub_category_name;
            this.changeImagePadding();
            // console.log('sub_category_name = ', data.original_sub_category_name )
            this.$emit('sendSubCategoryInfoToNewAnnounceComponent', {
                new_data: data
            });
        },
        changeImagePadding(){
            if( this.category_image !== null ) {
               return this.image_padding = 'ps-2 py-1';
            }
        },
        changeFirstCategoryStyle() {
            let first_category = document.getElementById('1');
            console.log('first_category = ', first_category.classList.add('pt-2') )
        }
    },
    mounted() {
        this.changeFirstCategoryStyle();
        // alert(this.categories[0].name)
    }
}
</script>

<style>

</style>