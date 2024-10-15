<?php
require_once dirname(__DIR__) . '/config.php'; // Asegúrate de que estás incluyendo correctamente tu archivo de configuración

// Verificar si se ha pasado un ID de itinerario en la URL
if (isset($_GET['id'])) {
    $id_itinerario = (int)$_GET['id']; // Convertir el ID a entero para mayor seguridad

    if ($id_itinerario > 0) {
        try {
            // Consulta para obtener los detalles del itinerario
            $stmt = $pdo->prepare("
                SELECT itinerarios.*,  
                       paquetes.nombre_paquete, 
                       destinos.nombre_destino 
                FROM itinerarios
                JOIN paquetes ON itinerarios.id_paquete = paquetes.id_paquete
                JOIN destinos ON itinerarios.id_destino = destinos.id_destino
                WHERE itinerarios.id_itinerario = :id_itinerario
            ");
            $stmt->bindParam(':id_itinerario', $id_itinerario, PDO::PARAM_INT);
            $stmt->execute();

            // Obtener los resultados
            $itinerario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró el itinerario
            if (!$itinerario) {
                // Redirigir si no se encuentra el itinerario
                header("Location: ../../../pages/itinerarios/index.php?status=error&message=itinerario_not_found");
                exit();
            }
        } catch (PDOException $e) {
            // Redirigir en caso de error de base de datos
            header('Location: ../../../pages/itinerarios/index.php?status=error&message=db_error');
            exit();
        }
    } else {
        // Redirigir si el ID de itinerario es inválido
        header("Location: ../../../pages/itinerarios/index.php?status=error&message=invalid_id");
        exit();
    }
} else {
    // Redirigir si no se proporciona un ID
    header("Location: ../../../pages/itinerarios/index.php?status=error&message=no_id_provided");
    exit();
}