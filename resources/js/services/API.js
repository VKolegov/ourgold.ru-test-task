import axios from "axios";

/**
 * @typedef {Object} APIRequest
 * @property {int} page
 * @property {int} per_page
 */

/**
 * @typedef {Object} APIResponse
 * @property {int} total_count
 * @property {Object[]} entities
 */

export default class API {
    /**
     *
     * @private
     * @type {AxiosInstance}
     */
    _axios;

    /**
     *
     * @param {string} endpoint
     */
    constructor(endpoint) {
        this._axios = axios.create(
            {
                baseURL: endpoint
            }
        );
    }

    /**
     *
     * @param {APIRequest|null} request
     * @return {Promise<APIResponse>}
     */
    async index(request = null) {
        const r = await this._axios.get("/", {
            params: request
        });

        return r.data;
    }
}
