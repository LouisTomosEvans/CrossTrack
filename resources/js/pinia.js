import Vue from 'vue'
import { defineStore } from 'pinia'
import { createPinia, PiniaVuePlugin } from 'pinia'

Vue.use(createPinia())
Vue.use(PiniaVuePlugin)

const pinia = createPinia()

export default pinia
