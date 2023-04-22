require('./bootstrap');

import OnAukcionProduct from "./components/elements/OnAukcionProduct";

import { createApp } from 'vue';
let app=createApp({});

import VueAxios from 'vue-axios';
import axios from 'axios';

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import vue3PhotoPreview from 'vue3-photo-preview';
import 'vue3-photo-preview/dist/index.css';

import LitepieDatepicker from 'litepie-datepicker';
app.use(LitepieDatepicker);

app.use(VueAxios, axios);
app.use(vue3PhotoPreview);

import example from './components/ExampleComponent.vue';
import RealTimeAuksiyon from './components/pages/RealTimeAuksiyon.vue';
import AukcionUserInfoModal from './components/elements/AukcionUserInfoModal.vue';
import AuksionUserReitingInfoModal from './components/elements/AuksionUserReitingInfoModal.vue';
import AukcionUserOffersModal from './components/elements/AukcionUserOffersModal.vue';
import AukcionContionue from './components/crumbs/AukcionContionue.vue';
import AukcionNegotiation from './components/crumbs/AukcionNegotiation.vue';
import AukcionСompletion from './components/crumbs/AukcionСompletion.vue';
import OnAukcion from './components/elements/OnAukcionProduct.vue';
import NewAnnounceUserInfo from './components/elements/NewAnnounceUserInfo.vue';
import ProductShow from './components/announce/products/ProductShow.vue';
import NewAnnounce from './components/announce/new/NewAnnounce.vue';
import ModalCategory from './components/announce/new/modals/ModalCategory.vue';
import ModalShowCategoryElements from './components/announce/new/modals/ModalShowCategoryElements.vue';
import AnnounceNewTopSection from './components/announce/new/crumbs/AnnounceNewTopSection.vue';
import AnnounceNewModalPrice from './components/announce/new/modals/AnnounceNewModalPrice.vue';
import AnnounceNewModalCity from './components/announce/new/modals/AnnounceNewModalCity.vue';
import AnnounceNewModalAbout from './components/announce/new/modals/AnnounceNewModalAbout.vue';
import NewImageUpload from './components/announce/new/category/elektronika/audiovevideo/crumbs/NewImageUpload.vue';

// CATEGORY
import VerticalAllCatalogElement from './components/announce/new/category/modals/VerticalAllCatalogElement.vue';

// ELEKTRONIKA AUDIO VE VIDEO FOLDER
import SubCategoryTypeModal from './components/announce/new/category/elektronika/audiovevideo/modals/SubCategoryTypeModal.vue';
import AudioVeVideo from './components/announce/new/category/elektronika/audiovevideo/AudioVeVideo.vue';
import IndexAudioVeVideo from './components/announce/new/category/elektronika/audiovevideo/IndexAudioVeVideo.vue';

// PRODUCTS
import ShowForPhoneScreen from './components/announce/products/crumbs/ShowForPhoneScreen.vue';
import ShowForDesktopScreen from './components/announce/products/crumbs/ShowForDesktopScreen.vue';

// ADD ON AUKCION START
import AddOnAukcion from "./components/auksiyon/modals/AddOnAukcion.vue";
import CurrentTimeAukcion from "./components/announce/new/modals/CurrentTimeAukcion.vue";
import LaterTimeAukcion from "./components/announce/new/modals/LaterTimeAukcion.vue";

//elements
import AudioVeVideoElement from "./components/auksiyon/elements/AudioVeVideoElement.vue";
// ADD ON AUKCION END

// DATA and TIME PICKER
import DataPicker from "./components/announce/new/modals/DataPicker.vue";
import TimePicker from "./components/announce/new/modals/TimePicker.vue";
import OnTimeAukcion from "./components/announce/new/modals/OnTimeAukcion.vue";
import OnLaterTimeAukcion from "./components/announce/new/modals/OnLaterTimeAukcion.vue";

// Push verification
import Push from "./components/auksiyon/push/Push.vue";


app.component('example-component' , example);
app.component('real-time-auksiyon' , RealTimeAuksiyon);
app.component('auksion-user-info-modal' , AukcionUserInfoModal);
app.component('auksion-user-reiting-modal' , AuksionUserReitingInfoModal);
app.component('auksion-user-offers-modal' , AukcionUserOffersModal);
app.component('auksion-continue' , AukcionContionue);
app.component('auksion-negotiation' , AukcionNegotiation);
app.component('auksion-completion' , AukcionСompletion);
app.component('on-aukcion-product' , OnAukcionProduct);
app.component('new-announce-user-info' , NewAnnounceUserInfo);
app.component('product-show' , ProductShow);
app.component('new-announce' , NewAnnounce);
app.component('modal-category' , ModalCategory);
app.component('modal-show-category-elements' , ModalShowCategoryElements);
app.component('announce-new-top-elements' , AnnounceNewTopSection);
app.component('announce-new-modal-price' , AnnounceNewModalPrice);
app.component('announce-new-modal-city' , AnnounceNewModalCity);
app.component('announce-new-modal-about' , AnnounceNewModalAbout);

// CATEGORY
app.component('vertical-all-catalog-element' , VerticalAllCatalogElement);

// ELEKTRONIKA AUDIO VE VIDEO FOLDER
app.component('sub-category-type-modal' , SubCategoryTypeModal);
app.component('audio-ve-video' , AudioVeVideo);
app.component('index-audio-ve-video' , IndexAudioVeVideo);
app.component('new-image-upload' , NewImageUpload);

//  PRODUCTS
app.component('show-for-phone-screen' , ShowForPhoneScreen);
app.component('show-for-desktop-screen' , ShowForDesktopScreen);

// ADD ON AUKCION START
app.component('add-on-aukcion', AddOnAukcion);
app.component('current-time-aukcion', CurrentTimeAukcion);
app.component('later-time-aukcion', LaterTimeAukcion);

// elements
app.component('audio-ve-video-element', AudioVeVideoElement);
// ADD ON AUKCION END

// DATA PICKER
app.component('data-picker', DataPicker);
app.component('time-picker', TimePicker);
app.component('on-time-aukcion', OnTimeAukcion);
app.component('on-later-time-aukcion', OnLaterTimeAukcion);

//AUKSIYON
app.component('push', Push);


app.mount("#app")
