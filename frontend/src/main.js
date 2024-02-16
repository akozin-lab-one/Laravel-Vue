import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import VueGoogleMaps from '@fawmi/vue-google-maps';
import router from './components/router'
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router).use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCHIXXEVq2vR_qevuwfmrZ00QuxHTr4BF0',
    },
}).mount('#app');