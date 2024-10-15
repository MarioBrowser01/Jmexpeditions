
<script>
    // Función para confirmar eliminación
    $(document).on("click", ".btn_eliminar", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");
        const entity = $(this).data("entity");

        Swal.fire({
            title: `¿Estás seguro de eliminar ${entity}?`,
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            customClass: {
                confirmButton: "btn btn-success g-2 m-2",
                cancelButton: "btn btn-danger g-2 m-2"
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "¡Eliminado!",
                    text: `${entity} ha sido eliminado.`,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                }).then(() => {
                    window.location.href = href;
                });
            } else {
                Swal.fire({
                    title: "Cancelado",
                    text: `Tu ${entity} está a salvo.`,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: true
                });
            }
        });
    });

    // Función para manejar notificaciones de CRUD (Crear, Actualizar, Eliminar)
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
                case 'actualizado':
                    alertMessage = `${entity} actualizada con éxito.`; // Para actualizaciones
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
                customClass: {
                    confirmButton: "btn btn-success"
                },
                buttonsStyling: true
            }).then(() => {
                // Limpiar parámetros de la URL
                window.history.replaceState(null, null, window.location.pathname);
            });
        }
    });

    // Función para cancelar la actualización desde el botón
    function cancelarActualizacion(entity) {
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
            // Ocultar el formulario de actualización y mostrar el de registro
            document.getElementById('form_actualizar').style.display = 'none';
            document.getElementById('form_registrar').style.display = 'block';
            document.getElementById('form_registrar').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    // Función para cancelar la actualización y redirigir
    function cancelarActualizar(entity) {
        let redirectUrl;

        // Define la URL de redirección según la entidad
        switch (entity.toLowerCase()) {
            case 'paquete':
                redirectUrl = '../../pages/paquetes/index.php';
                break;
            case 'galeria':
                redirectUrl = '../../pages/galerias/index.php';
                break;
            case 'destino':
                redirectUrl = '../../pages/destinos/index.php';
                break;
            case 'itinerario':
                redirectUrl = '../../pages/itinerarios/index.php';
                break;
                // Agrega más entidades según sea necesario
            default:
                redirectUrl = '../../pages/paquetes/index.php'; // Redirigir a un valor por defecto
                break;
        }

        Swal.fire({
            title: "Cancelado",
            text: `${entity} no actualizado.`,
            icon: "info",
            confirmButtonText: "Aceptar",
            customClass: {
                confirmButton: "btn btn-primary"
            },
            buttonsStyling: false
        }).then(() => {
            window.location.href = redirectUrl;
        });
    }


    function confirmDelete(id_imagen) {
        const form = document.getElementById(`form-eliminar-${id_imagen}`);
        const entity = $(form).find('.btn_eliminar').data('entity'); // Obtener el nombre de la entidad

        // Mostrar la alerta de confirmación
        Swal.fire({
            title: `¿Estás seguro de eliminar ${entity}?`,
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            customClass: {
                confirmButton: "btn btn-success g-2 m-2",
                cancelButton: "btn btn-danger g-2 m-2"
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "¡Eliminado!",
                    text: `${entity} ha sido eliminado.`,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                }).then(() => {
                    window.location.href = href;
                });
            } else {
                Swal.fire({
                    title: "Cancelado",
                    text: `Tu ${entity} está a salvo.`,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: true
                });
            }
        })
    }
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');

        if (status && message) {
            Swal.fire({
                title: status === 'success' ? 'Éxito' : 'Error',
                text: message,
                icon: status === 'success' ? 'success' : 'error',
                customClass: {
                    confirmButton: "btn btn-success"
                },
                buttonsStyling: false
            }).then(() => {
                // Limpiar la URL para evitar que se repita el mensaje al recargar
                window.history.replaceState(null, null, window.location.pathname);
            });
        }
    });

    // Función para mostrar notificaciones basadas en los parámetros de la URL
    function mostrarNotificacionDesdeUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');
        const entity = urlParams.get('entity') || 'Entidad desconocida';

        if (status && message) {
            let title, text;

            if (status === 'success') {
                title = "¡Éxito!";
                text = `${entity} ${message === 'Actualizado' ? 'Ha sido actualizado correctamente.' : ''}`;
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                });
            } else if (status === 'error') {
                title = "Error";
                text = message === 'not_found' ? `${entity} no encontrado.` :
                       message === 'update_error' ? `Error al actualizar ${entity}.` :
                       message === 'db_error' ? `Error de base de datos.` :
                       message === 'missing_data' ? `Faltan datos en el formulario.` :
                       `Ocurrió un error desconocido.`;
                       
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
            }
        }
    }

    // Llama a la función al cargar la página
    window.onload = mostrarNotificacionDesdeUrl;
</script>

