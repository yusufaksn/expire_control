import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


import register from '../pages/Auth/Register';
import login from '../pages/Auth/Login';
import product from '../pages/product';
const routes = [
    {
        path:'/register',
        name:'register',
        component:register
    },
    {
        path:'/login',
        name:'login',
        component:login
    },
    {
        path:'/product',
        name:'product',
        component:product
    },
];
export default new VueRouter({
    routes,
    mode: 'hash',
})
