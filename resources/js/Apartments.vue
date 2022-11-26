<script setup>
import API from "./services/API";
import {ref} from "vue";

const apartmentsAPI = new API("/api/v1/apartments");
const apartments = ref([]);

async function fetchApartments() {
    const response = await apartmentsAPI.index({page: 1, per_page: 50});
    apartments.value = response.entities;
}

fetchApartments();
</script>

<template>
<table class="table table-striped">
    <thead>
    <tr>
        <td>ID</td>
        <td>Количество комнат</td>
        <td>Адрес</td>
        <td>Комнаты</td>
    </tr>
    </thead>
    <tbody>
    <tr v-for="apartment in apartments">
        <td>{{ apartment.id }}</td>
        <td>{{ apartment.number_of_rooms }}</td>
        <td>{{ apartment.address }}</td>
        <td><router-link :to="{name: 'apartment-rooms', params: {apartmentId: apartment.id}}">Перейти</router-link></td>
    </tr>
    </tbody>
</table>
</template>
