// Étape 1: obtenir le DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');
let pauseDom = document.getElementById('pause'); // Bouton de pause

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.carousel .list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
let timeRunning = 3000;
let timeAutoNext = 7000;
let runTimeOut;
let runNextAuto;

// Variable pour suivre l'état du carousel (en pause ou en lecture)
let isPaused = false;

// Gestionnaire d'événements pour les boutons "Next" et "Prev"
nextDom.onclick = function() {
    if (!isPaused) {
        showSlider('next');
    }
};

prevDom.onclick = function() {
    if (!isPaused) {
        showSlider('prev');
    }
};

// Gestionnaire d'événements pour le clic sur le bouton de pause
pauseDom.onclick = function() {
    isPaused = !isPaused; // Inverse l'état (passer de lecture à pause et vice versa)
    if (isPaused) {
        clearTimeout(runNextAuto); // Arrêter la lecture automatique
        pauseDom.textContent = "❚❚"; // Mettre à jour le texte du bouton en icône de pause
    } else {
        clearTimeout(runTimeOut); // Arrêter le délai d'exécution actuel
        runNextAuto = setTimeout(() => {
            nextDom.click();
        }, timeAutoNext);
        pauseDom.textContent = "▶"; // Mettre à jour le texte du bouton en icône de lecture
    }
};

// Fonction pour afficher le slider (next ou prev)
function showSlider(type) {
    let SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');
    
    if (type === 'next') {
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    } else {
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
    }
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);
}

// Démarrer la lecture automatique initiale
runNextAuto = setTimeout(() => {
    nextDom.click();
}, timeAutoNext);