<?php
// Incluir archivo de configuración o establecer conexión a la base de datos
require_once 'config.php'; // Asegúrate de que la ruta al archivo de configuración sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se han seleccionado servicios
    if (!empty($_POST['servicios_incluidos']) || !empty($_POST['servicios_no_incluidos'])) {
        // Aquí podrías obtener el id del paquete al que estás asociando los servicios
        $paquete_id = $_POST['paquete_id']; // Asumiendo que pasas el id del paquete en el formulario

        // Insertar servicios incluidos
        if (!empty($_POST['servicios_incluidos'])) {
            foreach ($_POST['servicios_incluidos'] as $servicio_incluido) {
                // Asegúrate de escapar correctamente los valores
                $sql_incluidos = "INSERT INTO paquetes_servicios_incluidos (paquete_id, servicio_id) 
                                  VALUES (:paquete_id, :servicio_incluido)";
                $stmt = $pdo->prepare($sql_incluidos);
                $stmt->bindParam(':paquete_id', $paquete_id);
                $stmt->bindParam(':servicio_incluido', $servicio_incluido);
                $stmt->execute();
            }
        }

        // Insertar servicios no incluidos
        if (!empty($_POST['servicios_no_incluidos'])) {
            foreach ($_POST['servicios_no_incluidos'] as $servicio_no_incluido) {
                // Asegúrate de escapar correctamente los valores
                $sql_no_incluidos = "INSERT INTO paquetes_servicios_no_incluidos (paquete_id, servicio_id) 
                                     VALUES (:paquete_id, :servicio_no_incluido)";
                $stmt = $pdo->prepare($sql_no_incluidos);
                $stmt->bindParam(':paquete_id', $paquete_id);
                $stmt->bindParam(':servicio_no_incluido', $servicio_no_incluido);
                $stmt->execute();
            }
        }

        // Redirigir o mostrar un mensaje de éxito
        // header("Location: success_page.php"); // Cambia esto según tu flujo de trabajo
        // header("Location: ../../../pages/paquetes/create.php?status=error&message=insert_error&entity=" . urlencode("Paquete"));

        exit();
    } else {
        // Manejar el caso en que no se han seleccionado servicios
        echo "Por favor, selecciona al menos un servicio.";
    }
}
?>
