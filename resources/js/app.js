import './bootstrap';
import {createApp} from "vue";
import App from "./App.vue";
import router from "./routes";

import "vue-select/dist/vue-select.css";
import "@vuepic/vue-datepicker/dist/main.css";

const app = createApp(App);

app.use(router);
app.mount("#app");
