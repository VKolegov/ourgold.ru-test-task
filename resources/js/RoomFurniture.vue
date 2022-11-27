<script setup>
import {ref, watch} from "vue";
import DatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import {formatDate} from "./utils";
import furnitureAPI from "./services/furnitureAPI";

const props = defineProps({
    roomId: [Number, String],
    apartmentId: [Number, String],
});

const dateFormat = "dd/MM/yyyy HH:mm";


const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index(filterParams.value);
    furniture.value = response.entities;
    updateHistory();
}

watch(() => props.apartmentId, fetchFurniture);
watch(() => props.roomId, fetchFurniture);

// history
const history = new Map();

function updateHistory() {
    for (const pieceOfFurniture of furniture.value) {

        const historyLines = new Array(pieceOfFurniture.history.length);

        for (let i = 0; i < pieceOfFurniture.history.length; i++) {
            const historyEntry = pieceOfFurniture.history[i];
            const dateFormatted = formatDate(historyEntry.placed_at, dateFormat);

            let historyString = `[${dateFormatted}] Квартира: ${historyEntry.apartment_id} | `;
            historyString += `Комната: ${historyEntry.room_id}`;

            historyLines[i] = historyString;
        }

        history.set(pieceOfFurniture.id, historyLines.join("\n"));
    }
}

function displayHistory(pieceOfFurnitureId) {
    alert(history.get(pieceOfFurnitureId));
}

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
<h1>
    <router-link to="/">[К]</router-link>
    > <router-link :to="{name: 'apartment-rooms', params:{apartmentId} }">Квартира {{ apartmentId }}</router-link>
    > Комната {{ roomId }}
</h1>
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
        <td>Материал</td>
        <td>Цвет</td>
        <td>Перемещено</td>
    </tr>
    </thead>
    <tbody>
    <tr v-for="pieceOfFurniture in furniture">
        <td>{{ pieceOfFurniture.id }}</td>
        <td>{{ pieceOfFurniture.name }}</td>
        <td>{{ pieceOfFurniture.type.name }}</td>
        <td>{{ pieceOfFurniture.material.name }}</td>
        <td>{{ pieceOfFurniture.color.name }}</td>
        <td>
            {{ formatDate(pieceOfFurniture.history[0].placed_at, dateFormat) }}
            <a href="#"
                v-if="pieceOfFurniture.history.length > 1"
                @click.prevent="displayHistory(pieceOfFurniture.id)"
            >
            [История]
            </a>
        </td>
    </tr>
    </tbody>
</table>
</template>

<style scoped>
</style>
