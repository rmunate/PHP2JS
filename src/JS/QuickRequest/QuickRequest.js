/**
 * QuickRequest v1.0
 * Script
 * (c) Raul Mauricio Uñate Castro
 * https://github.com/rmunate
 * MIT
 */

/**
 * --------------------------
 * Class for Throwing Errors to the Console.
 * -------------------------- 
 */
class QuickRequestException {

    /**
     * Method to throw an exception to the console.
     * Halts execution with 'throw'.
     * @param {string} custom - Custom error message.
     */
    constructor(custom){

        // Create an error with the custom message
        const error = new Error(custom);

        // Log the error to the console and stop execution
        throw console.error("⚠ QuickRequestException ⚠ | " + error.toString(), {
            name: error.name,
            message: error.message,
            trace: error.stack.split("\n").map(function(element){
                return element.trim().replaceAll("at ","🔍 At: ");
            }),
        });
    }
}

/**
 * --------------------------
 * Herlpers General - QuickRequest
 * --------------------------
 */
const QuickRequestHelpers = {

    /**
     * Extracts the last segment from a given value based on a specified separator.
     *
     * @param {*} value - The value from which to extract the last segment.
     * @param {string} [separator="/"] - The separator used to split the value into segments. Default is "/".
     * @returns {string} - The last segment of the value.
     */
    extractLastSegment: (value, separator = "/") => {

        // Check if the input value is not empty
        if (!QuickRequestHelpers.isValueEmpty(value)) {

            // Split the input string by "separator" and store the result in the 'segments' array
            const segments = value.split(separator);

            // Retrieve the last segment from the 'segments' array
            const lastSegment = segments[segments.length - 1];

            // Return the last segment
            return lastSegment;
        }

        // If the input value is empty, return an empty string
        return '';

    },

    /**
     * Checks if a value is empty (null, undefined, empty string, empty array, or empty object)
     *
     * @param {*} value - The value to be checked
     * @returns {boolean} - True if the value is empty, false otherwise
     */
    isValueEmpty: (value) => {
        if (value == null) {
          return true;
        }
      
        if (typeof value === 'string' && value.trim() === '') {
          return true;
        }
      
        if (Array.isArray(value) && value.length === 0) {
          return true;
        }
      
        if (typeof value === 'object' && Object.keys(value).length === 0) {
          return true;
        }
      
        return false;
    },

    /**
     * Get Valid Token Laravel
     * @returns {string} - Token Laravel
     */
    getTokenCSRF: () => {

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

        if (csrfTokenMeta) {
            return csrfTokenMeta.getAttribute('content');
        } else {
            throw new QuickRequestException(`The meta tag "csrf-token" was not found. Please remember to add it in the head section: <meta name="csrf-token" content="{{ csrf_token() }}">`);
        }
    },

};

/**
 * --------------------------
 * Class for Validating the Presence of Required Values in Requests.
 * -------------------------- 
 */
class QuickRequestValidate {

    /**
     * Validates that the mandatory values in the options are present.
     * @param {object} options - The request options to validate.
     * @returns {boolean} - True if all mandatory properties are present, false otherwise.
     */
    constructor(options){

        const required = ['url'];

        required.forEach(element => {
            let exist = options.hasOwnProperty(element)
            if (!exist) {
                throw new QuickRequestException("The property '" + element + "' is mandatory in the request options.");
            }
        });
        
    }

}

/**
 * -----------------------------------
 * Class for Validating HTML Elements
 * -----------------------------------
 */
class QuickRequestElements {

    /**
     * Check if the element has a valid tag for extracting its value within FormData.
     * @param {HTMLElement} element - The HTML element to validate.
     * @returns {boolean} - True if the tag is valid, false otherwise.
     */
    tagCheck(element){
        const validTags = ['INPUT', 'TEXTAREA', 'SELECT'];
        return validTags.includes(element.tagName)
    }

    /**
     * Check if the input type is valid to be considered as a valid form control.
     * @param {HTMLInputElement} element - The input element to validate.
     * @returns {boolean} - True if the input type is valid, false otherwise.
     */
    typeCheck(element){
        const disabledTypes = ['submit','button']
        return !disabledTypes.includes(element.type)
    }

    /**
     * Check if the input is of type "file".
     * @param {HTMLInputElement} element - The input element to validate.
     * @returns {boolean} - True if the input type is "file," false otherwise.
     */
    typeFile(element){
        return element.type === 'file';
    }

