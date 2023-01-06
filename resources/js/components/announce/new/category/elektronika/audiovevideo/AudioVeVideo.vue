<template>
    <div class="" id="new-announce-category">
        <!-- Button trigger modal -->
        <div class="">
                <sub-category-type-modal
                    :sub_category_id="sub_category_id"
                ></sub-category-type-modal>
        </div>

        <div class="">
                <form class="form-floating">
                    <input type="email" class="form-control border-0" id="floatingInputValue" placeholder="name@example.com" value="">
                    <label class="fs-5 text-black-50" for="floatingInputValue">
                        Elanını başlığı
                        <span class="text-danger text-opacity-75">*</span>
                    </label>
                </form>
        </div>

        <div class="form-check d-flex ps-2">
            <div class="col">
                <label class="form-check-label fs-5 w-100 p-3" for="new">
                    Yeni ?
                </label>
            </div>
            <div class="d-flex align-self-center">
                <input class="form-check-input p-3 me-4 my_border" type="checkbox" value="" id="new">
            </div>
        </div>

        <div class="form-check d-flex ps-2">
            <div class="col">
                <label class="form-check-label fs-5 w-100 p-3" for="goto">
                    Çatdırılma ?
                </label>
            </div>
            <div class="d-flex align-self-center">
                <input class="form-check-input p-3 me-4 my_border" type="checkbox" value="" id="goto">
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['sub_category_id'],
    data() {
        return {
           
        }
    },
    methods:{
        
    },
    mounted() {
        // console.log( 'XXXXXX = ',  this.id )
    }

}
</script>

<style scoped>
    .my_border {
        border: 1px solid #d3d0d0;
    }

    .form-check-input:checked {
        background-color: green!important;
        border: none;
    }
    .form-check-input:active {
        border: none;
    }

</style>