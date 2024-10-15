<?php
require_once dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_paquete']) && isset($_POST['id_destino']) && isset($_POST['orden_itinerario']) 

        && isset($_POST['hora_salida']) && isset($_POST['tipo_destino']) 

        && isset($_POST['descripcion_actividad'])) {
        
        $id_paquete = $_POST['id_paquete'];
        $id_destino = $_POST['id_destino'];
        $orden_itinerario = $_POST['orden_itinerario']; 

        $hora_salida = $_POST['hora_salida'];

        $tipo_destino = $_POST['tipo_destino'];
        $descripcion_actividad = $_POST['descripcion_actividad'];

        try {

            $stmt = $pdo->prepare("INSERT INTO itinerarios (id_paquete, id_destino, orden_itinerario, hora_salida, tipo_destino, descripcion_actividad) 
                                   VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$id_paquete, $id_destino, $orden_itinerario, $hora_salida, $tipo_destino, $descripcion_actividad])) {

                // Redirige a la página de éxito o muestra un mensaje
                header("Location: ../../../pages/itinerarios/index.php?status=success&message=registrado&entity=" . urlencode("Itinerario"));
                exit();
            } else {
                header("Location: ../../../pages/itinerarios/index.php?status=error&message=insert_error&entity=" . urlencode("Itinerario"));
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../../../pages/itinerarios/index.php?status=error&message=database_error&entity=" . urlencode("Itinerario"));
            exit();
        }
    } else {
        header("Location: ../../../pages/itinerarios/index.php?status=error&message=missing_data&entity=" . urlencode("Itinerario"));
        
        exit();
    }
}
