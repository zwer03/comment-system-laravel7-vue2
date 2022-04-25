import VueRouter from 'vue-router';
import Baseline from './layout/Baseline'
import NotFound from './pages/error/404'

let routes = [
    {
        name: 'home',
        path: '/',
        component: require('./pages/blog/Index.vue').default,
        meta: {
            layout: Baseline
        }
    },
    { path: '/404', name: '404', component: NotFound, meta: {layout: NotFound} },
    { path: '*', redirect: '/404' },
];

const router = new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: 'highlighted',
});

export default router