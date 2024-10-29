<script>
    /*$(document).on("click", ".btn_eliminar_categoria", function(e) {
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
            buttonsStyling: false // Desactiva el estilo predeterminado de SweetAlert2 para que se apliquen tus clases personalizadas
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "¡Eliminado!",
                    text: "La categoría ha sido eliminada.",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                }).then(() => {
                    // Redirigir a la URL de eliminación
                    window.location.href = href;
                });
                buttonsStyling: false // Desactiva el estilo predeterminado de SweetAlert2 para que se apliquen tus clases personalizadas
            } else {
                Swal.fire({
                    title: "Cancelado",
                    text: "Tu categoría está a salvo.",
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                });
                buttonsStyling: false
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
    });
*/
    //MODAL DE NOTIFICACIONES CRUD
    $(document).on("click", ".btn_eliminar", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");
        const entity = $(this).data("entity");
        console.log("Href: ", href);
        console.log("Entity: ", entity);

        Swal.fire({
            title: `¿Estás seguro de eliminar esta ${entity}?`,
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
                    text: `${entity} ha sido eliminado.`,
                    icon: "success",
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: "btn btn-primary"
                }).then(() => {
                    window.location.href = href;
                });
            } else {
                Swal.fire({
                    title: "Cancelado",
                    text: `Tu ${entity} está a salvo.`,
                    icon: "error",
                    confirmButtonClass: 'btn btn-success',
                    buttonsStyling: "btn btn-primary"
                });
            }
        });
    });

    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');
        const entity = urlParams.get('entity');

        if (status && message && entity) {
            let alertTitle = status === 'success' ? 'Éxito' : 'Error';
            let alertMessage = '';

            switch (message) {
                case 'registrado':
                    alertMessage = `${entity} registrada con éxito.`;
                    break;
                case 'move_error':
                    alertMessage = `Error al mover ${entity}.`;
                    break;
                case 'upload_error':
                    alertMessage = `Error al subir ${entity}.`;
                    break;
                case 'db_error':
                    alertMessage = `Error en la base de datos para ${entity}.`;
                    break;
                default:
                    alertMessage = `Operación en ${entity} completada con éxito.`;
            }

            Swal.fire({
                title: alertTitle,
                text: alertMessage,
                icon: status === 'success' ? 'success' : 'error',
                confirmButtonClass: 'btn btn-success',
                buttonsStyling: "btn btn-primary"
            }).then(() => {
                // Redirigir a la URL sin parámetros
                window.history.replaceState(null, null, window.location.pathname);
            });

            // Alternativamente, limpiar la URL después de 7 segundos automáticamente
            setTimeout(() => {
                window.history.replaceState(null, null, window.location.pathname);
            }, 7000);
        }
    });


    //Boton de cancelar actualizacion

    function cancelarActualizacion(entity) {
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
            document.getElementById('form_registrar').scrollIntoView({
                behavior: 'smooth'

            });
        });
    }

    function cancelarActualizar(entity) {
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
            
            window.location.href = '../../pages/destinos/index.php';
        });
    }
    
        
</Script>