    /**
     * -----------------------------------
     * Check if it is a checkbox or a radio input
     * -----------------------------------
     * Determine if the input is of type "checkbox" or "radio."
     * @param {HTMLInputElement} element - The input element to validate.
     * @returns {boolean} - True if the input type is "checkbox" or "radio," false otherwise.
     */
    typeCheckboxOrRadio(element){
        const validTypes = ['radio','checkbox']
        return validTypes.includes(element.type)
    }

}

/**
 * --------------------------
 * Class for preparing data for Fetch requests.
 * --------------------------
 */
class QuickRequestMain {

    /* API request configuration. */
    constructor(){
        this.config = {
            expect: "JSON",
            confirm: false,
            activateEvent: false,
            eventListener: {},
            preventDefault: true,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': QuickRequestHelpers.getTokenCSRF(),
                'Accept': 'application/json',
            },
        };
    }

    /**
     * Set up an event listener for triggering the event.
     * @param {string} event - Event name to listen for.
     * @param {string} selectors - Selectors for event targets.
     */
    eventListener(event, selectors){

        if (QuickRequestHelpers.isValueEmpty(event)) {
            throw new QuickRequestException('You must define a valid event within the eventListener method(<<Method>>,<<Selectors>>)');
        }

        if (QuickRequestHelpers.isValueEmpty(selectors)) {
            throw new QuickRequestException('You must define a valid selector within the eventListener method(<<Method>>,<<Selectors>>)');
        }

        this.config.activateEvent = true;
        this.config.eventListener.event = event;
        this.config.eventListener.selectors = document.querySelectorAll(selectors);

        return this;
    }

    /**
     * Control whether to prevent the default behavior of the event.
     * @param {boolean} state - Set to true to prevent the default behavior, false otherwise.
     */
    preventDefault(state = true){

        if (state !== true && state !== false) {
            throw new QuickRequestException('The argument can only be <<true>> or <<false>>, or omit it to default to <<true>>');
        }

        this.config.preventDefault = state;

        return this;
    }

    /**
     * Add custom headers to the request.
     * @param {object} headersCustom - Custom headers to include.
     */
    headers(headersCustom = {}){

        this.config.headers = {
            ...this.config.headers,
            ...headersCustom
        };

        return this;
    }

    /**
     * Confirm Pre-Request
     * @param {*} callback 
     * @returns 
     */
    confirm(callback){
        this.config.confirm = callback;
        return this;
    }

    /**
     * Make a POST request.
     * @param {object} options - Additional options for the request.
     */
    post(options = {}){

        this.config.method = 'POST';

        if (options.hasOwnProperty('headers')) {
            this.headers(options.headers);
            delete options['headers'];   
        }

        this.config.options = options;
        this.config.expect = options.expect || "JSON";

        const manager = new QuickRequestEvents(this.config);
        return manager.handler;
    }

    /**
     * Make a GET request.
     * @param {object} options - Additional options for the request.
     */
    get(options = {}){

        this.config.method = 'GET';

        if (options.hasOwnProperty('headers')) {
            this.headers(options.headers);
            delete options['headers'];   
        }

        this.config.options = options;
        this.config.expect = options.expect || "JSON";

        const manager = new QuickRequestEvents(this.config);
        return manager.handler;
    }

    /**
     * Make a PUT request.
     * @param {object} options - Additional options for the request.
     */
    put(options = {}){

        this.config.method = 'PUT';

        if (options.hasOwnProperty('headers')) {
            this.headers(options.headers);
            delete options['headers'];   
        }

        this.config.options = options;
        this.config.expect = options.expect || "JSON";

        const manager = new QuickRequestEvents(this.config);
        return manager.handler;
    }

    /**
     * Make a PATCH request.
     * @param {object} options - Additional options for the request.
     */
    patch(options = {}){

        this.config.method = 'PATCH';

        if (options.hasOwnProperty('headers')) {
            this.headers(options.headers);
            delete options['headers'];   
        }

        this.config.options = options;
        this.config.expect = options.expect || "JSON";

        const manager = new QuickRequestEvents(this.config);
        return manager.handler;
    }

    /**
     * Make a DELETE request.
     * @param {object} options - Additional options for the request.
     */
    delete(options = {}){

        this.config.method = 'DELETE';

        if (options.hasOwnProperty('headers')) {
            this.headers(options.headers);
            delete options['headers'];   
        }

        this.config.options = options;
        this.config.expect = options.expect || "JSON";

        const manager = new QuickRequestEvents(this.config);
        return manager.handler;
    }
}

/**
 * --------------------------
 * Class for Triggering Events.
 * --------------------------
 */
class QuickRequestEvents {

