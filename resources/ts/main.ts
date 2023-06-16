import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router/index'
import { pinia } from '@/plugins/Pinia'

const bootstrap = async () => {
  const app = createApp(App)

  app.use(router)
  app.use(pinia)

  await router.isReady()
  app.mount('#app')
}

bootstrap().then()
