import { createApp } from 'vue';
import App from './App.vue';
import './registerServiceWorker';
import router from './router';
import store from './store';
import api from './services/api';  // Importe a configuração do Axios

const app = createApp(App);

// Registre o Axios como uma propriedade global, para usá-lo em qualquer componente
app.config.globalProperties.$api = api;

app.use(store).use(router).mount('#app');


