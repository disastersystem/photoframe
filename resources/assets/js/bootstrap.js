import Vue from "vue"
import VueRouter from 'vue-router'
import axios from "axios"

import "babel-polyfill"

import Vuetify from "vuetify"

window.Vue = Vue
Vue.use(VueRouter)
Vue.use(Vuetify)

window.axios = axios
window.axios.defaults.headers.common = {
	'X-Requested-With': 'XMLHttpRequest'
}

/* empty Vue instance as a central event bus */
window.Bus = new Vue()