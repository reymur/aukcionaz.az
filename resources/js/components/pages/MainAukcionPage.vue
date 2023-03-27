<template>
    <div class="root">
        <div class="col-12">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 m-auto">
                <div class="aukcion__product-div">
                    <on-aukcion-product
                        :product="product"
                    ></on-aukcion-product>
                </div>

                <!--Real time actions table-->
                <div class="card">
                    <h5 class="card-header bg-transparent p-0">
                        <auksion-completion></auksion-completion>
                    </h5>

                    <div class="card-body py-3">
                        <h5 class="card-title m-0">Ən yüksək məbləğ:</h5>
                    </div>

                    <h5 class="card-footer col-12 d-flex">
                        <input v-model="price" type="text" class="form-control me-2">
                        <button v-on:click="addPrice" class="btn btn-success">
                            Qiymet
                        </button>
                    </h5>
                </div>

                <div class="col-12 ul__parent-div" v-bind:style="{height: ( 4 * 62) + 'px', overflow:'scroll'}">

                    <ul class="list-group" v-if="aukcionUsers.length > 5">
                        <li class="moving-item" v-for="user in aukcionUsers" :id="user.id" v-bind:style="{ top: (user.position * 62) + 'px'}">
                            <div class="col-12 d-flex">
                                <div class="col-9">
                                    <div class="col-12 d-flex aukcion__text-info">
                                        <div class="col-10 aukcion__text-name">{{ user.user.name }} </div>
                                    </div>

                                    <div class="col-12 justify-content-center d-flex user__sub-titles">
                                        <div class="col-3"
                                             type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserReitionInfo'+user.id">

                                            Reytinq
                                            <span class="badge badge-success bg-primary">
                                                5
                                            </span>
                                            <auksion-user-reiting-modal :id="user.id"></auksion-user-reiting-modal>
                                        </div>

                                        <div class="col-4"
                                             type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserInfoModal'+user.id">

                                            Auksiyon
                                            <span class="badge badge-success bg-primary">
                                                9
                                            <span class="">/</span>
                                                4
                                            </span>

                                            <auksion-user-info-modal :id="user.id"></auksion-user-info-modal>
                                        </div>

                                        <div class="col-3"
                                             type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserOffersModal'+user.id">

                                            Təkliflər
                                            <span class="badge badge-danger bg-danger">
                                                1
                                            </span>

                                            <auksion-user-offers-modal :id="user.id"></auksion-user-offers-modal>
                                        </div>
                                    </div>
                                </div>

                                <!--Price-->
                                <div class="col-3 d-flex">
                                    <div class="col-8 text-center aukcion__price-text">
                                <span class=" aukcion__price-text-style">
                                     {{ user.price }}
                                </span>
                                    </div>

                                    <div class="col-4 aukcion__user-delete-div" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </div>
                                </div>
                    </div>
                        </li>
                    </ul>
                    <ul class="list-group" v-else>
                        <li class="moving-item" v-for="user in aukcionUsers" :id="user.id" v-bind:style="{ top: (user.position * 62) + 'px'}">
                            <div class="col-12 d-flex">
                                <div class="col-9">
                                    <div class="col-12 d-flex aukcion__text-info">
                                        <div class="col-10 aukcion__text-name">{{ user.user.name ?? '' }} </div>
                                    </div>

                                    <div class="col-12 justify-content-center d-flex user__sub-titles">
                                        <div class="col-3"
                                             type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserReitionInfo'+user.id">

                                            Reytinq
                                            <span class="badge badge-success bg-primary">
                                                5
                                            </span>

                                            <auksion-user-reiting-modal :id="user.id"></auksion-user-reiting-modal>
                                        </div>

                                        <div class="col-4"
                                            type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserInfoModal'+user.id">

                                            Auksiyon
                                            <span class="badge badge-success bg-primary">
                                                9
                                                <span class="">/</span>
                                                4
                                            </span>

                                            <auksion-user-info-modal :id="user.id"></auksion-user-info-modal>
                                        </div>

                                        <div class="col-3"
                                             type="button" data-bs-toggle="modal" :data-bs-target="'#auksionUserOffersModal'+user.id">

                                            Təkliflər
                                            <span class="badge badge-danger bg-danger">
                                                1
                                            </span>

                                            <auksion-user-offers-modal :id="user.id"></auksion-user-offers-modal>
                                        </div>
                                    </div>
                                </div>

                                <!--Price-->
                                <div class="col-3 d-flex">
                                    <div class="col-8 text-center aukcion__price-text">
                                <span class=" aukcion__price-text-style">
                                     {{ user.price }}
                                </span>
                                    </div>

                                    <div class="col-4 aukcion__user-delete-div" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </div>
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

export default {
    props:['users','product'],
    components: {

    },
    data() {
        return {
            model2: false,
            price: '',
            reverse: 1,
            aukcionUsers: [],
            showContionue: true,
            showNegotiation: false,
            showCompletion: false,
        }
    },
    watch: {
        users: val => {

            console.log("watch === ", this.users)
        },
        handleClick () {
            this.model2 = true
        }
    },
    methods: {
        addPrice() {
            axios.post('/set-aukcion-price', {price: this.price})
                .then(res => {
                    this.aukcionUsers = res.data.users
                    // console.log('Relarion = ', this.aukcionUsers)
                    this.upPrice()
                    console.log("RES2 === ", res.data.users)
                }).catch(err => {
                    console.log("ERROR2 === ", err)
                })
        },
        upPrice: function () {
            var self = this;
            self.reverse = self.reverse * -1

            let newItems = self.aukcionUsers.slice().sort(function (a, b) {
                return b.price - a.price;
            })

            newItems.forEach(function (item, index) {
                item.position = index;
            });
        },
    },
    computed: {

    },
    mounted() {
        axios.post('/get-auksion-users')
            .then(res => {
                this.aukcionUsers = res.data.users
                console.log('RELATIONS222 = ', res.data.users )
                this.upPrice();
            }).catch(err => {
            console.log("ERROR2 === ", err)
        })

        console.log("UUUUUUU === ", this.users )
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
    background-color: #fff;
}
.aukcion__text-info {
    margin: 4px 0 2px 10px;
}
.aukcion__text-name {
    font-size: 18px;
}
.aukcion__price-text {
    font-size: 18px;
}
.aukcion__price-text-style {
    background-color: #830e02;
    color: white;
    letter-spacing: 1px;
    font-weight: 600;
    padding: 16px 0 13px 0;
    display: block;
}
    .user__sub-titles {
        margin: -5px 0 0 -12px;
    }

.aukcion__user-delete-div {
    color: #fff;
    background-color: #262525;
    margin: 0 0 0 1px;
    border-radius: 0 5px 5px 0;
    padding: 16px 13px 19px 12px;
}
    .aukcion__user-delete {
        padding: 17px 21px 18px 21px;
    }
.ul__parent-div {
    padding: 10px 10px 10px 10px;
    background-color: #f3f0f0;
}

.aukcion__product-div {
    background-color: #eaeaea;
    border-bottom: 1px solid rgb(207 207 207 / 44%);
    box-shadow: 0 0 8px 2px rgb(94 92 92 / 19%);
}
</style>
