const type1 = document.querySelector(".type1");
const userFirstSelectionDropdown = document.querySelector(".links-user-first-selection-dropdown");

const userSelected = function() {
    console.log("user selected");
    //create a new option and append it to the select list
    userFirstSelectionDropdown.style.display = "block";
}

const typeSelected = function() {
    console.log("type selected");
    
    let type1Value =  type1.value;

    console.log(type1Value);    

    if(type1Value == "user") {
        userSelected();
    }
    
}


type1.addEventListener("change", typeSelected);
