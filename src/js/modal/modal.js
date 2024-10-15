/*function cancelarActualizacion(entity) {
    // Mostrar el modal de confirmación
    Swal.fire({
        title: "Cancelado",
        text: `${entity} no actualizada.`,
        icon: "info",
        confirmButtonText: "Aceptar",
        customClass: {
            confirmButton: "btn btn-primary"
        },
        buttonsStyling: false
    }).then(() => {
        // Ocultar el formulario de actualización
        document.getElementById('form_actualizar').style.display = 'none';

        // Mostrar el formulario de registro
        document.getElementById('form_registrar').style.display = 'block';

        // Desplazarse al formulario de registro
        document.getElementById('form_registrar').scrollIntoView({ behavior: 'smooth' });
    });
}*/




/*
$(document).on("click", ".btn_eliminar_categoria", function(e) {
    e.preventDefault(); // Prevenir la acción predeterminada del botón
    const href = $(this).attr("href"); // Obtener la URL del enlace

    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar",
        customClass: {
            confirmButton: "btn btn-success g-2",
            cancelButton: "btn btn-danger g-2"
        },
        buttonsStyling: "btn btn-success"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Eliminado!",
                text: "La categoría ha sido eliminada.",
                icon: "success",
                confirmButtonClass: "btn btn-success",
                buttonsStyling: "btn btn-success"
            }).then(() => {
                // Redirigir a la URL de eliminación
                window.location.href = href;
            });
        } else {
            Swal.fire({
                title: "Cancelado",
                text: "Tu categoría está a salvo.",
                icon: "error",
                confirmButtonClass: "btn btn-success",
                buttonsStyling: "btn btn-success"
            });
        }
    });
});


$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const message = urlParams.get('message');

    if (status && message) {
        let alertMessage = '';

        switch (message) {
            case 'registrado':
                alertMessage = 'Categoría registrada con éxito.';
                break;
            case 'actualizado':
                alertMessage = 'Categoría actualizada con éxito.';
                break;
            default:
                alertMessage = 'Operación completada con éxito.';
        }

        Swal.fire({
            title: 'Éxito',
            text: alertMessage,
            icon: 'success',
            confirmButtonClass: 'btn btn-success',
            buttonsStyling: "btn btn-primary    "
        });
    }
});*/
