//Programmed by Chris Barber August 1 2024
const goBackButton = document.querySelector(".go-back-button");
const garbageBin = document.querySelectorAll(".garbage-can");
// const firstDropdown = document.querySelector(".first-dropdown");
// const secondDropdown = document.querySelector(".second-dropdown");
const goBackButtonClick = function() {
    window.location.href = "../";
}
goBackButton.addEventListener("click", goBackButtonClick);
function getFirstWord(str) {
    // Use trim() to remove leading/trailing whitespace, then split by spaces.
    const words = str.trim().split(/\s+/);
    
    // Return the first word, or an empty string if there are no words.
    return words.length > 0 ? words[0] : '';
}
const garbageBinClick = function() {
    let userResponse = confirm("Are you sure you want to delete this item?");
    console.log("garbage button click");
    console.log(this.getAttribute("alt"));
    let garbageCanNumberString = this.getAttribute("alt");
    let firstWord = getFirstWord(garbageCanNumberString);
    let table = firstWord;
    let garbageCanNumber = garbageCanNumberString.match(/\d+$/);
    console.log(garbageCanNumber);
    if (userResponse) {
        console.log("Item selected for deletion." + "./PHP/delete-item.php?id=" + garbageCanNumber + "&table=" + table);
        window.location.href = "../php/delete-item.php?id="+ garbageCanNumber + "&table=" + table;
        // Add code here to delete the item from the list or perform any other actions
    } else {
        console.log("Deletion cancelled.");
    }
}
for(i = 0; i < garbageBin.length; i++) {
    garbageBin[i].addEventListener("click", garbageBinClick);
}

// const firstDropdownSelected = function() {
//     console.log("hello");
// }
// firstDropdown.addEventListener('change', firstDropdownSelected);