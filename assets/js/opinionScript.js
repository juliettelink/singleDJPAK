
// Les étoiles pour avis

//fonction pour configurer les étoiles pour les avis récents
function setupRecentStarRating() {
  // On cherche les étoiles pour les avis récents
  const recentStarRatingElements = document.querySelectorAll(".recent-star-rating");

  //on récupere la note et on appelle converToStars
  recentStarRatingElements.forEach((element) => {
    const note = parseInt(element.getAttribute("data-note"));
    convertToStars(note, element);
  });
}

//fonction pour convertir la note en étoiles
function convertToStars(note, starRatingElement) {
  // Supprimer les anciennes étoiles s'il y en a
  while (starRatingElement.firstChild) {
    starRatingElement.removeChild(starRatingElement.firstChild);
  }

  //creation de l'etoile en fonction de la note
  for (let i = 1; i <= 5; i++) {
    const star = document.createElement("span");
    star.classList.add("la-star");
    star.setAttribute("data-value", i);

    //definir les couleurs
    if (i <= note) {
      star.style.color = "yellow";
      star.classList.add("las");
      star.classList.remove("lar");
    } else {
      star.style.color = "black";
      star.classList.add("lar");
      star.classList.remove("las");
    }

    //ajoute l'etoile à l'element parent
    starRatingElement.appendChild(star);
  }
}

//fonction pour configurer les étoiles dans le FORMULAIRE
function setupStarRating() {
  //on cherche les étoiles
  const stars = document.querySelectorAll(".la-star");

  // on va chercher l'input
  const note = document.querySelector("#note");

  // on boucle sur les étoiles pour ajouter des écouteurs d'évenments
  for (const star of stars) {
    // on écoute le survol
    star.addEventListener("mouseover", function () {
      resetStars();
      this.style.color = "yellow";
      this.classList.add("las");
      this.classList.remove("lar");

      // element précédent du DOM
      let previousStar = this.previousElementSibling;

      // pour passer en jaune les étoiles qui précedent
      while (previousStar) {
        previousStar.style.color = "yellow";
        previousStar.classList.add("las");
        previousStar.classList.remove("lar");
        previousStar = previousStar.previousElementSibling;
      }
    });

    // on écoute le clic
    star.addEventListener("click", function () {
      note.value = this.dataset.value;
    });

    star.addEventListener("mouseout", function () {
      resetStars(note.value);
    });
  }

  function resetStars(note = 0) {
    //boucle sur chaques étoiles
    for (const star of stars) {
      if (star.dataset.value > note) {
        star.style.color = "black";
        star.classList.add("lar");
        star.classList.remove("las");
      } else {
        star.style.color = "yellow";
        star.classList.add("las");
        star.classList.remove("lar");
      }
    }
  }
}
//attend que la page soit chargée
window.onload = () => {
  setupStarRating(); //configure les étoiles du formulaire
  setupRecentStarRating(); // configure les étoiles des avis récents
};
