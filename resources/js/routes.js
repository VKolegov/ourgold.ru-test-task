import {createRouter, createWebHistory} from "vue-router/dist/vue-router";
import Apartments from "./Apartments.vue";
import ApartmentRooms from "./ApartmentRooms.vue";
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
       {
           path: "/apartments/:apartmentId(\\d+)",
           name: "apartment-rooms",
           props: true,
           component: ApartmentRooms,
       },
   ],
});


export default router;
