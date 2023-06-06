import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import moment from 'moment'

const pinia = createPinia()

createApp(App)
.use(router)
.use(pinia)
.use(moment)
.mount('#app')
