import {createRouter, createWebHistory} from "vue-router/dist/vue-router";
import Apartments from "./Apartments.vue";
import ApartmentRooms from "./ApartmentRooms.vue";
import RoomFurniture from "./RoomFurniture.vue";
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
       {
           path: "/apartments/:apartmentId(\\d+)/room/:roomId(\\d+)",
           name: "room-furniture",
           props: true,
           component: RoomFurniture,
       },
   ],
});


export default router;
