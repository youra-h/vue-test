export default class http {

    constructor() {
        this._api = process.env.API_ROOT;
    }

    /**
     * Вернуть экземпляр объекта http
     * @returns http
     */
    static instance() {
        return new http();
    }

    /**
     * Вернуть url
     * @param {String} url 
     * @returns String
     */
    getUrl(url) {
        return `${this._api}/${url}`;
    }

    /**
     * Отправить запрос на сервер
     * @param {String} url 
     * @param {Object} body 
     * @returns Promise|any
     */
    async post(url, body = {}) {
        const response = await fetch(this.getUrl(url), {
            method: 'POST',
            body: JSON.stringify(body)
        });

        return await response.json();
    }
}