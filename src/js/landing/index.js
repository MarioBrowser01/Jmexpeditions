

/***********************************Pacific model */
/***********************************VIDEO PRINCIPAL - INDEX  */
// Agregar funcionalidad de play/pausa al botón

document.addEventListener('DOMContentLoaded', function () {
    var video = document.getElementById('background-video');
    var muteButton = document.getElementById('mute-btn');
    var isMuted = true;  // El video inicia en silencio (muted)

    // Cambiar el icono y el estado del volumen
    muteButton.addEventListener('click', function () {
        if (isMuted) {
            video.muted = false;
            muteButton.innerHTML = '<i class="fas fa-volume-up fa-2x"></i>';
        } else {
            video.muted = true;
            muteButton.innerHTML = '<i class="fas fa-volume-mute fa-2x"></i>';
        }
        isMuted = !isMuted;
    });
});


/***********************************FIN - INDEX  */