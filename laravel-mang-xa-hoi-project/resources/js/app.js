import App from './App.vue'
import router from './router'
import CKEditor from '@ckeditor/ckeditor5-vue'
import AOS from 'aos'
import 'aos/dist/aos.css'


import Vue from 'vue'
Vue.use( CKEditor )

require('./bootstrap');

window.Vue = require('vue');

// EVENT BUS
export const bus = new Vue();

const app = new Vue({
    render: h => h(App),
    el: '#app',
    router,
    created () {
        AOS.init()
    },
});

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);