require('./bootstrap');

import moment from "moment";
import VueRouter from "vue-router";
import Index from './Index';
import router from './routes';
import StarRating from './shared/components/StarRating';
import FatalError from './shared/components/FatalError';
import ValidationErrors from './shared/components/ValidationErrors';
import Success from './shared/components/Success';

window.Vue = require('vue').default;
Vue.use(VueRouter);

Vue.filter('fromNow', value => moment(value).fromNow());

Vue.component('star-rating', StarRating);
Vue.component('fatal-error', FatalError);
Vue.component('v-errors', ValidationErrors);
Vue.component('success', Success)

const app = new Vue({
    el: '#app',
    router,
    components: {
        'index': Index,
    }
});
