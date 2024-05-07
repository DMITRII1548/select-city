/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import '../sass/app.scss'
import { createApp } from 'vue'
import AppComponent from './Components/App.vue'
import router from './router'


const app = createApp({
    components: {
        AppComponent,
    }
})

app.use(router);
app.mount('#app')
