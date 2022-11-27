import {ref} from "vue";
import furnitureTypesAPI from "../services/furnitureTypesAPI";
import materialsAPI from "../services/materialsAPI";

export function useFurnitureTypes() {

    const furnitureTypes = ref([]);

    async function fetchFurnitureTypes() {
        const response = await furnitureTypesAPI.index({page: 1, per_page: 100});
        furnitureTypes.value = response.entities;
    }

    return {furnitureTypes, fetchFurnitureTypes};
}

export function useMaterials() {
    const materials = ref([]);

    async function fetchMaterials() {
        const response = await materialsAPI.index({page: 1, per_page: 100});
        materials.value = response.entities;
    }

    return {materials, fetchMaterials};
}
