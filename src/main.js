import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Integração de assets do diretório root
import '../assets/css/index.css'
import '../assets/js/index.js'

const app = createApp(App)
app.use(router)
app.mount('#app')
