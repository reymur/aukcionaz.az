<template>
    <div class="">
        <!-- ANNOUNCE NEW NEW ABOUT -->
        <ul class="list-group">
            <li class="list-group-item shadow-sm col-12 d-flex border-0 pt-2 pb-0">
                <div class="col-6 d-inline-flex text-black-50 fs-5">
                    Məzmun
                </div>
            </li>

            <li class="col-12 list-group-item shadow-sm d-flex border-0 px-3 pb-3">
                <div class="col-12 text-black-50 fs-5">
                    <textarea
                        class="form-control"
                        placeholder='Elan haqqında məlumat yazarkən qiymət yazmayın, qiymət üçün yuxarıda "Qiymət" xanəsi qeyd edilib...'
                        id="floatingTextarea2"
                        style="height: 100px"
                        v-model="about"
                    ></textarea>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            about: null,
        }
    },
    watch: {
        about() {
            this.$emit('sendAboutToNewAnnounceComponent', {
                about: this.about
            })
        }
    },
}
</script>

<style>
    .form-control:focus, .form-control:active {
        outline: none;


        box-shadow: none !important;

    }
</style>
