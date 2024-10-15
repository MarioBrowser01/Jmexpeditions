<?php
require_once dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['id_itinerario']) && isset($_POST['id_paquete']) && isset($_POST['id_destino']) 

        && isset($_POST['orden_itinerario']) && isset($_POST['hora_salida']) 

        && isset($_POST['tipo_destino']) && isset($_POST['descripcion_actividad'])) {
        
        $id_itinerario = $_POST['id_itinerario'];  // El ID del itinerario que se va a actualizar
        $id_paquete = $_POST['id_paquete']; 
        $id_destino = $_POST['id_destino'];
        $orden_itinerario = $_POST['orden_itinerario'];

        $hora_salida = $_POST['hora_salida']; // Capturamos la hora de salida
        $tipo_destino = $_POST['tipo_destino'];
        $descripcion_actividad = $_POST['descripcion_actividad'];

        // Validar y formatear la hora de salida
        if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $hora_salida)) {
            // Si el formato no es válido, puedes asignar un valor por defecto o manejar el error
            $hora_salida = '00:00'; // O cualquier otro valor por defecto
        }

        try {
            // Preparar la actualización
            $stmt = $pdo->prepare("UPDATE itinerarios SET id_paquete = ?, id_destino = ?, orden_itinerario = ?, hora_salida = ?, tipo_destino = ?, descripcion_actividad = ? 
                                   WHERE id_itinerario = ?");
            
            // Ejecutar la actualización con los parámetros correspondientes
            if ($stmt->execute([$id_paquete, $id_destino, $orden_itinerario, $hora_salida, $tipo_destino, $descripcion_actividad, $id_itinerario])) {

                // Redirige a la página de éxito o muestra un mensaje
                header("Location: ../../../pages/itinerarios/index.php?status=success&message=actualizado&entity=" . urlencode("Itinerario"));
                exit();
            } else {
                header("Location: ../../../pages/itinerarios/index.php?status=error&message=update_error&entity=" . urlencode("Itinerario"));
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
