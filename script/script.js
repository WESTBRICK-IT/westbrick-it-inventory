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
const userLocationButton = document.querySelector(".user-location-button");
const userEquipmentButton = document.querySelector(".user-equipment-button");
const userPasswordButton = document.querySelector(".user-password-button");
const userComputerIP_Button = document.querySelector(".user-computer-ip-button");
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
const userLocationButtonClick = function() {
    window.location.href = "./user-location/";
}
const userEquipmentButtonClick = function() {
    window.location.href = "./user-equipment/";
}
const userPasswordButtonClick = function() {
    window.location.href = "./user-passwords/";
}
const userComputerIP_ButtonClick = function() {
    window.location.href = "./user-computer-ip/";
}
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
userLocationButton.addEventListener("click", userLocationButtonClick);
userEquipmentButton.addEventListener("click", userEquipmentButtonClick);
userPasswordButton.addEventListener("click", userPasswordButtonClick);
userComputerIP_Button.addEventListener("click", userComputerIP_ButtonClick);