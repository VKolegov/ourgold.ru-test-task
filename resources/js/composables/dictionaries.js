import {ref} from "vue";
import furnitureTypesAPI from "../services/furnitureTypesAPI";
import materialsAPI from "../services/materialsAPI";
import colorsAPI from "../services/colorsAPI";
import roomTypesAPI from "../services/roomTypesAPI";

export function useFurnitureTypes() {

    const furnitureTypes = ref([]);

    async function fetchFurnitureTypes() {
        const response = await furnitureTypesAPI.index({page: 1, per_page: 100});
        furnitureTypes.value = response.entities;
    }

    return {furnitureTypes, fetchFurnitureTypes};
}

export function useRoomTypes() {

    const roomTypes = ref([]);

    async function fetchRoomTypes() {
        const response = await roomTypesAPI.index({page: 1, per_page: 100});
        roomTypes.value = response.entities;
    }

    return {roomTypes, fetchRoomTypes};
}

export function useMaterials() {
    const materials = ref([]);

    async function fetchMaterials() {
        const response = await materialsAPI.index({page: 1, per_page: 100});
        materials.value = response.entities;
    }

    return {materials, fetchMaterials};
}

export function useColors() {
    const colors = ref([]);

    async function fetchColors() {
        const response = await colorsAPI.index({page: 1, per_page: 100});
        colors.value = response.entities;
    }

    return {colors, fetchColors};
}
