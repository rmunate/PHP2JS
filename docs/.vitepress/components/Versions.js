import { Alerts } from "./Alerts.js";
import { Helpers } from "./Helpers.js";

export const Versions = {

    "v2": {
        name: '^2.6',
        link: '/v2/',
        alert: Alerts.warning({
            title: "PLEASE UPGRADE TO THE LATEST VERSION",
            body: [
                "This version of the package is obsolete; it no longer receives support or new developments. Please migrate to the current version."
            ],
            link : {
                href: Helpers.baseUrl() + '/v4/',
                text: "Explore Latest Version",
            }
        })
    },

    "v3": {
        name: '^3.8',
        link: '/v3/',
        alert: Alerts.warning({
            title: "PLEASE UPGRADE TO THE LATEST VERSION",
            body: [
                "This version of the package is obsolete; it no longer receives support or new developments. Please migrate to the current version."
            ],
            link : {
                href: Helpers.baseUrl() + '/v4/',
                text: "Explore Latest Version",
            }
        })
    },

    "current": {
        name: '^4.0',
        link: '/v4/',
        alert: Alerts.success({
            title: "QUICKREQUEST RELEASED",
            image:  Helpers.baseUrl() + "/public/quick-request.jpeg",
            body: [
                "A lightweight tool for swift and simple Laravel backend requests. Easy and straightforward."
            ]
        })
    },
};