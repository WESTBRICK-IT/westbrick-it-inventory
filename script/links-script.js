const type1 = document.querySelector(".type1");
const userFirstSelectionDropdown = document.querySelector(".links-user-first-selection-dropdown");
const equipmentFirstSelectionDropdown = document.querySelector(".links-equipment-first-selection-dropdown");

const hideAllFirstSelectedDropdowns = function() {
    userFirstSelectionDropdown.style.display = "none";
    equipmentFirstSelectionDropdown.style.display = "none";
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
    }
    
}


type1.addEventListener("change", typeSelected);
