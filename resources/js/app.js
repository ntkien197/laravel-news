import './bootstrap';
import { createApp } from 'vue'
import App from '../ts/App.vue'
// import Pinia from '@/plugins/Pinia'


const bootstrap = async () => {
    const app = createApp(App)

    // app.use(Pinia)

    app.mount('#app')
}

bootstrap().then()
