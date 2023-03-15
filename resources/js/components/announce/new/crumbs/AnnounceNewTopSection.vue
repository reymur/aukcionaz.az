<template>
    <div class="">
        <!-- ANNOUNCE NEW TOP SECTION ELEMENT-->
        <ul class="list-group">
            <li class="list-group-item col-12 d-flex p-3 shadow-sm new_announce_add_top_element_li_style">
                <!-- GO TO BACK BTN -->
                <div class="col">
                    <a :href="previous_url" class="text-decoration-none text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </a>
                </div>
            
                <div class="col text-black fs-5 d-flex justify-content-center">
                    Yeni elan
                </div>

                <div class="col">

                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            previous_url: document.referrer
        }
    },
    methods: {
        
    },
    mounted() {
        console.log('getPrevious = ', document.referrer )
    }
}
</script>

<style>

</style>