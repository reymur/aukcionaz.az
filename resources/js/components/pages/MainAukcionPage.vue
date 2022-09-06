<template>
    <div class="root">
        <div class="col-12">
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 m-auto">
                <div class="col-12 d-flex mb-3">
                    <input v-model="price" type="text" class="form-control me-2">
                    <button v-on:click="addSum" class="btn btn-success">
                        Qiymet
                    </button>
                </div>

                <div class="col-12 d-flex mb-3">
                    <auksion-continue v-if="showContionue"> </auksion-continue>
                    <auksion-negotiation v-if="showNegotiation"> </auksion-negotiation>
                    <auksion-completion v-if="showCompletion"> </auksion-completion>
                </div>

                <div class="col-12 bg-black">
                    <ul class="list-group">
                        <li class="moving-item" v-for="user in aukcionUsers" :id="user.id" v-bind:style="{ top: (user.position * 62) + 'px'}">
                            <div class="col-12 d-flex aukcion__text-info">
                                <div class="col-10 aukcion__text-name">{{ user.name }} </div>

                                <div class="col-2 text-center aukcion__price-text">
                                    <span class=" aukcion__price-text-style">
                                         {{ user.sum }}
                                    </span>
                                </div>

                                <div class="col-2 aukcion__user-delete-div">
                                    <div class="aukcion__user-delete" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-11 justify-content-center d-flex user__sub-titles">
                                <div class="col-2"
                                     type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserReitionInfo'+user.id">

                                    Reytinq
                                    <span class="badge badge-success bg-primary">
                                        5
                                    </span>
                                    <auksion-user-reiting-modal :id="user.id"></auksion-user-reiting-modal>
                                </div>

                                <div class="col-3"
                                     type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserInfoModal'+user.id">

                                    Auksiyon
                                    <span class="badge badge-success bg-primary">
                                        9
                                        <span class="">/</span>
                                        4
                                    </span>

                                    <auksion-user-info-modal :id="user.id"></auksion-user-info-modal>
                                </div>

                                <div class="col-2"
                                     type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserOffersModal'+user.id">

                                    Təkliflər
                                    <span class="badge badge-danger bg-danger">
                                        1
                                    </span>

                                    <auksion-user-offers-modal :id="user.id"></auksion-user-offers-modal>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import { SlickList, SlickItem } from 'vue-slicksort';

export default {
    components: {
        SlickItem,
        SlickList,
    },
    data() {
        return {
            price: '',
            reverse: 1,
            aukcionUsers: [],
            showContionue: false,
            showNegotiation: false,
            showCompletion: true,
        }
    },
    watch: {
        users: val => {

            console.log("watch === ", this.users)
        }
    },
    methods: {
        addSum() {
            axios.post('/sum', {sum: this.price})
                .then(res => {
                    this.aukcionUsers = res.data.users
                    this.upPrice()
                }).catch(err => {
                    console.log("ERROR === ", err)
                })
        },
        upPrice: function () {
            var self = this;
            self.reverse = self.reverse * -1

            let newItems = self.aukcionUsers.slice().sort(function (a, b) {
                return b.sum - a.sum;
            })

            newItems.forEach(function (item, index) {
                item.position = index;
            });

            // console.log('AAAAAAa1 = ', self.items[0] )
        },
    },
    mounted() {
        axios.post('/get-auksion-users')
            .then(res => {
                this.aukcionUsers = res.data.users
                this.upPrice();
            }).catch(err => {
            console.log("ERROR === ", err)
        })

        console.log('Math.max = ', this.aukcionUsers)
        // console.log('Math.max = ', Math.max(this.aukcionUsers) )
        // console.log('ELEM = ', document.getElementsByTagName('li') )
    }
}
</script>

<style scoped>
.moving-item {
    transition: all 1s ease;
    -webkit-transition: all 500ms ease;
}
ul {
    list-style-type: none;
    padding: 0;
    position: relative;
}
li {
    position: absolute;
    border: 1px solid #d0cfcf;
    border-radius: 7px;
    height: 60px;
    width: 100%;
    /*padding: 5px;*/
    color: #363636;
}
.aukcion__text-info {
    margin: 4px 0 2px 10px;
}
.aukcion__text-name {
    font-size: 18px;
}
.aukcion__price-text {
    font-size: 18px;
    position: absolute;
    height: 58px;
    margin: -4px 0 0 393px;
}
.aukcion__price-text-style {
    background-color: #830e02;
    margin: 0;
    display: block;
    padding: 15px;
    color: white;
    letter-spacing: 1px;
    font-weight: 600;
    border: none;
}
    .user__sub-titles {
        margin: -5px 0 0 -12px;
    }

.aukcion__user-delete-div {
    width: 0;
    background-color: #1e1e1e;
    position: absolute;
    margin: -4px 0 0 484px;

}
    .aukcion__user-delete {
        margin: 0 0 0 0;
        position: absolute;
        padding: 17px 14px 19px 15px;
        background-color: #1e1e1e;
        border-radius: 0 5px 5px 0;
        color: #fff;
    }

</style>
