<template>
    <div class="">
        <svg id="successAnimation" class="d-flex animated" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 70 70">
            <path id="successAnimationResult" fill="#40a91b" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
            <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
            <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
        </svg>

<!--        <div class="" id="title">-->
<!--            <div v-if="success_title" class="animated fw-bold fs-4 text-black-50">{{ success_title }}</div>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    name: "Success",
    props:['add_auksiyon','success_title'],
    data() {
        return {

        }
    },
    watch:{
        add_auksiyon() {
            if( this.add_auksiyon ) document.location.href = '/product/'+Number( this.getProductID() );
        },
    },
    methods: {
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
    },
    mounted() {

        let inter = setInterval(  () => {
            console.log('SSSSSSSSSSSSSSSSSSSS = ', 'yes' )

            let animation = document.getElementById('successAnimation');
            let restart = document.getElementById('replay');

            if( animation ) clearInterval(inter);

            animation.classList.remove('animated');
            void animation.parentNode.offsetWidth;
            animation.classList.add('animated');
        }, 0.1)

    }
}
</script>

<style scoped>

html, body {
    height: 100%;
}
body {
    align-items: center;
    background-color: #35297b;
    display: flex;
    justify-content: center;
}
@keyframes scaleAnimation {
    0% {
        opacity: 0;
        transform: scale(1.5);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
@keyframes drawCircle {
    0% {
        stroke-dashoffset: 151px;
    }
    100% {
        stroke-dashoffset: 0;
    }
}
@keyframes drawCheck {
    0% {
        stroke-dashoffset: 36px;
    }
    100% {
        stroke-dashoffset: 0;
    }
}
@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
#successAnimationCircle {
    stroke-dasharray: 151px 151px;
    stroke: #fff;
}
#successAnimationCheck {
    stroke-dasharray: 36px 36px;
    stroke: #fff;
}
#successAnimationResult {
    fill: #52be24;
    opacity: 0;
}
#successAnimation.animated {
    animation: 1s ease-out 0s 1 both scaleAnimation;
}
#successAnimation.animated #successAnimationCircle {
    animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
}
#successAnimation.animated #successAnimationCheck {
    animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
}
#successAnimation.animated #successAnimationResult {
    animation: 0.3s linear 0.9s both fadeIn;
}
#replay {
    background: rgba(255, 255, 255, 0.2);
    border: 0;
    border-radius: 3px;
    bottom: 100px;
    color: #fff;
    left: 50%;
    outline: 0;
    padding: 10px 30px;
    position: absolute;
    transform: translateX(-50%);
}
#replay:active {
    background: rgba(255, 255, 255, 0.1);
}

</style>
