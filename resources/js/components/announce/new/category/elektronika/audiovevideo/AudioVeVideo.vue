<template>
    <div class="" id="new-announce-category">
        <!-- Button trigger modal -->
        <div class="">
            <sub-category-type-modal
                :sub_category_id="sub_category_id"
                @sendSubCategoryTypeNameToAudioVeVideoComponent="getSubCategoryTypeNameFromSubCategoryTypeComponent"
            ></sub-category-type-modal>
        </div>

        <div class="px-2">
            <form class="form-floating">
                <input
                    v-model="announce_title"
                    type="text"
                    class="form-control pb-0 rounded-0 fs-5"
                    id="title"
                    placeholder="Elanını başlığı"
                >
                <label class="fs-5 text-black-50" for="title">
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
                <input class="form-check-input p-3 me-4 my_border" type="checkbox" value="new" v-model="checkBoxElem" id="new">
            </div>
        </div>

        <div class="form-check d-flex ps-2">
            <div class="col">
                <label class="form-check-label fs-5 w-100 p-3" for="goto">
                    Çatdırılma ?
                </label>
            </div>
            <div class="d-flex align-self-center">
                <input class="form-check-input p-3 me-4 my_border" type="checkbox" value="delivery" v-model="checkBoxElem" id="goto">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['sub_category_id'],
    data() {
        return {
            announce_title: '',
            checkBoxElem: [],
        }
    },
    watch: {
        announce_title() {
            this.$emit('sendAnnounceTitleToNewAnnounceComponent', {
                announce_title: this.announce_title
            })
        },
        checkBoxElem() {
            this.$emit('sendCheckBoxVarsToNewAnnounceComponent', {
                checkBox: this.checkBoxElem
            })
        }
    },
    methods:{
        getSubCategoryTypeNameFromSubCategoryTypeComponent(data){
            if( data !== undefined && data.name !== undefined ) {
                this.$emit('sendSubCategoryTypeNameToIndexAudioVeVideoComponent', {
                    name: data.name,
                })
            }
        }
    },
    mounted() {
        // console.log( 'sub_category_id =-- ',  this.sub_category_id )
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

    .form-control {
        border: none;
        padding-bottom: 0;
    }
    .form-control:focus, .form-control:active {
        outline: none;
        border-bottom: 1px solid #000;
        box-shadow: none !important;

    }
</style>
