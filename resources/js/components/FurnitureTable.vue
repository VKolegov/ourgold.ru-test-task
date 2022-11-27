<script setup>
import {formatDate} from "../utils";
import {watch} from "vue";

const props = defineProps({
    furniture: Array,
    dateFormat: String,
});

// history
const history = new Map();

function updateHistory() {
    for (const pieceOfFurniture of props.furniture) {

        if (!pieceOfFurniture.history || pieceOfFurniture.history.length === 1) {
            continue;
        }

        const historyLines = new Array(pieceOfFurniture.history.length);

        for (let i = 0; i < pieceOfFurniture.history.length; i++) {
            const historyEntry = pieceOfFurniture.history[i];
            const dateFormatted = formatDate(historyEntry.placed_at, props.dateFormat);

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

watch(() => props.furniture, function() {
   updateHistory();
}, {immediate: true});
</script>

<template>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Название</td>
        <td>Тип</td>
        <td>Материал</td>
        <td>Цвет</td>
        <td>Комната</td>
        <td v-if="history.size > 0">Перемещено</td>
    </tr>
    </thead>
    <tbody>
    <tr v-for="pieceOfFurniture in furniture">
        <td>{{ pieceOfFurniture.id }}</td>
        <td>{{ pieceOfFurniture.name }}</td>
        <td>{{ pieceOfFurniture.type.name }}</td>
        <td>{{ pieceOfFurniture.material.name }}</td>
        <td>{{ pieceOfFurniture.color.name }}</td>
        <td>{{ pieceOfFurniture.room_id }}</td>
        <td v-if="pieceOfFurniture.history">
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
