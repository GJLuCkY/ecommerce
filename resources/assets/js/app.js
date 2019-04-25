
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./calc');
require('./modal');
// require('./alljs');

window.Vue = require('vue');

import StarRating from 'vue-star-rating'

// Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('price-slider', require('./components/SliderPrice.vue'));
Vue.component('cart-component', require('./components/CartComponent.vue'));
Vue.component('star-rating', StarRating);

const app = new Vue({
    el: '#app'
});
