import { Change } from "./NavbarReactive.js";

/**
 * Logic to change the name of the NavBar depending on
 * which version of the documentation we are in.
 */
var prevUrl = undefined;

// Periodically check for URL changes
setInterval(() => {
    prevUrl = Change(prevUrl);
}, 10);