const userButton = document.querySelector(".users-button");
const userButtonClick = function(){
    window.location.href = "../users";
}
userButton.addEventListener("click", userButtonClick);