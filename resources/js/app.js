import { createApp } from 'vue';
import Urls from './components/Urls.vue';
import '../css/app.css';

const app = createApp()

app.component('url', Urls);

app.mount("#app");
