let menuButton = document.querySelector("#nav-button");
let menu = document.querySelector("nav");
let header = document.querySelector("header");
let menuOpen = document.querySelector("#menu-open");
let menuClose = document.querySelector("#menu-close");

menuButton.addEventListener("click", function() {
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
        menu.classList.add("flex");
        menuOpen.classList.add("hidden");
        menuClose.classList.remove("hidden");

    } else if (menu.classList.contains("flex")) {
        menu.classList.remove("flex");
        menu.classList.add("hidden");
        menuOpen.classList.remove("hidden");
        menuClose.classList.add("hidden");
    }
})