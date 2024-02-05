import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import VueGoogleMaps from '@fawmi/vue-google-maps';
import router from './components/router'

createApp(App).use(router).use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCHIXXEVq2vR_qevuwfmrZ00QuxHTr4BF0',
    },
}).mount('#app')