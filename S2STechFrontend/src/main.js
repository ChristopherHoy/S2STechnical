import { createApp } from 'vue'
import App from './App.vue'
import './index.css'

import axios from 'axios'
import VueAxios from 'vue-axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000';

import toast from './helpers/toast.js'
window.toast = toast;

const app = createApp(App)
app.use(VueAxios, axios)
app.mount('#app')
