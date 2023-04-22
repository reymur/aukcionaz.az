
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

export default {
    methods: {
        callNotification( type, message, duration, dismiss, background, horizontal,vertical) {
            let makeNotify = new Notyf({
                duration:duration,
                position:{x: horizontal, y: vertical},
                types: [{type:type, icon: { className: 'material-icons', tagName: 'i', text: 'warning'}}]
            });
            makeNotify.open({ type:type,  message:message,dismissible: dismiss, background:background });
        },
        getUserPrice( user, all_gamers ) {
            if( user && user.id && all_gamers && (all_gamers.length > 0)  ) {
                for (let i = 0; i < all_gamers.length; i++) {
                    if( all_gamers[i] && all_gamers[i].user_id && (all_gamers[i].user_id === user.id) )
                        return all_gamers[i].price;
                }
            }

            return false;
        }
    }
}
