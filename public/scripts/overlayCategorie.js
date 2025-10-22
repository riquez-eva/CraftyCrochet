const btn = document.getElementById('categorieBtn');
const overlay = document.getElementById('categorieOverlay');
const closeBtn = document.getElementById('closeOverlay');

btn.addEventListener('click', (e) => {
    e.preventDefault();
    overlay.classList.add('active'); // ajoute la classe pour l'afficher
});

closeBtn.addEventListener('click', () => {
    overlay.classList.remove('active');
});

// Fermer si clic à l'extérieur du contenu
overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('active');
});
