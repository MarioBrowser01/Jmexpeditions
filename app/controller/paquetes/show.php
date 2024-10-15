<?php
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['id'])) {
    $id_paquete = $_GET['id'];

    $id_paquete = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id_paquete > 0) {
        
        $stmt = $pdo->prepare("
        SELECT itinerarios.*, 
               paquetes.nombre_paquete, 
               destinos.nombre_destino
        FROM itinerarios
        JOIN paquetes ON itinerarios.id_paquete = paquetes.id_paquete
        JOIN destinos ON itinerarios.id_destino = destinos.id_destino
        WHERE itinerarios.id_paquete = :id_paquete
    ");

        // Vincular el parámetro y ejecutar la consulta
        $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener los resultados
        $itinerarios_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Manejar el caso en que no se proporciona un ID de paquete válido
        $itinerarios_datos = []; // O manejar un error según tu lógica
    }

    try {
        // Prepara la consulta para obtener los detalles del paquete
        $stmt = $pdo->prepare("SELECT * FROM paquetes WHERE id_paquete = :id_paquete");
        $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
        $stmt->execute();

        // Obtiene el paquete
        $paquete = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si se encontró el paquete
        if (!$paquete) {
            header("Location: ../../../pages/paquetes/index.php?status=error&message=package_not_found");
            exit();
        }
    } catch (PDOException $e) {
        // Redirige en caso de error de base de datos
        header('Location: ../../../pages/paquetes/index.php?status=error&message=db_error');
        exit();
    }
}

// if (isset($_GET['id'])) {
//     $id_itinerario = $_GET['id'];

//     // Actualiza el itinerario para que ya no esté vinculado a ningún paquete
//     $stmt = $pdo->prepare("UPDATE itinerarios SET id_paquete = NULL WHERE id_itinerario = :id_itinerario");
//     $stmt->bindParam(':id_itinerario', $id_itinerario, PDO::PARAM_INT);

//     if ($stmt->execute()) {
//         // Redirige a la página de paquetes con un mensaje de éxito
//         header("Location: ../../pages/paquetes/ver-paquetes.php?message=Itinerario eliminado con éxito.");
//         exit();
//     } else {
//         // Redirige a la página de paquetes con un mensaje de error
//         header("Location: ../../pages/paquetes/ver-paquetes.php?error=No se pudo eliminar el itinerario.");
//         exit();
//     }
// }
