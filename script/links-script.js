const firstTypeDropdownSelector = document.querySelector(".first-type-dropdown-selector");
const secondTypeDropdownSelector = document.querySelector(".second-type-dropdown-selector");
const userFirstSelectionDropdown = document.querySelector(".links-user-first-selection-dropdown");
const userSecondSelectionDropdown = document.querySelector(".links-user-second-selection-dropdown");
const equipmentFirstSelectionDropdown = document.querySelector(".links-equipment-first-selection-dropdown");
const equipmentSecondSelectionDropdown = document.querySelector(".links-equipment-second-selection-dropdown");
const iP_FirstSelectionDropdown = document.querySelector(".links-ip-first-selection-dropdown");
const iP_SecondSelectionDropdown = document.querySelector(".links-ip-second-selection-dropdown");
const serverFirstSelectionDropdown = document.querySelector(".links-server-first-selection-dropdown");
const locationFirstSelectionDropdown = document.querySelector(".links-location-first-selection-dropdown");
const locationSecondSelectionDropdown = document.querySelector(".links-location-second-selection-dropdown");
const passwordsFirstSelectionDropdown = document.querySelector(".links-passwords-first-selection-dropdown");
const passwordsSecondSelectionDropdown = document.querySelector(".links-passwords-second-selection-dropdown");
const serverSecondSelectionDropdown = document.querySelector(".links-server-second-selection-dropdown");

const userSelect1Dropdown = document.querySelector(".user-select1-dropdown");
const equipmentSelect1Dropdown = document.querySelector(".equipment-select1-dropdown");
const iP_Select1Dropdown = document.querySelector(".ip-select1-dropdown");
const serverSelect1Dropdown = document.querySelector(".server-select1-dropdown");
const locationsSelect1Dropdown = document.querySelector(".locations-select1-dropdown");
const passwordSelect1Dropdown = document.querySelector(".passwords-select1-dropdown");

const userSelect2Dropdown = document.querySelector(".user-select2-dropdown");
const equipmentSelect2Dropdown = document.querySelector(".equipment-select2-dropdown");
const iP_Select2Dropdown = document.querySelector(".ip-select2-dropdown");
const serverSelect2Dropdown = document.querySelector(".server-select2-dropdown");
const locationSelect2Dropdown = document.querySelector(".location-select2-dropdown");
const passwordSelect2Dropdown = document.querySelector(".passwords-select2-dropdown");

const submitButton = document.querySelector(".submit-button");
const userFirstSelectHTML_Payload = document.querySelector(".user-first-select-payload");
const userSecondSelectHTML_Payload = document.querySelector(".user-second-select-payload");

// Global Variable
let userFirstSelection;
let userSecondSelection;
let userFirstSelectionType;
let userSecondSelectionType;
let userFirstSelectionID;
let userSecondSelectionID;

const hideAllFirstSelectedDropdowns = function() {
    userFirstSelectionDropdown.style.display = "none";
    equipmentFirstSelectionDropdown.style.display = "none";
    iP_FirstSelectionDropdown.style.display = "none";
    serverFirstSelectionDropdown.style.display = "none";
    locationFirstSelectionDropdown.style.display = "none";
    passwordsFirstSelectionDropdown.style.display = "none";
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
    iP_FirstSelectionDropdown.style.display = "block";
}
const firstTypeServerSelected = function() {
    console.log("Server Selected");
    serverFirstSelectionDropdown.style.display = "block";
}
const firstTypeLocationsSelected = function() {
    console.log("Locations Selected");
    locationFirstSelectionDropdown.style.display = "block";
}
const firstTypePasswordSelected = function() {
    console.log("password selected");
    passwordsFirstSelectionDropdown.style.display = "block";
}
const firstTypeIP_Selected = function() {
    console.log('IP Selected');
}
const firstTypeUpdateSelected = function() {
    console.log('Update Selected');
}
const firstTypeOtherSelected = function() {
    console.log("First Type Other Selected");
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
        firstTypeLocationsSelected();
    }else if(firstTypeSelected == "password") {
        firstTypePasswordSelected();
    }else if(firstTypeSelected == "ip") {
        firstTypeIP_Selected();
    }else if(firstTypeSelected == "update") {
        firstTypeUpdateSelected();
    }else if(firstTypeSelected == "other") {
        firstTypeOtherSelected();
    }    
}
const hideAllSecondSelectedDropdowns = function() {
    userSecondSelectionDropdown.style.display = "none";
    equipmentSecondSelectionDropdown.style.display = "none";
    iP_SecondSelectionDropdown.style.display = "none";
    serverSecondSelectionDropdown.style.display = "none";
    locationSecondSelectionDropdown.style.display = "none";
    passwordsSecondSelectionDropdown.style.display = "none";
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
    console.log("Second location selected");
    locationSecondSelectionDropdown.style.display = "block";
}
const secondTypePasswordsSelected = function() {
    console.log("Second Type Password Selected");
    passwordsSecondSelectionDropdown.style.display = "block";
}
const secondTypeUpdateSelected = function() {
    console.log("Second Type Update Selected");
}
const secondTypeOtherSelected = function() {
    console.log("Second Type Other Selected");
}


