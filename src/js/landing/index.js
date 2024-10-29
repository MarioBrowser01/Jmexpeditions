//-----------------------------------------------------------SCROLL
document.addEventListener("DOMContentLoaded", () => {
    const animatedSections = document.querySelectorAll(".animate-section");

    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.2 // Ajusta este valor si deseas que se active antes
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const animationClass = entry.target.getAttribute("data-animation");
                entry.target.classList.add("animate__animated", animationClass);
                entry.target.style.visibility = 'visible'; // Asegura que el elemento sea visible
                observer.unobserve(entry.target); // Omitir esta línea para que se repita al salir y entrar
            } else {
                entry.target.style.visibility = 'hidden'; // Oculta nuevamente cuando sale
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    animatedSections.forEach(section => observer.observe(section));
});


// -------------------------------------------------------FIN SCROLL




// seccion de testimonios
document.addEventListener("DOMContentLoaded", function() {
    const swiper = new Swiper(".swiper-container", {
        loop: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1, // Muestra un testimonio a la vez en pantallas pequeñas
            },
            768: {
                slidesPerView: 2, // Muestra dos testimonios en pantallas medianas
            },
            1024: {
                slidesPerView: 3, // Muestra tres testimonios en pantallas grandes
            }
        }
    });
});
// seccion de testimonios FIN

// -----------------------------------------------SECCION DE PEGUNTAS FRECUENTES
$(document).ready(function(){
    $(".faq-question").click(function() {
        const answer = $(this).next(".faq-answer");
        const icon = $(this).find(".toggle-icon i");

        // Alternar la visualización de la respuesta
        answer.slideToggle();

        // Cambiar el icono de acuerdo a la visibilidad
        icon.toggleClass("fa-chevron-down fa-chevron-up");

        // Cerrar las demás respuestas
        $(".faq-answer").not(answer).slideUp();
        $(".toggle-icon i").not(icon).removeClass("fa-chevron-up").addClass("fa-chevron-down");
    });
});
// -----------------------------------------------SECCION DE PEGUNTAS FRECUENTES