    /**
     * Create an instance to execute a Fetch request.
     * @param {object} config - Request configuration.
     */
    constructor(config){

        
        // Configuration values for the request.
        this.config = config;
        this.config.callbacksEvents = [];
        
        // Perform validation of required values.
        new QuickRequestValidate(this.config.options);

        // Check whether to trigger the event.
        this.checkEvent();
    }

    /**
     * Check if the event should be triggered.
     */
    checkEvent(){

        /* Determine whether to create an event to trigger the Fetch request */
        if (this.config.activateEvent) {

            /* Create a reference to the main instance */
            const self = this;

            /* Iterate through the selection to trigger the events */
            this.config.eventListener.selectors.forEach(function(element) {

                const funcEvent = function(e) {
                    if (self.config.preventDefault) {
                        e.preventDefault();
                    }

                    new QuickRequestFetch(self.config);
                };

                /* Create the event for each matching selector */
                element.addEventListener(self.config.eventListener.event, funcEvent);

                /* Save Event Handlers */
                self.config.callbacksEvents.push({
                    element: element,
                    event: self.config.eventListener.event,
                    func: funcEvent
                });
            });

            self.handler = new QuickRequesHandler(self.config);

        } else {

            new QuickRequestFetch(this.config);

            this.handler = new QuickRequesHandler(this.config);
        }
    }
}

/**
 * --------------------------
 * Class for Handling Fetch Requests.
 * -------------------------- 
 */
class QuickRequestFetch {

    /**
     * Request configuration values.
     * @param {object} config - Request configuration.
     */
    constructor(config){

        /* Received and custom configuration values */
        this.config = config;
        this.config.baseUrl = `${window.location.protocol}//${window.location.host}/`;
        this.config.formData = new FormData();
        this.config.hasFile = false;      

        /* Execute the request sending process */
        this.dispatch();
    }
    
    /**
     * Create the final FormData for sending data to the backend.
     */
    data(){

        // Determine if form or data is being used
        const originForm = this.config.options.form || null;

        // En caso de que el origen sea un form.
        if (originForm !== null) {

            // Check input elements
            const inputsCheck = new QuickRequestElements();

            //Validate Form
            let controls = [];
            const realElementForm = document.getElementById(originForm);
            if (realElementForm) {
                controls = Array.from(realElementForm.elements);
            } else {
                throw new QuickRequestException("Could not find any form with the id " + originForm);
            }

            
            controls.forEach(element => {

                if (inputsCheck.tagCheck(element) && inputsCheck.typeCheck(element)) {

                    if (inputsCheck.typeFile(element)) {

                        if (element.files.length > 0) {     
                            this.config.formData.append(element.name, element.files[0]);
                            this.config.hasFile = true;
                        }

                    } else if(inputsCheck.typeCheckboxOrRadio(element)){

                        if (element.checked) {
                            this.config.formData.append(element.name, element.value);
                        }

                    } else {

                        if(!QuickRequestHelpers.isValueEmpty(element.value)){
                            this.config.formData.append(element.name, element.value);
                        }

                    }
                }
            });

            // Check if additional data is available
            const originData = this.config.options.data || null;

            if (!QuickRequestHelpers.isValueEmpty(originData)) {

                for (const [key, value] of Object.entries(originData)) {
                    this.config.formData.append(key, value);
                }
                
            }

        } else {

            // Check if additional data is available
            const originData = this.config.options.data || null;

            if (!QuickRequestHelpers.isValueEmpty(originData)) {

                for (const [key, value] of Object.entries(originData)) {
                    this.config.formData.append(key, value);
                }
                
            }
        }
    }

