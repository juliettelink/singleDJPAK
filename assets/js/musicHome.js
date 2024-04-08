document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('myAudio');
    var playPauseButton = document.getElementById('play-pause');

    // Fonction pour gérer la lecture et la pause de l'audio
    function togglePlayPause() {
        if (audio.paused) {
            audio.play();
            playPauseButton.textContent = '❚❚'; // Met à jour le bouton pour afficher le symbole de pause
        } else {
            audio.pause();
            playPauseButton.textContent = '▶'; // Met à jour le bouton pour afficher le symbole de lecture
        }
    }

    // Mettre à jour le bouton au chargement de la page
    if (audio.paused) {
        playPauseButton.textContent = '▶'; // Afficher le symbole de lecture si l'audio est en pause
    } else {
        playPauseButton.textContent = '❚❚'; // Afficher le symbole de pause si l'audio est en lecture
    }

    // Ajouter un événement clic au bouton de lecture/pause
    playPauseButton.addEventListener('click', togglePlayPause);
});
