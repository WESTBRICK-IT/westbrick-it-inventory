const userButton = document.querySelector(".users-button");
const equipmentButton = document.querySelector(".equipment-button");
const locationsButton = document.querySelector(".locations-button");
const serversButton = document.querySelector(".servers-button");
// const allButton = document.querySelector(".all-button");
// const monitorsButton = document.querySelector(".monitors-button");
// const printersButton = document.querySelector(".printers-button");
const passwordsButton = document.querySelector(".passwords-button");
const iP_AndPortsButton = document.querySelector(".ip-and-ports-button");
const linksButton = document.querySelector(".links-button");
// const spareInventoryButton = document.querySelector(".spare-inventory-button");
const userButtonClick = function() {
    window.location.href = "./users/";
}
const equipmentButtonClick = function() {
    window.location.href = "./equipment/";
}
const locationsButtonClick = function() {
    window.location.href = "./locations/";
}
const serversButtonClick = function() {
    window.location.href = "./servers/";
}
// const allButtonClick = function() {
//     window.location.href = "./all/";
// }
// const monitorsButtonClick = function() {
//     window.location.href = "./monitors/";
// }
// const printersButtonClick = function() {
//     window.location.href = "./printers/";
// }
const passwordsButtonClick = function() {
    window.location.href = "./passwords/";
}
const iP_AndPortsButtonClick = function() {
    window.location.href = "./ip-and-ports/";
}
const linksButtonClick = function() {
    window.location.href = "./links/";
}
// const spareInventoryButtonClick = function() {
//     window.location.href = "./spare-inventory/";
// }
userButton.addEventListener("click", userButtonClick);
equipmentButton.addEventListener("click", equipmentButtonClick);
locationsButton.addEventListener("click", locationsButtonClick);
serversButton.addEventListener("click", serversButtonClick);
// allButton.addEventListener("click", allButtonClick);
// monitorsButton.addEventListener("click", monitorsButtonClick);
// printersButton.addEventListener("click", printersButtonClick);
passwordsButton.addEventListener("click", passwordsButtonClick);
iP_AndPortsButton.addEventListener("click", iP_AndPortsButtonClick);
linksButton.addEventListener("click", linksButtonClick);
// spareInventoryButton.addEventListener("click", spareInventoryButtonClick);