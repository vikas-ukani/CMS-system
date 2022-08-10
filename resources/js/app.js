import './bootstrap';

import { createApp } from 'vue';
import App from "./App.vue";
import router from './router.js'

import CKEditor from '@ckeditor/ckeditor5-vue';

/**
 * Creating Vue App Instance
 */
const app = createApp(App);
app.use(CKEditor);

// Register Routes
app.use(router)
// Mounting App
app.mount('#app');
