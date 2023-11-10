/**
 * PHP2JS v4.0
 * Script
 * (c) Raul Mauricio Uñate Castro
 * https://github.com/rmunate
 * MIT
 */

/**
 * Function to extract and aggregate data from HTML spans with the "__PHP2JSData" class.
 * @returns {Object} - An object containing aggregated data from HTML spans.
 */
function __PHP2JSData() {
    const metaElement = document.querySelector('meta[name="__PHP2JSData"]');

    if (metaElement) {
        const values = metaElement.getAttribute('content');
        metaElement.parentNode.removeChild(metaElement);
        return values;
    }

    return null;
}

const PHP2JS = {
    /**
     * Data returned from PHP.
     */
    data: __PHP2JSData(),

    /**
     * Function to destroy the content of the object.
     * @returns {boolean} - True if the object is successfully destroyed.
     */
    destroy: function() {
        for (let prop in this) {
            if (this.hasOwnProperty(prop)) {
                delete this[prop];
            }
        }
        return true;
    },

    /**
     * Function to create and return a new object with the same prototype.
     * @returns {object} - A new object created with the same prototype.
     */
    assign: function() {
        return Object.assign({}, this);
    },

    /**
     * Function to create a new object with the same prototype and destroy the original object.
     * @returns {object} - A new object created with the same prototype.
     */
    assignAndDestroy: function() {
        const newObject = Object.assign({}, this);
        this.destroy();
        return newObject;
    },

    /**
     * Function to return only the specified values separated by commas in the function.
     * @param {...string} properties - The properties to include in the result.
     * @returns {object} - An object containing the specified properties.
     */
    only: function(...properties) {
        let result = {};
        properties.forEach(property => {
            if (this.data.hasOwnProperty(property)) {
                result[property] = this.data[property];
            }
        });
        return result;
    },

    /**
     * Function to return all values except those provided.
     * @param {...string} properties - The properties to exclude from the result.
     * @returns {object} - An object containing all values except the excluded properties.
     */
    except: function(...properties) {
        let result = {};
        for (const key in this.data) {
            if (!properties.includes(key)) {
                result[key] = this.data[key];
            }
        }
        return result;
    },

    /**
     * Function to check if a property exists in the object.
     * @param {string} property - The property to check.
     * @returns {boolean} - True if the property exists, false otherwise.
     */
    has: function(property) {
        return this.data.hasOwnProperty(property);
    },

    /**
     * Function to retrieve the value of a specified property.
     * @param {string} property - The property to retrieve.
     * @returns {*} - The value of the specified property or null if it doesn't exist.
     */
    get: function(property) {
        return this.data[property] || null;
    },

    /**
     * Function to set the value of a specified property in the object.
     * @param {string} property - The property to set.
     * @param {*} value - The value to assign to the specified property.
     */
    set: function(property, value) {
        this.data[property] = value;
    },
};
