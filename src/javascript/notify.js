document.addEventListener('DOMContentLoaded', function () {
    // Mostrar la notificación
    $.notify({
        icon: "icon-bell",
        title: "Éxito",
        message: decodeURIComponent("<?php echo $_GET['message']; ?>")
    }, {
        type: "success",
        placement: {
            from: "top",
            align: "center"
        },
        time: 5000
    });

    console.log("URL original: ", window.location.href);

    var url = new URL(window.location.href);
    url.searchParams.delete('message');
    window.history.replaceState({}, document.title, url.toString());

    console.log("URL actualizada: ", url.toString());
    //Mostrar en consola el message
    console.log("Mensaje: ", decodeURIComponent("<?php echo $_GET['message']; ?>"));
});
