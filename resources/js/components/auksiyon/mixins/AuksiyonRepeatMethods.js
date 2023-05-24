
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import {toString} from "lodash";

export default {
    data() {
        return {
            not_user_error: null,
            add_time_loading: null,
        }
    },
    computed:{
        checkAuksiyon() {
            let product_id = this.product_id;

            if( product_id ) {
                axios({
                    method:'POST',
                    url: '/check-auksiyon',
                    data: { product_id: Number(product_id) }
                })
                    .then( res => {
                        if( res && res.data && res.data.auksiyon ) {
                            if( !res.data.auksiyon.finished && res.data.auksiyon.status  ) {
                                this.auksiyon_status = res.data.auksiyon.status;
                                // window.location.href = '/realtime/auksiyon/'+ product_id;
                            }
                            else if( res.data.auksiyon === 'no' ) {
                                this.auksiyon_status = false;
                            }

                            console.log( 'res is on auksiyon1111 - ', res.data.auksiyon )
                        }
                    })
                    .catch( err => {
                        if( err && err.response && err.response.data && err.response.data ) {
                            if( err.response.data.auksiyon === 'have not' ) {
                                this.auksiyon_status = false;
                            }
                        }
                        console.log( 'err is on auksiyon1111 - ', err.response.data )
                    });
            }

            return this.auksiyon_status;
        },
    },
    watch:{

    },
    methods: {
        addOnlyNowAuksiyonWithTimer(product_id, horus, minute) {
            this.add_time_loading = true;

            axios({
                method:'POST',
                url: '/add-only-now-auksiyon-with-timer',
                data: {
                    product_id: Number(product_id),
                    current_auksiyon_with_time_horus: horus,
                    current_auksiyon_with_time_minute: minute,
                }
            })
                .then( res => {
                    if( res && res.data && res.data.auksiyon ) {
                        if( res.data.auksiyon.status === 1 ) {
                            this.checkAuksiyon;
                            this.auksiyonTimer(res.data.auksiyon);
                            setTimeout(()=> {
                                this.add_time_loading = false;
                            },2000)

                            // window.location.reload();
                        }
                        console.log( 'res auksiyon WithTimer auksiyon - ', res.data.auksiyon )
                    }
                    console.log( 'res auksiyon WithTimer1111 - ', res )
                })
                .catch( err => {
                    this.add_time_loading = true;
                    console.log( 'err auksiyon WithTimer new - ', err );
                });
        },
        sendConfirm(name, phone, url) {
            console.log( 'DATA 2222333 - ', phone, url )
            if( phone, url) {
                axios({
                    method: "post",
                    url: url,
                    data: {
                        name: name,
                        number: phone,
                        product_id: this.getProductID(),
                        save_time: this.getCurrentTimes(),
                    },
                })
                    .then(res => {
                        if ( res && res.data && res.data.user && res.data.code && res.data.timer ) {
                            this.user = res.data.user;
                            this.code = res.data.code;
                            this.timer = res.data.timer;

                            // this.showSuccess();
                            this.success = true;
                            this.not_user_error = null;
                            console.log('send-confirmation AAA res - ', this.user ,' - ', this.code, ' - ', this.timer )
                            // console.log('send-confirmation AAA res - ', res.data.user)
                        }
                        console.log('send-confirmation res AAA 222 - ', res.data )
                    })
                    .catch(err => {
                        if( err && err.response && err.response.status && err.response.status === 419 && err.response.data.message === 'not user' ) {
                            console.log('MMMMMBBBBBBB - ', err.response.data.message )
                            this.not_user_error = Math.floor(Math.random() * 999);
                        }
                        console.log('send-confirmation err 1 AAA - ', err )
                        console.log('send-confirmation err 2 AAA - ', err.response.data)
                    })
            }
        },
        auksiyonTimer(auksiyon) {
            let timer     = this.getTimer(auksiyon);
            let current   = this.getCurrentTimes();
            let date =  Number(timer);
            // let product_name = this.auksiyon.product.productable.title;

            axios({
                method:"POST",
                url:"/auksiyon/timer",
                data: {
                    timer: Number(timer),
                    name: auksiyon.id,
                    time: date,
                    current_time: this.getCurrentTimes()
                }
            }).then( res => {
                if( res && res.data && res.data.time !== null && res.data.time !== undefined ) {
                    // date = date - res.data.time;
                    console.log("started AAAAAABBB res 111 -- === ", res.data.time )
                    // console.log("started AAAAAABBB res 111 -- === ", this.millisecondsToTime(res.data.time) )
                }
                // console.log("started AAAAAABBB res 222 -- === ", this.millisecondsToTime(res.data.time) )
            }).catch( err => {
                console.log("started AAAAAABBB err -- === ", err )
                console.log("started AAAAAA response err -- === ", err.response )
                console.log("started AAAAAA err.response.data.message err -- === ", err.response.data ?? err.response.data.message )
            });

            // console.log("BBBBBBNNNNNNNNDDDDDD - ", product_name.title )
        },
        getCurrentTimes() {
            let date    = new Date();
            let h       = Number( date.getHours() ) * 3600000;
            let m       = Number( date.getMinutes() )  * 60000;
            let s       = Number( date.getSeconds() )  * 1000;

            return (h + m + s);
        },
        getCurrentTime( clear=false ) {
            let time_i = setInterval( () => {
                let date = new Date();
                let horus = date.getHours();
                let minutes = toString(date.getMinutes());
                let seconds = toString( date.getSeconds() );
                if( minutes.length < 2 ) minutes = '0'+minutes;
                if( seconds.length < 2 ) seconds = '0'+seconds;

                this.current_time_show = horus+':'+minutes+':'+seconds;


                // console.log('COLOR - ', date.getSeconds() )
            }, 1000 );
        },
        getTimer(auksiyon_timer) {
            if( auksiyon_timer && auksiyon_timer.timer ) {
                let horus = null;
                let minute = null;
                let timer_arr = auksiyon_timer.timer.split('_');

                if( timer_arr[0] && timer_arr[1] ) {
                    horus  = Number(timer_arr[0]) * 3600000;
                    minute = Number(timer_arr[1]) * 60000;
                }

                return horus + minute;
            }
        },
        getProductID() {
            let start = window.location.pathname.lastIndexOf('/');
            let url = window.location.pathname;
            return url.substring( start + 1 );
        },
        callNotification( type, message, duration, dismiss, background, horizontal,vertical) {
            let noty_i = setInterval( () => {
                let notyf = document.getElementsByClassName('notyf');
                if( notyf && notyf.length ) clearInterval(noty_i);
                if( notyf && notyf.length > 1 ) notyf.forEach( e => e.remove() );

            }, 0.1 );

            let makeNotify = new Notyf({
                duration:duration,
                position:{x: horizontal, y: vertical},
                // types: [{type:type, icon: { className: 'material-icons', tagName: 'i', text: 'warning'}}]
            });
            makeNotify.open({ type:type,  message:message, dismissible: dismiss, background:background });
        },
        getUserAndPrice( all_gamers, valuta ) {
            if( all_gamers && (all_gamers.length > 0)  ) {
                let newItems = all_gamers.sort(function (a, b) {
                    return b.updated_at - a.updated_at;
                });

                if( newItems[all_gamers.length - 1] &&
                    newItems[all_gamers.length - 1].price &&
                    newItems[all_gamers.length - 1].price
                ) {
                    return [ newItems[all_gamers.length - 1].price, newItems[all_gamers.length - 1] ];
                }
            }
            // if( user && user.id && all_gamers && (all_gamers.length > 0)  ) {
            //     for (let i = 0; i < all_gamers.length; i++) {
            //         if( all_gamers[i] && all_gamers[i].user_id && (all_gamers[i].user_id === user.id) )
            //             return all_gamers[i].price +' '+ valuta;
            //     }
            // }

            return false;
        }
    }
}
