<template>
    <div class="" id="new-announce-category">
        <!-- Button trigger modal -->
        <div class="m-0 position-relative">
            <sub-category-type-modal
                :sub_category_id="sub_category_id"
                @showImageUploadSection="showImageUploadSection"
                @sendSubCategoryTypeNameToAudioVeVideoComponent="getSubCategoryTypeNameFromSubCategoryTypeComponent"
            ></sub-category-type-modal>
        </div>

        <div class="px-2 position-relative">
            <form class="form-floating" id="title-form">
                <input
                    v-model="title"
                    type="text"
                    class="form-control border-0 pb-0 rounded-0 fs-5"
                    id="title"
                    placeholder="Elanını başlığı"
                >
                <label class="fs-5 text-black-50" for="title" id="title-label">
                    Elanının başlığı
                    <span class="text-danger text-opacity-75">*</span>
                </label>
                <div class="invalid-feedback fs-6" id="title-error"> Elanının başlığı mütləqdir! </div>
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
            title: '',
            checkBoxElem: [],
        }
    },
    watch: {
        title() {
            this.$emit('sendAnnounceTitleToNewAnnounceComponent', {
                title: this.title
            })
        },
        checkBoxElem() {
            this.$emit('sendCheckBoxVarsToNewAnnounceComponent', {
                checkBox: this.checkBoxElem
            })
        }
    },
    methods:{
        showImageUploadSection(data){
            this.$emit('showImageUploadSection', data)
        },
        getSubCategoryTypeNameFromSubCategoryTypeComponent(data){
            if( data !== undefined && data.name !== undefined ) {
                this.$emit('sendSubCategoryTypeNameToIndexAudioVeVideoComponent', {
                    name: data.name,
                })
            }
        },
        subCategoryTypeInvalidTooltip() {
            let el = document.getElementById('sub_category_type_invalid_tooltip');
            if( el ) el.style.display = 'none'
        },
    },
    mounted() {
        this.subCategoryTypeInvalidTooltip();
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
