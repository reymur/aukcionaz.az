import OnAukcionProduct from "./components/elements/OnAukcionProduct";

require('./bootstrap');

import { createApp } from 'vue';
let app=createApp({})

import VueAxios from 'vue-axios';
import axios from 'axios';

import vue3PhotoPreview from 'vue3-photo-preview';
import 'vue3-photo-preview/dist/index.css';

app.use(VueAxios, axios);
app.use(vue3PhotoPreview);

import example from './components/ExampleComponent.vue';
import MainAukcionPage from './components/pages/MainAukcionPage.vue';
import AukcionUserInfoModal from './components/elements/AukcionUserInfoModal.vue';
import AuksionUserReitingInfoModal from './components/elements/AuksionUserReitingInfoModal.vue';
import AukcionUserOffersModal from './components/elements/AukcionUserOffersModal.vue';
import AukcionContionue from './components/crumbs/AukcionContionue.vue';
import AukcionNegotiation from './components/crumbs/AukcionNegotiation.vue';
import AukcionСompletion from './components/crumbs/AukcionСompletion.vue';
import OnAukcion from './components/elements/OnAukcionProduct.vue';

app.component('example-component' , example);
app.component('main-aukcion-page' , MainAukcionPage);
app.component('auksion-user-info-modal' , AukcionUserInfoModal);
app.component('auksion-user-reiting-modal' , AuksionUserReitingInfoModal);
app.component('auksion-user-offers-modal' , AukcionUserOffersModal);
app.component('auksion-continue' , AukcionContionue);
app.component('auksion-negotiation' , AukcionNegotiation);
app.component('auksion-completion' , AukcionСompletion);
app.component('on-aukcion-product' , OnAukcionProduct);

app.mount("#app")
