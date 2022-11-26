import {format} from "date-fns";

export function formatDate(date, f = "dd/MM/yyyy", empty = " - ") {

    if (!date) {
        return empty;
    }

    let d;
    if (typeof date === "string") {
        d = new Date(date);
    } else {
        d = date;
    }

    try {
        return format(d, f);
    } catch (e) {
        console.error(`Error while formatting date ${d}: ${e}`);
        return empty;
    }
}
