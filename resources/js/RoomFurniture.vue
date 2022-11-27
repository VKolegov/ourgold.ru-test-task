<script setup>
import {ref, watch} from "vue";
import DatePicker from "@vuepic/vue-datepicker";
import VueSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import "@vuepic/vue-datepicker/dist/main.css";
import furnitureAPI from "./services/furnitureAPI";
import {useColors, useFurnitureTypes, useMaterials} from "./composables/dictionaries";
import FurnitureTable from "./components/FurnitureTable.vue";

const props = defineProps({
    roomId: [Number, String],
    apartmentId: [Number, String],
});

const dateFormat = "dd/MM/yyyy HH:mm";

const furniture = ref([]);

async function fetchFurniture() {
    const response = await furnitureAPI.index(filterParams.value);
    furniture.value = response.entities;
}

watch(() => props.apartmentId, fetchFurniture);
watch(() => props.roomId, fetchFurniture);

// filtering

const {furnitureTypes, fetchFurnitureTypes} = useFurnitureTypes();
const {materials, fetchMaterials} = useMaterials();
const {colors, fetchColors} = useColors();

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
fetchFurnitureTypes();
fetchMaterials();
fetchColors();
</script>

<template>
<h1>
    <router-link to="/">[К]</router-link>
    >
    <router-link :to="{name: 'apartment-rooms', params:{apartmentId} }">Квартира {{ apartmentId }}</router-link>
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
<label>Тип мебели</label>
<vue-select
    :clearable="true"
    :filterable="true"
    label="name"
    :multiple="true"
    :options="furnitureTypes"
    :reduce="e => e.code"
    v-model="filterParams.type_code"
>
</vue-select>
<label>Материал</label>
<vue-select
    :clearable="true"
    :filterable="true"
    label="name"
    :multiple="true"
    :options="materials"
    :reduce="e => e.code"
    v-model="filterParams.material_code"
>
</vue-select>
<label>Цвет</label>
<vue-select
    :clearable="true"
    :filterable="true"
    label="name"
    :multiple="true"
    :options="colors"
    :reduce="e => e.code"
    v-model="filterParams.color_code"
>
</vue-select>
<furniture-table
    :furniture="furniture"
    :date-format="dateFormat"
/>
</template>

<style scoped>
</style>
