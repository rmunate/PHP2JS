import { Helpers } from "./Helpers.js";
import { Versions } from "./Versions.js";

/**
 * Function to handle version changes in the documentation.
 * @param {string} prevUrl - The previous URL.
 * @returns {string} - The current URL.
 */
export const Change = (prevUrl) => {

    // Get the current URL
    const currentUrl = Helpers.urlPathName();

    // Check if the current URL is different from the previous one
    if (currentUrl !== prevUrl) {

        // Get the base URL
        const baseUrl = Helpers.baseUrl();

        // Determine the current version
        let { name, link, alert } = Versions.v3; // Default to v3

        if (currentUrl.includes('/v2/')) {
            ({ name, link, alert } = Versions.v2);
        } else if (currentUrl.includes('/v3/')) {
            ({ name, link, alert } = Versions.v3);
        } else {
            ({ name, link, alert } = Versions.current);
        }

        // Get elements to modify
        const navLink = document.getElementsByClassName('VPLink link VPNavBarMenuLink');
        const anchorLink = navLink[0];
        const anchorText = navLink[0].children[0];

        // Change the name and styles of the link
        anchorText.textContent = 'Docs ' + name;
        anchorText.style = "font-weight: 500; color: #787bb3"

        // Change the link
        anchorLink.href = baseUrl + link;

        // Insert the alert
        const space = document.querySelector('.spacer');
        if (space) {
            space.innerHTML = alert;
        }

    }
    
    // Return the current URL
    return currentUrl;
};
