import './bootstrap';

import { createApp } from 'vue';
import app from './layouts/app.vue';
import routes from './routes/routes';
import axios from 'axios'
import VueAxios from 'vue-axios'

createApp(app).use(routes).use(VueAxios, axios).mount("#app");