    /**
     * Define request body settings based on the method.
     */
    method(){

        /* Define URL */
        let url = (this.config.baseUrl + this.config.options.url).replaceAll("//","/").replaceAll(":/","://");

        /* Params Fetch */
        let params = {};

        if (['GET','HEAD'].includes(this.config.method)) {

            /* Validate This Request Has Files */
            if (this.config.hasFile) {
                throw new QuickRequestException("File uploads are not allowed with " + this.config.method + " due to URL length limitations; use POST instead.");
            }

            /* Validate Query In URL */
            if (url.includes("?")) {
                throw new QuickRequestException("The URL appears to already have a query, as it contains the '?' character in its structure. In case you need to send additional data, use the 'data' property.");
            }

            /* Create Query */
            let query = new URLSearchParams(this.config.formData).toString();
            url = `${url}?${query}`;
            params = {
                method: this.config.method,
                headers: this.config.headers,
            };

        } else if(['PATCH','PUT','DELETE'].includes(this.config.method)){

            /* Validate This Request Has Files */
            if (this.config.hasFile) {
                throw new QuickRequestException("File uploads are not allowed with " + this.config.method + " as it uses JSON headers; use POST instead.");
            }

            /* Create JSON */
            let jsonObject = {};

            for (let [clave, valor] of this.config.formData.entries()) {
                
                let isArray = clave.includes("[]");
                let index = clave.replace("[]", "");
                
                if (jsonObject[index] === undefined) {
                    if (isArray) {
                        jsonObject[index] = [valor];
                    } else {
                        jsonObject[index] = valor;
                    }
                } else {
                    try {
                        jsonObject[index].push(valor);
                    } catch (error) {
                        throw new QuickRequestException("Two distinct inputs, excluding Checkboxes and Radios, have the same name '"+index+"' without the square brackets '[]', which prevents them from being treated as the same data when sent to the backend as an array.");
                    }
                }
            }
            
            /* Add Header JSON */
            this.config.headers['Content-Type'] = 'application/json';
            
            params = {
                method: this.config.method,
                headers: this.config.headers,
                body: JSON.stringify(jsonObject),
            }

        } else {
            
            params = {
                method: this.config.method,
                headers: this.config.headers,
                body: this.config.formData,
            }
        }

        /* Validate Others Properties */
        const propertiesToValidate = ["mode", "cache", "credentials", "redirect", "referrerPolicy"];

        for (const property of propertiesToValidate) {
            if (this.config.hasOwnProperty(property)) {
                params[property] = this.config[property];
            }
        }

        return {
            realUrl: url,
            realParams: params
        };
    }

    /**
     * Dospatch Fetch
     */
    dispatch(){
        if (typeof this.config.confirm === 'function') {
            if (this.config.confirm() === true) {
                this.send();
            }
        } else {
            this.send();
        }
    }

    /**
     * Send the request to the backend.
     */
    async send(){

        /* FormData */
        this.data();

        /* Execute Pre-request Function */
        if (this.config.options.before && typeof this.config.options.before === "function") {
            this.config.options.before();
        }

        /* Response values */
        let success = {};
        let errors = {};
        let responseJSON;

        /* Determine the method to send the request to the server */
        const params = this.method();

        /* Execute the Fetch request */
        const response = await fetch(params.realUrl, params.realParams);

        if (!response.ok) {

            try {
                responseJSON = await response.json();
            } catch (error) {
                responseJSON = response.statusText;
            }

            /* Standar Struct Errors */
            let errors = {}, message;

            if (responseJSON.hasOwnProperty('exception') && responseJSON.hasOwnProperty('file') && responseJSON.hasOwnProperty('message')) {

                message = `File: ${QuickRequestHelpers.extractLastSegment(responseJSON.file)} - Line: ${responseJSON?.line} - Exception: ${responseJSON.message}`;

                responseJSON.trace.forEach(element => {

                    let file = QuickRequestHelpers.extractLastSegment(element.file);

                    if (!QuickRequestHelpers.isValueEmpty(file)) {
                        errors[QuickRequestHelpers.extractLastSegment(element.file)] = [`Line: ${element?.line}, File: ${element?.file}, Function: ${element?.function}`];
                    }
                });


                responseJSON = {
                    errors,
                    message
                }

            } else if (!responseJSON.hasOwnProperty('errors')) {

                if (typeof responseJSON === 'object' && Object.keys(responseJSON).length > 0) {

                    let i = 0;
                    for (const [key, value] of Object.entries(responseJSON)) {
                        errors[key] = Array.isArray(value) ? value : [value];
                        if (i == 0) {
                            message = key;
                        }
                        i++;
                    }

                    const moreErrors = i - 1;
                    if (moreErrors >= 1) {
                        message += ". (and "+ (i-1) +" more error)";
                    }

                } else {
                    errors[responseJSON] = [responseJSON];
                    message = Array.isArray(responseJSON) ? responseJSON[0] : responseJSON
                }

                responseJSON = {
                    errors,
                    message
                }
            }

            errors = {
                data: responseJSON,
                success: response.ok,
                code: response.status,
            }

            if (this.config.options.error && typeof this.config.options.error === "function") {
                this.config.options.error(errors);
            }

        } else {

            try {
                if (this.config.expect.toLowerCase().trim() == "json") {
                    responseJSON = await response.json();
                } else if (this.config.expect.toLowerCase().trim() == "text") {
                    responseJSON = await response.text();
                } else if (this.config.expect.toLowerCase().trim() == "blob") {
                    responseJSON = await response.blob();
                } else {
                    throw new Error("Only the values 'json', 'blob' or 'text' are allowed for the 'expect' property.");
                }
            } catch (error) {
                throw new QuickRequestException(error.message)
            }

            success = {
                data: responseJSON,
                success: response.ok,
                code: response.status,
            }

            this.config.options.success(success);
        }

        // Execute Post-request Function
        if (this.config.options.after && typeof this.config.options.after === "function") {
            this.config.options.after({
                success: response.ok,
                data: responseJSON,
                code: response.status,
            });
        }
    }
}

