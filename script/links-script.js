const type1 = document.querySelector(".type1");
const select1 = document.querySelector(".select1");


const userSelected = function() {
    console.log("user selected");
    //create a new option and append it to the select list
    const newOption = document.createElement('option');
    newOption.value = "John Doe";
    newOption.innerText = "John Doe";
    select1.appendChild(newOption);
}

const typeSelected = function() {
    console.log("type selected");
    
    let type1Value =  type1.value;

    console.log(type1Value);

    //clear selection after every select
    select1.value = "";
    select1.innerText = "";

    if(type1Value == "user") {
        userSelected();
    }
    
}


type1.addEventListener("change", typeSelected);
