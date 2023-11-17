export const Helpers = {

    //Base URL
    baseUrl: () => {
        const currentURL = window.location.pathname;
        return currentURL.split('/v')[0]
    },

    // PatName de la URL
    urlPathName: () => {
        return window.location.pathname
    }

}