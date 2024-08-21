const firstTypeDropdownSelector = document.querySelector(".firstTypeDropdownSelector");
const secondTypeDropdownSelector = document.querySelector(".secondTypeDropdownSelector");
const userFirstSelectionDropdown = document.querySelector(".links-user-first-selection-dropdown");
const equipmentFirstSelectionDropdown = document.querySelector(".links-equipment-first-selection-dropdown");
const ipFirstSelectionDropdown = document.querySelector(".links-ip-first-selection-dropdown");
const serverFirstSelectionDropdown = document.querySelector(".links-server-first-selection-dropdown");
const locationFirstSelectionDropdown = document.querySelector(".links-locations-first-selection-dropdown");
const passwordFirstSelectionDropdown = document.querySelector(".links-passwords-first-selection-dropdown");
const userSecondSelectionDropdown = document.querySelector(".links-user-second-selection-dropdown");
const equipmentSecondSelectionDropdown = document.querySelector(".links-equipment-second-selection-dropdown");
const iP_SecondSelectionDropdown = document.querySelector(".links-ip-second-selection-dropdown");
const serverSecondSelectionDropdown = document.querySelector(".links-server-second-selection-dropdown");
const locationSecondSelectionDropdown = document.querySelector(".links-locations-second-selection-dropdown");
const passwordSecondSelectionDropdown = document.querySelector(".links-passwords-second-selection-dropdown");

const hideAllFirstSelectedDropdowns = function() {
    userFirstSelectionDropdown.style.display = "none";
    equipmentFirstSelectionDropdown.style.display = "none";
    ipFirstSelectionDropdown.style.display = "none";
    serverFirstSelectionDropdown.style.display = "none";
    locationFirstSelectionDropdown.style.display = "none";
    passwordFirstSelectionDropdown.style.display = "none";
}
const firstTypeUserSelected = function() {
    console.log("user selected");
    //create a new option and append it to the select list
    userFirstSelectionDropdown.style.display = "block";
}
const firstTypeEquipmentSelected = function() {
    console.log("equipment selected");
    equipmentFirstSelectionDropdown.style.display = "block";
}
const firstTypeIPAndPortSelected = function() {
    console.log("IP and Port Selected");
    ipFirstSelectionDropdown.style.display = "block";
}
const firstTypeServerSelected = function() {
    console.log("Server Selected");
    serverFirstSelectionDropdown.style.display = "block";
}
const firstTypeLocationSelected = function() {
    console.log("Location Selected");
    locationFirstSelectionDropdown.style.display = "block";
}
const firstTypePasswordSelected = function() {
    console.log("password selected");
    passwordFirstSelectionDropdown.style.display = "block";
}

const firstTypeDropdownSelectorSelected = function() {
    console.log("First type dropdown selector selected");
    //reset all first selection dropdowns to reset for the displaying of the next dropdown
    hideAllFirstSelectedDropdowns();
    let firstTypeSelected =  firstTypeDropdownSelector.value;

    console.log(firstTypeSelected);    

    if(firstTypeSelected == "user") {
        firstTypeUserSelected();
    }else if(firstTypeSelected == "equipment") {
        firstTypeEquipmentSelected();
    }else if(firstTypeSelected == "ip-and-port") {
        firstTypeIPAndPortSelected();
    }else if(firstTypeSelected == "server") {
        firstTypeServerSelected();
    }else if(firstTypeSelected == "location") {
        firstTypeLocationSelected();
    }else if(firstTypeSelected == "password") {
        firstTypePasswordSelected();
    }
    
}
const hideAllSecondSelectedDropdowns = function() {
    userSecondSelectionDropdown.style.display = "none";
    equipmentSecondSelectionDropdown.style.display = "none";
    iP_SecondSelectionDropdown.style.display = "none";
    serverSecondSelectionDropdown.style.display = "none";
    locationSecondSelectionDropdown.style.display = "none";
    passwordSecondSelectionDropdown.style.display = "none";
}
const secondTypeUserSelected = function() {
    console.log("Second Type User Selected");
    userSecondSelectionDropdown.style.display = "block";
}
const secondTypeEquipmentSelected = function() {
    console.log("Second Type Equipment Selected");
    equipmentSecondSelectionDropdown.style.display = "block";
}
const secondTypeIP_AndPortSelected = function() {
    console.log("Second Type IP and Port Selected");
    iP_SecondSelectionDropdown.style.display = "block";
}
const secondTypeServerSelected = function() {
    console.log("Second type server selected");
    serverSecondSelectionDropdown.style.display = "block";
}
const secondTypeLocationSelected = function() {
    console.log("Second locations selected");
    locationSecondSelectionDropdown.style.display = "block";
}
const secondTypePasswordSelected = function() {
    console.log("Second Type Password Selected");
    passwordSecondSelectionDropdown.style.display = "block";
}
const secondTypeDropdownSelectorSelected = function() {
    console.log("Second type dropdown selector selected");
    hideAllSecondSelectedDropdowns();

    let secondTypeSelected =  secondTypeDropdownSelector.value;

    console.log(secondTypeSelected);

    if(secondTypeSelected == "user2") {
        secondTypeUserSelected();
    }else if(secondTypeSelected == "equipment2") {
        secondTypeEquipmentSelected();
    }else if(secondTypeSelected == "ip2") {
        secondTypeIP_AndPortSelected();
    }else if(secondTypeSelected == "server2") {
        secondTypeServerSelected();
    }else if(secondTypeSelected == "location2") {
        secondTypeLocationSelected();
    }else if(secondTypeSelected == "password2") {
        secondTypePasswordSelected();
    }
}


firstTypeDropdownSelector.addEventListener("change", firstTypeDropdownSelectorSelected);
secondTypeDropdownSelector.addEventListener("change", secondTypeDropdownSelectorSelected);