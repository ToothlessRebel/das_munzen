import Vue from 'vue';
import VueRouter from "vue-router";

require('./bootstrap');

Vue.use(VueRouter)

const router = require('./Router').default
const app = new Vue({
    router,
}).$mount('#app')