const secondTypeDropdownSelectorSelected = function() {
    console.log("Second type dropdown selector selected");    
    hideAllSecondSelectedDropdowns();

    let secondTypeSelected =  secondTypeDropdownSelector.value;

    console.log(secondTypeSelected);

    if(secondTypeSelected == "user") {
        secondTypeUserSelected();
    }else if(secondTypeSelected == "equipment") {
        secondTypeEquipmentSelected();
    }else if(secondTypeSelected == "ip-and-port") {
        secondTypeIP_AndPortSelected();
    }else if(secondTypeSelected == "server") {
        secondTypeServerSelected();
    }else if(secondTypeSelected == "location") {
        secondTypeLocationSelected();
    }else if(secondTypeSelected == "password") {
        secondTypePasswordsSelected();
    }else if(secondTypeSelected == "update") {
        secondTypeUpdateSelected();
    }else if(secondTypeSelected == "other") {
        secondTypeOtherSelected();
    }
}

const getDBID = function(string) {    
    const regex = /DBID:\s*(\d+)/;
    const match = string.match(regex);
    if (match && match[1]) {
        return match[1]; 
    }   
    return null; 
}

const userFirstSelectionDropdownSelected = function() {
    console.log("User First Selection Dropdown Selected");
    userFirstSelection = userSelect1Dropdown.value;        
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "user";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);    
}

const equipmentFirstSelectionDropdownSelected = function() {
    console.log("Equipment First Selection Dropdown Selected");
    userFirstSelection = equipmentSelect1Dropdown.value;    
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "equipment";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);    
}

const iP_FirstSelectionDropdownSelected = function() {
    console.log("IP First Selection Dropdown Selected");
    userFirstSelection = iP_Select1Dropdown.value;
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "ip";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);  
}

const serverFirstSelectionDropdownSelected = function() {
    console.log("Server First Selection Dropdown Selected");
    userFirstSelection = serverSelect1Dropdown.value;
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "server";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);  
}

const locationFirstSelectionDropdownSelected = function() {
    console.log("Location First Selection Dropdown Selected");
    userFirstSelection = locationsSelect1Dropdown.value;
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "location";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);  
}

const passwordFirstSelectionDropdownSelected = function() {
    console.log("Location First Selection Dropdown Selected");
    userFirstSelection = passwordSelect1Dropdown.value;
    let dBID = getDBID(userFirstSelection);    
    userFirstSelectionType = "password";
    userFirstSelectionID = dBID;
    console.log("User First Selection: " + userFirstSelection + " Type: " + userFirstSelectionType + " ID: " + userFirstSelectionID);  
}


// Second Selection


const userSecondSelectionDropdownSelected = function() {
    console.log("User Second Selection Dropdown Selected");
    userSecondSelection = userSelect2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "user";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const equipmentSecondSelectionDropdownSelected = function() {
    console.log("Equipment Second Selection Dropdown Selected");
    userSecondSelection = equipmentSelect2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "equipment";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const iP_SecondSelectionDropdownSelected = function() {
    console.log("IP Second Selection Dropdown Selected");
    userSecondSelection = iP_Select2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "ip";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const serverSecondSelectionDropdownSelected = function() {
    console.log("Server Second Selection Dropdown Selected");
    userSecondSelection = serverSelect2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "server";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const locationSecondSelectionDropdownSelected = function() {
    console.log("Location Second Selection Dropdown Selected");
    userSecondSelection = locationSelect2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "location";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const passwordSelect2DropdownSelected = function() {
    console.log("Passwords Second Selection Dropdown Selected");
    userSecondSelection = passwordSelect2Dropdown.value;
    let dBID = getDBID(userSecondSelection);    
    userSecondSelectionType = "password";
    userSecondSelectionID = dBID;
    console.log("User Second Selection: " + userSecondSelection + " Type: " + userSecondSelectionType + " ID: " + userSecondSelectionID);
}

const submitButtonClicked = function() {
    console.log("Submit Button Clicked");
    console.log("User First Selection: " + userFirstSelection);
    console.log("User Second Selection: " + userSecondSelection);
    console.log("Copying to html...");
    userFirstSelectHTML_Payload.value = userFirstSelectionType + " " + userFirstSelectionID;
    userSecondSelectHTML_Payload.value = userSecondSelectionType + " " + userSecondSelectionID;
}

firstTypeDropdownSelector.addEventListener("change", firstTypeDropdownSelectorSelected);
secondTypeDropdownSelector.addEventListener("change", secondTypeDropdownSelectorSelected);

userFirstSelectionDropdown.addEventListener("change", userFirstSelectionDropdownSelected);
equipmentFirstSelectionDropdown.addEventListener("change", equipmentFirstSelectionDropdownSelected);
iP_FirstSelectionDropdown.addEventListener("change", iP_FirstSelectionDropdownSelected);
serverFirstSelectionDropdown.addEventListener("change", serverFirstSelectionDropdownSelected);
locationFirstSelectionDropdown.addEventListener("change", locationFirstSelectionDropdownSelected);
passwordsFirstSelectionDropdown.addEventListener("change", passwordFirstSelectionDropdownSelected);

userSecondSelectionDropdown.addEventListener("change", userSecondSelectionDropdownSelected);
equipmentSecondSelectionDropdown.addEventListener("change", equipmentSecondSelectionDropdownSelected);
iP_SecondSelectionDropdown.addEventListener("change", iP_SecondSelectionDropdownSelected);
serverSecondSelectionDropdown.addEventListener("change", serverSecondSelectionDropdownSelected);
locationSecondSelectionDropdown.addEventListener("change", locationSecondSelectionDropdownSelected);
passwordsSecondSelectionDropdown.addEventListener("change", passwordSelect2DropdownSelected);

submitButton.addEventListener("click", submitButtonClicked);
