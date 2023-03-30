<template>
    <div class="col-12">

        <div class="background" id="success_auksiyon_fon"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
                    <div class="d-flex icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="white" class="bi bi-check-lg m-auto align-self-center" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                    <!--/.icon-->
                    <h1>Auksiyon sonlandı!</h1>
                    <p class="mt-4 mb-4 fw-bold fs-4"> Son qərar gözlənilir!</p>

                    <div class="mb-4">
                        <div @click="extendAuksiyonTime" type="button" class="btn btn-success w-75 mb-1 fs-5">Vaxtı artır</div>
                        <div type="button" class="btn btn-danger w-75 fs-5">Sonlandır</div>
                    </div>
                </div>
                <!--/.success-->
            </div>

            <div class="d-none add_on_aukcion_div">
                <add-on-aukcion
                    :product_info="product"
                ></add-on-aukcion>
            </div>
            <!--/.row-->
<!--            <div class="row">-->
<!--                <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate" style="display: none;">-->
<!--                    <div class="icon">-->
<!--                        <span class="glyphicon glyphicon-thumbs-down"></span>-->
<!--                    </div>-->
<!--                    &lt;!&ndash;/.icon&ndash;&gt;-->
<!--                    <h1>Oh no!</h1>-->
<!--                    <p>Oops! Something went wrong,-->
<!--                        <br> you should try again.</p>-->
<!--                    <button type="button" class="redo btn">Try again</button>-->
<!--                    <span class="change">&#45;&#45; Click to see opposite state &#45;&#45;</span>-->
<!--                </div>-->
<!--                &lt;!&ndash;/.success&ndash;&gt;-->
<!--            </div>-->
            <!--/.row-->
        </div>

    </div>
</template>

