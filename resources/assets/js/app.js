import './bootstrap'
import router from './router'

// global components
Vue.component('main-layout', require('./components/MainLayout.vue'))

new Vue({
    el: '#app',
    
    router
})