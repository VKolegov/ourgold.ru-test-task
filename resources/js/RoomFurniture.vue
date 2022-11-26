<script setup>
import API from "./services/API";
import {ref, watch} from "vue";

const props = defineProps({
    roomId: [Number, String],
    apartmentId: [Number, String],
});



const furnitureAPI = new API("/api/v1/pieces-of-furniture");
const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index({
        page: 1,
        per_page: 50,
        apartment_id: props.apartmentId ? [props.apartmentId] : null,
        room_id: props.roomId ? [props.roomId] : null,
    });
    furniture.value = response.entities;
}
fetchFurniture();

watch(() => props.apartmentId, fetchFurniture);
watch(() => props.roomId, fetchFurniture);

</script>

<template>
<h1>Квартира {{ apartmentId }} | Комната {{ roomId }}</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Название</td>
        <td>Тип</td>
<!--        <td>Мебель</td>-->
    </tr>
    </thead>
    <tbody>
    <tr v-for="furniture in furniture">
        <td>{{ furniture.id }}</td>
        <td>{{ furniture.name }}</td>
        <td>{{ furniture.type_code }}</td>
    </tr>
    </tbody>
</table>
</template>

<style scoped>
</style>
