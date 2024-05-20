/**
 * PHP2JS v4.4.0
 * JavaScript Utility Library
 * (c) Raul Mauricio Uñate Castro
 * GitHub: https://github.com/rmunate
 * License: MIT
 */

const PHP2JSHelpers = {
    /**
     * Extracts and aggregates data from Meta Tag.
     * @returns {Object|null} - An object containing aggregated data from HTML spans, or null if not found.
     */
    getData: () => {

        const metaElement = document.querySelector('meta[name="X-PHP2JS-DATA"]');

        if (metaElement) {

            const values = JSON.parse(metaElement.getAttribute('content'));
            metaElement.parentNode.removeChild(metaElement);

            return values;
        }

        return null;
    },
};

const PHP2JS = {
    /**
     * Data returned from PHP.
     */
    data: PHP2JSHelpers.getData(),

    /**
     * Destroys the content of the object.
     * @returns {boolean} - True if the object is successfully destroyed.
     */
    destroy: function () {
        for (let prop in this) {
            if (this.hasOwnProperty(prop)) {
                delete this[prop];
            }
        }
        return true;
    },

    /**
     * Creates and returns a new object with the same prototype.
     * @returns {object} - A new object created with the same prototype.
     */
    assign: function () {

        return Object.assign({}, this);
    },

    /**
     * Creates a new object with the same prototype and destroys the original object.
     * @returns {object} - A new object created with the same prototype.
     */
    assignAndDestroy: function () {
        const newObject = Object.assign({}, this);
        this.destroy();

        return newObject;
    },

    /**
     * Returns only the specified values separated by commas in the function.
     * @param {...string} properties - The properties to include in the result.
     * @returns {object} - An object containing the specified properties.
     */
    only: function (...properties) {
        let result = {};
        properties.forEach((property) => {
            if (this.data.hasOwnProperty(property)) {
                result[property] = this.data[property];
            }
        });

        return result;
    },

    /**
     * Returns all values except those provided.
     * @param {...string} properties - The properties to exclude from the result.
     * @returns {object} - An object containing all values except the excluded properties.
     */
    except: function (...properties) {
        let result = {};
        for (const key in this.data) {
            if (!properties.includes(key)) {
                result[key] = this.data[key];
            }
        }

        return result;
    },

    /**
     * Checks if a property exists in the object.
     * @param {string} property - The property to check.
     * @returns {boolean} - True if the property exists, false otherwise.
     */
    has: function (property) {

        return this.data.hasOwnProperty(property);
    },

    /**
     * Retrieves the value of a specified property.
     * @param {string} property - The property to retrieve.
     * @returns {*} - The value of the specified property or null if it doesn't exist.
     */
    get: function (property) {

        return this.data[property] || null;
    },

    /**
     * Sets the value of a specified property in the object.
     * @param {string} property - The property to set.
     * @param {*} value - The value to assign to the specified property.
     */
    set: function (property, value) {
        this.data[property] = value;
    },
};
