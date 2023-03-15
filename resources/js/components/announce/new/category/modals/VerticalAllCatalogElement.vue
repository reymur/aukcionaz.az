<template>
    <div class="">
        <li @click="getElement" class="list-group-item fs-5 py-2 mt-3 all_catalog_category_items_style" :id="sub_category.id" role="button">
            {{ sub_category.name }}
        </li>
    </div>
</template>

<script>
export default {
    props: ['sub_category','category'],
    data() {
        return {
            sub_category_id: null,
            category_slug: '',
            sub_category_slug: '',
        }
    },
    methods: {
        makeSlug(text) {
            if( text && typeof text === "string" ) {
                return text.toLowerCase()
                    .replace(/ /g, '-')
                    .replace(',', '')
                    .replace('.', '')
                // .replace(/[^\w-]+/g, '');
            }
        },
        getElement( el ) {
            let vertical_catalog_id = document.getElementById('verticalOffcanvasRightClose');
            let vertical_catalog_elements_id = document.getElementById('verticalOffcanvasRightElementClose');

            if( vertical_catalog_id ){
                vertical_catalog_id.click();
                vertical_catalog_elements_id.click();

                let vertical_catalog = document.getElementById('verticalOffcanvasRight');

                let is_show = setInterval( () => {
                    if( vertical_catalog.classList && ! vertical_catalog.classList.contains('show') ) {
                        clearInterval(is_show);
                        this.hrefToLocation();
                    }
                }, 0.1 );
            }
        },
        hrefToLocation(){
            let protocol = location.protocol;
            let host_name = location.hostname;
            if( this.category && this.sub_category ) {
                let href = protocol+'//'+host_name+'/'+
                    this.makeSlug(this.category.name)+'/'+
                    this.makeSlug(this.sub_category.name);

                if( href ) document.location.href = href;
                console.log('location - ', href );
                // document.location.href = ;
            }
        },
    },
    computed: {

    },
    mounted() {
        this.makeSlug();
    }
}
</script>

<style>

</style>
