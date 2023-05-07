
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

export default {
    methods: {
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
