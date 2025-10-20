document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("burger");
    const burgerIcon = document.getElementById("burgerIcon");
    const nav = document.getElementById("navLinks");

    burger.addEventListener("click", () => {
        nav.classList.toggle("active");

        if (nav.classList.contains("active")) {
            burgerIcon.src = "/pictures/Croix.svg"; // croix
        } else {
            burgerIcon.src = "/pictures/Burger.svg"; // burger
        }
    });
});