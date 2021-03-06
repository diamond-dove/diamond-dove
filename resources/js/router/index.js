import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboardlayout from '../pages/layout/Dashboardlayout';
import Dashboard from '../pages/Dashboard';
import ClientList from '../pages/clients/ClientList';
import LoanList from '../pages/loans/LoanList';
import CreateLoan from '../pages/loans/CreateLoan';
import CreateClient from '../pages/clients/CreateClient';
import EditClient from '../pages/clients/EditClient';
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
                },
                {
                    path: 'clients/edit/:client',
                    name: 'EditClient',
                    component: EditClient,
                    meta: {
                        hideFooter: true
                    }
                },
                {
                    path: "loans",
                    name: "Prestamos",
                    component: LoanList,
                    meta: {
                        hideFooter: true
                    }
                },
                {
                    path: "loans/add",
                    name: "Nuevo Prestamo",
                    component: CreateLoan,
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
