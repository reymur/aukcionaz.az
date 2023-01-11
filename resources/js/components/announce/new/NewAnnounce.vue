<template>
    <div class="col-12">

        <!-- ANNOUNCE NEW LOAD  COMPONENT  COLLAPSE-->
        <component
            :is="loadComponent"
            :categories="categories"
            :cities="cities"
            @callComponentInNewAnnounce="loadCallComponent"
        ></component>

    </div>
</template>

<script>
import { defineComponent, defineAsyncComponent } from "vue";

export default {
    props: ['categories','cities'],
    data() {
        return {
            category_name: 'elektronika',
            load_component_folder: 'audiovevideo',
            load_component_name: 'AudioVeVideo'
        }
    },
    watch: {

    },
    computed: {
        loadComponent(){
            let category = this.category_name;
            let folder = this.load_component_folder;
            let component = 'Index'+this.load_component_name;

            return defineAsyncComponent( () =>
                import(`../new/category/${category}/${folder}/${component}`)
            )
        }
    },
    methods: {
        loadCallComponent(event){
            console.log('WWWWWWWWW === ', event.sub_category_id )
            this.category_name = event.category_name;
            this.load_component_folder = event.load_component_folder;
            this.load_component_name = event.load_component_name;
        },
    },
    mounted() {
        // console.log('AAAAAA = ', this.loadComponentData.data.sub_category_name)
    }
}
</script>

<style scoped>

</style>
