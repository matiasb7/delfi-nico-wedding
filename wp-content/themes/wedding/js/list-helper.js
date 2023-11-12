export default class ListHelper {
    constructor($e = null) {
        this.$e = $e
    }

    getSearchUrl(params, page){
        const paramsToUrl = page ? {...params, 'current-page' : page} : {...params}
        return Object.entries(paramsToUrl)
            .map(([key, value]) => {
                key = encodeURIComponent(key);
                if(!value.length > 0) return false
                value = Array.isArray(value) ? value.join(',') : value
                return `${key}=${value}`;
            })
            .filter(Boolean).join('&');
    }

    /**
     * Initializes parameters based on the provided filters.
     *
     * @param {{"grantee-year": {acceptMultipleValue: boolean}, keyword: {acceptMultipleValue: boolean}}} filters - An object defining the filters and their processing rules.
     * @param {Object} filters.key - An object representing a filter with key = URL param.
     * @param {boolean} filters.key.acceptMultipleValue - Indicates whether the filter accepts multiple values.
     * @param {boolean} filters.key.hasCheckboxes - Indicates whether the filter is conformed by checkboxes
     *
     * @returns {Object} An object containing the processed filter values from the URL.
     *
     * @example
     * Given the URL: http://example.com/?color=red,blue&size=large
     * initParams({
     *   color: { acceptMultipleValue: true },
     *   size: { acceptMultipleValue: false }
     * });
     *
     * Returns: { color: ['red', 'blue'], size: 'large' }
     */
    constructParams(filters) {
        const urlParams = new URLSearchParams(window.location.search);
        return Object.keys(filters).reduce((acc, key) => {
            const keyParam = urlParams.get(key);

            // If accepts multiple values, is an array, if not a single value.
            if (filters[key]?.acceptMultipleValue) {
                acc[key] = keyParam ? [...new Set(keyParam.split(','))] : [];
            } else {
                acc[key] = keyParam || '';
            }

            return acc;
        }, {});
    }

    getData(url, params) {
        return fetch(url, params)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .catch(error => {
                alert('There was an error getting the data. Please try again later.');
                throw error; // Rethrow the error to propagate it to the caller if needed.
            });
    }
}