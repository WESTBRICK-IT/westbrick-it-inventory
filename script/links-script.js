const type1 = document.querySelector(".type1");
const userFirstSelectionDropdown = document.querySelector(".links-user-first-selection-dropdown");
const equipmentFirstSelectionDropdown = document.querySelector(".links-equipment-first-selection-dropdown");
const ipFirstSelectionDropdown = document.querySelector(".links-ip-first-selection-dropdown");
const serverFirstSelectionDropdown = document.querySelector(".links-server-first-selection-dropdown");
const locationFirstSelectionDropdown = document.querySelector(".links-locations-first-selection-dropdown");
const passwordFirstSelectionDropdown = document.querySelector(".links-passwords-first-selection-dropdown");

const hideAllFirstSelectedDropdowns = function() {
    userFirstSelectionDropdown.style.display = "none";
    equipmentFirstSelectionDropdown.style.display = "none";
    ipFirstSelectionDropdown.style.display = "none";
    serverFirstSelectionDropdown.style.display = "none";
    locationFirstSelectionDropdown.style.display = "none";
    passwordFirstSelectionDropdown.style.display = "none";
}
const userSelected = function() {
    console.log("user selected");
    //create a new option and append it to the select list
    userFirstSelectionDropdown.style.display = "block";
}
const equipmentSelected = function() {
    console.log("equipment selected");
    equipmentFirstSelectionDropdown.style.display = "block";
}
const ipAndPortSelected = function() {
    console.log("IP and Port Selected");
    ipFirstSelectionDropdown.style.display = "block";
}
const serverSelected = function() {
    console.log("Server Selected");
    serverFirstSelectionDropdown.style.display = "block";
}
const locationSelected = function() {
    console.log("Location Selected");
    locationFirstSelectionDropdown.style.display = "block";
}
const passwordSelected = function() {
    console.log("password selected");
    passwordFirstSelectionDropdown.style.display = "block";
}

const typeSelected = function() {
    console.log("type selected");
    //reset all first selection dropdowns to reset for the displaying of the next dropdown
    hideAllFirstSelectedDropdowns();
    let type1Value =  type1.value;

    console.log(type1Value);    

    if(type1Value == "user") {
        userSelected();
    }else if(type1Value == "equipment") {
        equipmentSelected();
    }else if(type1Value == "ip-and-port") {
        ipAndPortSelected();
    }else if(type1Value == "server") {
        serverSelected();
    }else if(type1Value == "location") {
        locationSelected();
    }else if(type1Value == "password") {
        passwordSelected();
    }
    
}


type1.addEventListener("change", typeSelected);
