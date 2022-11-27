import {ref, watch} from "vue";

export function useFilter() {
    const filter = ref();

    function onFilterUpdate(callback) {
        watch(filter, function(newVal) {
            callback(newVal)
        }, {deep: true})
    }

    return {filter, onFilterUpdate}
}
