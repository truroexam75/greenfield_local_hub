import { switchAccountTypeEvent } from "./scripts/js/switchAccountType.js";

window.onload = () => {
    // If the page is the sign in or sign up page, then...
    // This is verified so that the elements aren't passed to the
    // functions if they don't exist due to not being on the
    // specified page.
    if (location.pathname.includes("sign")) {
        // Define the elements that are used in the imported
        // function/s, then send parameters
        let eventElement = document.querySelector("#switch-account-button");
        let submitElement = document.querySelector("#submit-button");
        let switchHintElement = document.querySelector("#switch-hint");

        switchAccountTypeEvent(eventElement, submitElement, switchHintElement);
    }
}