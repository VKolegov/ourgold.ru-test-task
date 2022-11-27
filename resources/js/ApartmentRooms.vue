<script setup>
import {computed, ref} from "vue";
import VueSelect from "vue-select";
import DatePicker from "@vuepic/vue-datepicker";
import roomsAPI from "./services/roomsAPI";
import furnitureAPI from "./services/furnitureAPI";
import FurnitureTable from "./components/FurnitureTable.vue";
import {useRoomTypes} from "./composables/dictionaries";
import {useFilter} from "./composables/filter";

const props = defineProps({
    apartmentId: [Number, String],
});

const dateFormat = "dd/MM/yyyy HH:mm";

const rooms = ref([]);

async function fetchRooms() {
    const response = await roomsAPI.index(filter.value);
    rooms.value = response.entities;
    await fetchFurniture();
}

// furniture
const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index(furnitureFilter.value);
    furniture.value = response.entities;
}

const {filter: furnitureFilter, onFilterUpdate: onFurnitureFilterUpdate} = useFilter();
furnitureFilter.value = {
    page: 1,
    per_page: 50,
    apartment_id: props.apartmentId ? [props.apartmentId] : null,
    room_id: rooms.value.map(r => r.id),
};
onFurnitureFilterUpdate(fetchFurniture);

// filter
const {filter, onFilterUpdate} = useFilter();
filter.value = {
    page: 1,
    per_page: 50,
    apartment_id: props.apartmentId ? [props.apartmentId] : null,
};
onFilterUpdate(fetchRooms);
const {roomTypes, fetchRoomTypes} = useRoomTypes();

// oncreate
fetchRooms();
fetchRoomTypes();
</script>

<template>
<h1>
    <router-link to="/">[К]</router-link>
    > Квартира {{ apartmentId }}
</h1>
<label>Тип комнаты</label>
<vue-select
    :clearable="true"
    :filterable="true"
    label="name"
    :multiple="true"
    :options="roomTypes"
    :reduce="e => e.code"
    v-model="filter.type_code"
>
</vue-select>
<date-picker
    v-model="furnitureFilter.date"
    :format="dateFormat"
    :clearable="false"
    position="left"
    :auto-position="false"
    alt-position

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
