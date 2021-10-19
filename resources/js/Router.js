import VueRouter from "vue-router";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: require('./components/Conversion').default,
            name: 'home',
        },
    ],
})

export default router
