<?php
// Incluir la configuración de la base de datos
require_once dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario enviados mediante POST
    $id_paquete = $_POST['id_paquete'];
    $nombre_paquete = $_POST['nombre_paquete'];
    $duracion_paquete = !empty($_POST['duracion_paquete']) ? $_POST['duracion_paquete'] : "1"; // El campo puede ser opcional
    $noches_paquete = !empty($_POST['noches_paquete']) ? $_POST['noches_paquete'] : 0; // El campo puede ser opcional
    $tipo_paquete = $_POST['tipo_paquete'];
    $precio_paquete = $_POST['precio_paquete'];
    $disponibilidad_paquete = $_POST['disponibilidad_paquete'];
    $descripcion_paquete = $_POST['descripcion_paquete'];

    // Validación de los datos
    if (empty($nombre_paquete) || empty($duracion_paquete) || empty($tipo_paquete) || empty($precio_paquete) || !isset($disponibilidad_paquete) || empty($descripcion_paquete)) {
        header("Location: ../../../pages/paquetes/index.php?status=error&message=missing_data&entity=" . urlencode("Paquete"));
        exit;
    }
    

    // Actualizar el paquete en la base de datos
    $sql = "UPDATE paquetes 
            SET nombre_paquete = :nombre_paquete, 
                duracion_paquete = :duracion_paquete, 
                noches_paquete = :noches_paquete, 
                tipo_paquete = :tipo_paquete, 
                precio_paquete = :precio_paquete, 
                disponibilidad_paquete = :disponibilidad_paquete, 
                descripcion_paquete = :descripcion_paquete 
            WHERE id_paquete = :id_paquete";

    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta con los datos obtenidos
    $result = $stmt->execute([
        'id_paquete' => $id_paquete,
        'nombre_paquete' => $nombre_paquete,
        'duracion_paquete' => $duracion_paquete,
        'noches_paquete' => $noches_paquete,  // Es opcional, puede ser NULL
        'tipo_paquete' => $tipo_paquete,
        'precio_paquete' => $precio_paquete,
        'disponibilidad_paquete' => $disponibilidad_paquete,
        'descripcion_paquete' => $descripcion_paquete
    ]);

    // Verificar si la actualización fue exitosa
    if ($result) {
        // Redirigir con mensaje de éxito
        header("Location: ../../../pages/paquetes/index.php?status=success&message=actualizado&entity=" . urlencode("Paquete"));
        exit;
    } else {
        // Redirigir con mensaje de error
        header("Location: ../../../pages/paquetes/index.php?status=error&message=update_error&entity=" . urlencode("Paquete"));
        exit;
    }
}

