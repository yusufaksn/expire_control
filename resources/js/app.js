
require('./bootstrap');

window.Vue = require('vue');

import Home from './pages/Home';
import router from './routes/index'
const app = new Vue({
    el: '#app',
    template: '<Home/>',
    components: { Home },
    router
});

