<template>
   <div class="">
        <!-- ANNOUNCE NEW ORICE -->
        <ul class="list-group">
            <li class="list-group-item col-12 d-flex border-0 pt-0 px-3">
                <div class="me-4 m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22 " fill="gray" class="bi bi-tag-fill" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </div>

                <div class="col text-black-50 ">
                    <div class="form-floating">
                        <input
                            class="form-control pb-0 rounded-0 bg-white fs-5"
                            placeholder="Qiymət"
                            v-model="price"
                            v-maska="'##################################'"
                            :tokens="hexTokens"
                        >
                        <label for="floatingInput"  class="text-secondary ps-0 fs-5">
                            Qiymət, AZN
                                <span class="text-danger text-opacity-75">*</span>
                        </label>
                    </div>
                </div>
            </li>
        </ul>
   </div>
</template>

<script>
import { maska } from 'maska'

export default {
    directives: { maska },
    data() {
        return {
            price: null,
            hexTokens: {
                F: {
                    pattern: /[0-9]/,
                    // transform: v => v.toLocaleUpperCase()
                }
            }
        }
    },
    watch: {
        price() {
            this.$emit('sendPriceToNewAnnounceComponent', {
                price: this.price
            });
        }
    },
    methods: {

    }
}
</script>

<style scoped>

    .form-control:focus, .form-control:active {
        outline: none;
        border-bottom: 1px solid #000;
        box-shadow: none !important;
        padding-bottom: 0;
    }

    .form-control {
        border: none;
        padding-bottom: 0;
    }

</style>
