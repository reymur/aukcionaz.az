<template>
    <div class="">
        <div class="col-12 d-flex justify-content-center">
            <div class="col-4">
                <div class="form-floating">
                    <select v-model="horus" class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                        <option value="0" selected> 00 </option>
                        <option v-for="h of 23" :value="h">
                            <span v-if="h > 0" class="">{{ h }} saat</span>
                        </option>
                    </select>
                    <label for="floatingSelectGrid">Saat</label>
                </div>
            </div>

            <div class="col-4">
                <div class="form-floating">
                    <select v-model="minute"  class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                        <option value="0" selected> 00 </option>
                        <option v-for="m of 59" :value="m"> {{ m }} dəyqə </option>
                    </select>
                    <label for="floatingSelectGrid"> Dəyqə </label>
                </div>
            </div>
        </div>

        <button v-if="!add_time_loading" @click="addTime" type="button" class="waviy col-8 btn btn-success mt-3" style="--i:1">
            <span class="d-flex text-white fs-5 justify-content-center">
                Vaxtı artır
            </span>
        </button>
        <button v-else type="button" class="waviy col-8 btn btn-success mt-3" style="--i:1" disabled>
            <span class="d-flex justify-content-center">
                <div class="spinner-grow text-light me-1" role="status"></div>
                <span class="text-white fs-5"> Gözləyin... </span>
            </span>
        </button>
    </div>
</template>

<script>
import addOnAukcion from "../auksiyon/modals/AddOnAukcion.vue";
import AuksiyonRepeatMethods from "../auksiyon/mixins/AuksiyonRepeatMethods";

export default {
    name: "AddAuksiyonTime",
    mixins:[AuksiyonRepeatMethods],
    data() {
        return {
            product_id: this.getProductID(),
            horus:0,
            minute:0,
        }
    },
    watch:{
        add_time_loading() {
            if( !this.add_time_loading ) window.location.reload();
        }
    },
    methods: {
        addTime() {
            if( this.$props.user )
                this.addOnlyNowAuksiyonWithTimer(this.product_id, this.horus, this.minute);
            // else
        },
    }
}
</script>

<style scoped>

/* waviy start */
.waviy {
    position: relative;
    -webkit-box-reflect: below -20px linear-gradient(transparent, rgba(0,0,0,.2));
//font-size: 60px;
}
.waviy span {
//font-family: 'Alfa Slab One', cursive;
    position: relative;
    display: inline-block;
    color: #494848;
//text-transform: uppercase;
    animation: waviy 1s infinite;
    animation-delay: calc(.1s * var(--i));
}
@keyframes waviy {
    0%,40%,100% {
        transform: translateY(0)
    }
    20% {
        transform: translateY(-1px)
    }
}
/* waviy end*/

.time__add_waiting {
    letter-spacing: 0.5px;
    font-size: 1.4rem;
    //margin: 25px 0 35px 0;
}
</style>
