document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("burger");
    const burgerIcon = document.getElementById("burgerIcon");
    const nav = document.getElementById("navLinks");

    // Si les éléments n'existent pas sur la page, on arrête (sécurité)
    if (!burger || !burgerIcon || !nav) return;

    // --- Réinitialisation au chargement de la page ---
    nav.classList.remove("active"); // ferme le menu s’il était resté ouvert
    burgerIcon.src = "/pictures/Burger.svg"; // remet le burger par défaut

    // --- Fonction d'ouverture/fermeture ---
    const toggleMenu = () => {
        const isActive = nav.classList.toggle("active");
        burgerIcon.src = isActive
            ? "/pictures/Croix.svg"
            : "/pictures/Burger.svg";
    };

    // --- Clic sur le bouton burger ---
    burger.addEventListener("click", toggleMenu);

    // --- Ferme le menu quand on clique sur un lien du menu ---
    nav.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
            nav.classList.remove("active");
            burgerIcon.src = "/pictures/Burger.svg";
        });
    });

    // --- Réinitialise le menu quand on quitte la page ---
    // (utile quand Symfony recharge le DOM)
    window.addEventListener("beforeunload", () => {
        nav.classList.remove("active");
        burgerIcon.src = "/pictures/Burger.svg";
    });
});
