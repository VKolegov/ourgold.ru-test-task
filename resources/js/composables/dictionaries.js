import {ref} from "vue";
import furnitureTypesAPI from "../services/furnitureTypesAPI";

export function useFurnitureTypes() {

    const furnitureTypes = ref([]);

    async function fetchFurnitureTypes() {
        const response = await furnitureTypesAPI.index({page: 1, per_page: 100});
        furnitureTypes.value = response.entities;
    }

    return {furnitureTypes, fetchFurnitureTypes};
}