<script>
export default {
    name: "AukcionСompletion",
    props:['product','auksiyon','stop_auksiyon'],
    data() {
        return {
            product_id: this.getProductID(),
            extend_tmie: null,
            is_product: null,
        }
    },
    methods:{
        extendAuksiyonTime() {
            let auksiyon_button = setInterval( () => {
                let auksiyon_add_button = document.getElementsByClassName('auksiyon_add_button');
                let add_on_aukcion_div  = document.getElementsByClassName('add_on_aukcion_div');
                let auksion_completion  = document.getElementsByClassName('modalbox');
                let fon = document.getElementById('fon');
                let body = document.body;

                if( body && auksiyon_add_button && add_on_aukcion_div && auksion_completion && fon ) {
                    if( auksiyon_add_button[0] && add_on_aukcion_div[0] && auksion_completion[0] && fon ) {
                        auksion_completion[0].style.display = 'none';
                        fon.style.display = 'none';
                        body.style = 'overflow: none';

                        setTimeout( () => {
                            auksiyon_add_button[0].click();
                        }, 100 );
                    }

                    clearInterval(auksiyon_button);
                }

            }, 0.1);

            setTimeout( () => {
                clearInterval(auksiyon_button)
            }, 30000);
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        getSuccessModal() {
            // document.ready(function() {
            let redo = document.getElementsByClassName('redo');
            let success = document.getElementsByClassName('success');

            if( redo && redo[0] && success && success[0] ) {
                redo[0].click( function() {
                    success[0].toggle();
                });
            }
        }
    },
    computed: {
        hideAuksiyonAddButton() {
            let auksiyon_button = setInterval( () => {
                let fon = document.getElementById('fon');
                let auksiyon_add_button = document.getElementsByClassName('auksiyon_add_button');
                let add_on_aukcion_div = document.getElementsByClassName('add_on_aukcion_div');
                let body = document.body;

                if( body && auksiyon_add_button && auksiyon_add_button[0] && add_on_aukcion_div && add_on_aukcion_div[0] ) {
                    auksiyon_add_button[0].style = 'display:none: position: absolute; opacity: 0; z-index: -1;';

                    body.style = 'overflow: hidden;';
                    fon.style.display = 'block';

                    setTimeout( () => {
                        if ( add_on_aukcion_div && add_on_aukcion_div[0] && add_on_aukcion_div[0].classList ) {
                            add_on_aukcion_div[0].classList.remove('d-none');
                            add_on_aukcion_div[0].classList.add('d-block');
                            add_on_aukcion_div[0].style.width = '0px'
                            add_on_aukcion_div[0].style.height = '0px'
                        }
                    }, 1000 );

                    clearInterval(auksiyon_button);
                }
            }, 0.1);
        },
    },
    mounted() {
        this.hideAuksiyonAddButton;
        this.getSuccessModal();

        let auksiyon_add_button = document.getElementsByClassName('auksion_completion')

        console.log("BBBBBBBBBBFFFFFHHHHHKKK - ", auksiyon_add_button[0] );

    }
}
</script>

<style scoped>

.modalbox.success,
.modalbox.error {
    position: absolute;
    //box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    box-shadow: 0 4px 15px -1px #333232;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    background: #fff;
    padding: 25px 25px 15px;
    text-align: center;
    z-index: 101;
}

.modalbox.success.animate .icon,
.modalbox.error.animate .icon {
    -webkit-animation: fall-in 0.75s;
    -moz-animation: fall-in 0.75s;
    -o-animation: fall-in 0.75s;
    animation: fall-in 0.75s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.modalbox.success h1,
.modalbox.error h1 {
    font-family: 'Montserrat', sans-serif;
}

.modalbox.success p,
.modalbox.error p {
    font-family: 'Open Sans', sans-serif;
}

.modalbox.success button,
.modalbox.error button,
.modalbox.success button:active,
.modalbox.error button:active,
.modalbox.success button:focus,
.modalbox.error button:focus {
    -webkit-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    margin-top: 15px;
    width: 80%;
    background: transparent;
    color: #4caf50;
    border-color: #4caf50;
    outline: none;
}

.modalbox.success button:hover,
.modalbox.error button:hover,
.modalbox.success button:active:hover,
.modalbox.error button:active:hover,
.modalbox.success button:focus:hover,
.modalbox.error button:focus:hover {
    color: #fff;
    background: #4caf50;
    border-color: transparent;
}

.modalbox.success .icon,
.modalbox.error .icon {
    position: relative;
    margin: 0 auto;
    margin-top: -75px;
    background: #4caf50;
    height: 100px;
    width: 100px;
    border-radius: 50%;
}

.modalbox.success .icon span,
.modalbox.error .icon span {
    postion: absolute;
    font-size: 4em;
    color: #fff;
    text-align: center;
    padding-top: 20px;
}

.modalbox.error button,
.modalbox.error button:active,
.modalbox.error button:focus {
    color: #f44336;
    border-color: #f44336;
}

.modalbox.error button:hover,
.modalbox.error button:active:hover,
.modalbox.error button:focus:hover {
    color: #fff;
    background: #f44336;
}

.modalbox.error .icon {
    background: #f44336;
}

.modalbox.error .icon span {
    padding-top: 25px;
}

.center {
    float: none;
    margin-left: auto;
    margin-right: auto;
    /* stupid browser compat. smh */;
}

.center .change {
    clearn: both;
    display: block;
    font-size: 10px;
    color: #ccc;
    margin-top: 10px;
}

@-webkit-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-moz-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-o-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-webkit-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-moz-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-o-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 25%;
    }
}

@-moz-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-webkit-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-o-keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@keyframes fall-in {
    0% {
        -ms-transform: scale(3, 3);
        -webkit-transform: scale(3, 3);
        transform: scale(3, 3);
        opacity: 0;
    }

    50% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 1;
    }

    60% {
        -ms-transform: scale(1.1, 1.1);
        -webkit-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1);
    }

    100% {
        -ms-transform: scale(1, 1);
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
    }
}

@-moz-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@-webkit-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@-o-keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}

@keyframes plunge {
    0% {
        margin-top: -100%;
    }

    100% {
        margin-top: 15%;
    }
}
</style>
