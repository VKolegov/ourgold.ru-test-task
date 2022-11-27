<script setup>
import {ref} from "vue";

import roomsAPI from "./services/roomsAPI";
import furnitureAPI from "./services/furnitureAPI";
import FurnitureTable from "./components/FurnitureTable.vue";

const props = defineProps({
    apartmentId: [Number, String],
});


const rooms = ref([]);

async function fetchRooms() {
    const response = await roomsAPI.index({
        page: 1,
        per_page: 50,
        apartment_id: props.apartmentId ? [props.apartmentId] : null,
    });
    rooms.value = response.entities;
}

fetchRooms();

// furniture
const dateFormat = "dd/MM/yyyy HH:mm";

const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index({
        page: 1,
        per_page: 50,
        apartment_id: props.apartmentId ? [props.apartmentId] : null,
    });
    furniture.value = response.entities;
}
fetchFurniture();
</script>

<template>
<h1>
    <router-link to="/">[К]</router-link>
    > Квартира {{ apartmentId }}
</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Название</td>
        <td>Тип комнаты</td>
        <td>Мебель</td>
    </tr>
    </thead>
    <tbody>
    <tr v-for="room in rooms">
        <td>{{ room.id }}</td>
        <td>{{ room.name }}</td>
        <td>{{ room.type.name }}</td>
        <td>
            <router-link
                :to="{name: 'room-furniture', params: {apartmentId: apartmentId, roomId: room.id}}"
            >
                Перейти
            </router-link>
        </td>
    </tr>
    </tbody>
</table>

<h2>Мебель в квартире</h2>
<furniture-table
    :furniture="furniture"
    :date-format="dateFormat"
/>
</template>
