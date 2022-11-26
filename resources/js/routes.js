import {createRouter, createWebHistory} from "vue-router/dist/vue-router";
import Apartments from "./Apartments.vue";
/**
 *
 * @type {ReadonlyArray<RouteRecordRaw>}
 */
const routes = [

];


const router = createRouter({
   history: createWebHistory(),
   routes: [
       {
           path: "/",
           name: "apartments",
           component: Apartments,
       },
   ],
});


export default router;
