<script setup>
import API from "./services/API";
import {ref, watch} from "vue";

const props = defineProps({
    apartmentId: [Number, String],
});


const roomsAPI = new API("/api/v1/rooms");
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


</script>

<template>
<h1>Квартира {{ apartmentId }}</h1>
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
</template>

<style scoped>
</style>