/**
 * --------------------------
 * Class for Handling PHP2JS Requests.
 * -------------------------- 
 */
class QuickRequesHandler {
    /**
     * Constructor for QuickRequesHandler.
     * @param {object} config - Configuration object for PHP2JS requests.
     */
    constructor({ callbacksEvents, headers, method, options, preventDefault }) {
        // Method to get the HTTP method.
        this.getMethod = function () {
            return method;
        };

        // Method to get the endpoint URL.
        this.getEndPoint = function () {
            return options.url;
        };

        // Method to get the form ID (if specified).
        this.getIdForm = function () {
            return options.form || null;
        }

        // Method to get the request data (if provided).
        this.getData = function () {
            return options.data || null;
        }

        // Method to get custom request headers.
        this.getCustomHeaders = function () {
            return headers;
        }

        // Method to get event-related information.
        this.getEvents = function () {
            return {
                preventDefault: !QuickRequestHelpers.isValueEmpty(callbacksEvents) ? preventDefault : null,
                events: callbacksEvents
            };
        }

        // Method to get callback functions.
        this.call = function () {
            return {
                before: options.before,
                success: options.success,
                error: options.error,
                after: options.after,
            };
        }

        // Method to get all request options.
        this.getParams = function () {
            return options;
        }

        // Method to remove event listeners.
        this.removeEventListener = function () {

            if (!QuickRequestHelpers.isValueEmpty(callbacksEvents)) {
                callbacksEvents.forEach(data => {
                    data.element.removeEventListener(data.event, data.func)
                });

                // Reset the events array to empty.
                this.getEvents = function () {
                    return [];
                }

                return true;
            }

            return false;
        }
    }
}

/**
 * --------------------------
 * Blob Manager.
 * -------------------------- 
 */
const QuickRequestBlobs = {

    config: {
        blob: null,
        name: null,
        extension: null,
    },

    setBlob: function (blob) {
        this.config.blob = blob;
        return this;
    },

    setName: function(name){
        this.config.name = name;
        return this;
    },

    setExtension: function(extension){
        this.config.extension = extension;
        return this;
    },

    download: function(){

        let { blob, name, extension } = this.config;

        if (!blob) {
            throw new QuickRequestException('Blob is not set in QuickRequestBlobs.setBlob().');
        }
    
        if (!name) {
            throw new QuickRequestException('Name is not set in QuickRequestBlobs.setName().');
        }
    
        if (extension === null && blob.type) {
            
            const mimeTypeParts = blob.type.split('/');
            if (mimeTypeParts.length >= 1) {
                extension = mimeTypeParts[1];
            }
        }

        if (extension === null) {
            throw new QuickRequestException('Extension is not set in QuickRequestBlobs.setExtension().');
        }

        const blobUrl = URL.createObjectURL(blob);
        const nameWithExtension = (name + "." + extension).replaceAll("..",".");

        // Create Element A
        const downloadLink = document.createElement('a');
        downloadLink.href = blobUrl;
        downloadLink.download = nameWithExtension;
        downloadLink.textContent = name;

        // Emulate Click
        const event = new MouseEvent('click', {
            view: window,
            bubbles: true,
            cancelable: false,
        });

        // Dispatch Event
        downloadLink.dispatchEvent(event);
    },
};

/**
 * --------------------------
 * Errors Manager.
 * -------------------------- 
 */
const QuickRequestErrors = {

    config: {
        errors: {},
    },

    setErrors: function(errors){
        this.config.errors = errors;
        return this;
    },

    toArray: function(){
        let errors = [];
        for (const [key, value] of Object.entries(this.config.errors)) {
            errors.push({
                [key]: value
            })
        }
        return errors;
    },

    toArrayflatten: function(){
        let errors = [];
        for (const [key, value] of Object.entries(this.config.errors)) {
            if (Array.isArray(value)) {
                value.forEach(element => {
                    errors.push({
                        [key]: element
                    })
                });
            } else {
                errors.push({
                    [key]: value
                })
            }
        }
        return errors;
    },

}

/**
 * --------------------------
 * Accessor QuickRequestMain
 * -------------------------- 
 */
const QuickRequest = new QuickRequestMain();