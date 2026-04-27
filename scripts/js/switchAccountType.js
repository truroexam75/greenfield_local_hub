export function switchAccountTypeEvent(eventElement, submitElement, switchHintElement) {
    eventElement.addEventListener("click", () => {
        let serviceName = "", targetName = "", switchTargetName = "", switchHint = "", actionName = "";

        // Finds the current action, which could be sign up or sign in
        actionName = submitElement.name.match(/sign_.{2}/g)[0];
    
        // Formats the action name by replacing the underscore with
        // a space
        actionName = actionName.replace("_", " ");
        actionName = actionName.charAt(0).toUpperCase() + actionName.slice(1)

        // Checks what account type the user is switching from
        if (eventElement.innerHTML.includes("dashboard")) {
            serviceName = "market";
            targetName = "producer";
            switchTargetName = "customer";
        } else if (eventElement.innerHTML.includes("market")) {
            serviceName = "dashboard";
            targetName = "customer";
            switchTargetName = "producer";
        }

        // Brief message for the user, telling them that if the
        // current account type is incorrect, they can switch
        switchHint = `Are you a ${switchTargetName}? ${actionName} here to access the ${serviceName}.`
        
        // Switches the button contents and switching hint to the
        // other account type
        eventElement.innerHTML = `${actionName} to ${serviceName}`;
        switchHintElement.innerHTML = switchHint;

        // Searches for either potential target using a regular
        // expression, removes it, then puts the current target name
        // in the element name. 
        submitElement.name = submitElement.name.replace(/producer|customer/g, targetName);
    });
}
