const goBackButton = document.querySelector(".go-back-button");
const goBackButtonClick = function() {
    window.location.href = "../";
}
goBackButton.addEventListener("click", goBackButtonClick);