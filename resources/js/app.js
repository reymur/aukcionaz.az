require('./bootstrap');

window.Vue = require('vue').default;

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-aukcion-page', require('./components/pages/MainAukcionPage.vue').default);
Vue.component('auksion-user-info-modal', require('./components/elements/AukcionUserInfoModal.vue').default);
Vue.component('auksion-user-reiting-modal', require('./components/elements/AuksionUserReitingInfoModal.vue').default);
Vue.component('auksion-user-offers-modal', require('./components/elements/AukcionUserOffersModal.vue').default);
Vue.component('auksion-continue', require('./components/crumbs/AukcionContionue.vue').default);
Vue.component('auksion-negotiation', require('./components/crumbs/AukcionNegotiation.vue').default);
Vue.component('auksion-completion', require('./components/crumbs/AukcionСompletion').default);

Vue.use(VueAxios, axios);

const app = new Vue({
    el: '#app',
});
