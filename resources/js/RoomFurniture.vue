<script setup>
import API from "./services/API";
import {ref, watch} from "vue";
import DatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import {formatDate} from "./utils";

const props = defineProps({
    roomId: [Number, String],
    apartmentId: [Number, String],
});

const dateFormat = "dd/MM/yyyy HH:mm";


const furnitureAPI = new API("/api/v1/pieces-of-furniture");
const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index(filterParams.value);
    furniture.value = response.entities;
}

watch(() => props.apartmentId, fetchFurniture);
watch(() => props.roomId, fetchFurniture);

// filtering

const filterParams = ref({
    page: 1,
    per_page: 50,
    apartment_id: props.apartmentId ? [props.apartmentId] : null,
    room_id: props.roomId ? [props.roomId] : null,
    date: (new Date()).toISOString(),
});

watch(filterParams, function() {
   fetchFurniture();
}, {deep: true});

// filtering end

// on create
fetchFurniture(filterParams.value);
</script>

<template>
<h1>Квартира {{ apartmentId }} | Комната {{ roomId }}</h1>
<date-picker
    v-model="filterParams.date"
    :format="dateFormat"
    :clearable="false"

    :enable-time-picker="true"
    minutes-increment="5"


    :month-change-on-scroll="false"
    :auto-apply="true"
    locale="ru-RU"

    input-class-name="form-control"
    utc

    v-bind="$attrs"
/>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Название</td>
        <td>Тип</td>
        <td>Перемещено</td>
    </tr>
    </thead>
    <tbody>
    <tr v-for="furniture in furniture">
        <td>{{ furniture.id }}</td>
        <td>{{ furniture.name }}</td>
        <td>{{ furniture.type_code }}</td>
        <td>{{ formatDate(furniture.history[0].placed_at, dateFormat) }}</td>
    </tr>
    </tbody>
</table>
</template>

<style scoped>
</style>
