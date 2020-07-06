import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboardlayout from '../pages/layout/Dashboardlayout';
import Dashboard from '../pages/Dashboard';
import ClientList from '../pages/clients/ClientList';
import CreateClient from '../pages/clients/CreateClient';
import BadGateway from '../pages/BadGateway';
import store from '../store';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Dashboardlayout,
            redirect: "/dashboard",
            children: [
                {
                    path: "dashboard",
                    name: "Dashboard",
                    component: Dashboard,
                    meta: {
                        hideFooter: true
                    }
                },
                {
                    path: "clients",
                    name: "Lista De Clientes",
                    component: ClientList,
                    meta: {
                        hideFooter: true
                    }
                },
                {
                    path: "clients/add",
                    name: "Nuevo Cliente",
                    component: CreateClient,
                    meta: {
                        hideFooter: true
                    }
                }
            ],
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
        },
        {
            path: '*',
            name: 'BadGateway',
            component: () => import(/* webpackChunkName: "BadGateway" */ '../pages/BadGateway.vue')
        }
    ],
    linkExactActiveClass: "nav-item active"
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.auth) && !store.state.auth.authenticated) {
        next('/login');
        return
    }
    next();
});

export default router;
