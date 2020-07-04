import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home';
import BadGateway from '../pages/BadGateway';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                auth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: () => import(/* webpackChunkName: "login" */ '../pages/Login.vue')
        },
        {
            path: '/404',
            name: 'BadGateway',
            component: () => import(/* webpackChunkName: "BadGateway" */ '../pages/BadGateway.vue')
        }
    ],
    linkExactActiveClass: "nav-item active"
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login');
        return
    }
    next();
});

export default router;
