console.log("Hola desde el archivo modal.js");
//MODAL DE NOTIFICACIONES CRUD
/*$(document).on("click", ".btn_eliminar", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");
    const entity = $(this).data("entity"); // Obtener la entidad
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
                buttonsStyling: "btn btn-success"
            }).then(() => {
                window.location.href = href;
            });
        } else {
            Swal.fire({
                title: "Cancelado",
                text: `Tu ${entity} está a salvo.`,
                icon: "error",
                confirmButtonClass: "btn btn-success",
                buttonsStyling: "btn btn-success"
            });
        }
    });
});
*/