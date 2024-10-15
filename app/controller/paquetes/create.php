<?php
// Incluir configuración de la base de datos
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['nombre_paquete'])) { 
    $nombre_paquete = $_GET['nombre_paquete'];
    $sql_check = "SELECT COUNT(*) FROM paquetes WHERE nombre_paquete = :nombre_paquete";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':nombre_paquete', $nombre_paquete, PDO::PARAM_STR);
    $query_check->execute();
    $existe = $query_check->fetchColumn();

    echo json_encode(['existe' => $existe > 0]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    // Validar si los campos requeridos están presentes
    if (
        !empty($_POST['nombre_paquete']) && !empty($_POST['descripcion_paquete']) && !empty($_POST['tipo_paquete']) &&
        !empty($_POST['precio_paquete']) && isset($_POST['disponibilidad_paquete'])
    ) {

        // Asignar valores de los campos, usar un valor predeterminado si es necesario
        $nombre_paquete = $_POST['nombre_paquete'];
        $descripcion_paquete = $_POST['descripcion_paquete'];
        $tipo_paquete = $_POST['tipo_paquete'];
        $precio_paquete = $_POST['precio_paquete'];
        $disponibilidad_paquete = $_POST['disponibilidad_paquete'];
        // $duracion_paquete = $_POST['duracion_paquete'];
        // Validar si el campo noches es opcional, asignar 0 si está vacío
        $duracion_paquete = !empty($_POST['duracion_paquete']) ? $_POST['duracion_paquete'] : 1;
        $noches_paquete = !empty($_POST['noches_paquete']) ? $_POST['noches_paquete'] : 0;

        // Continuar con la inserción a la base de datos o lo que sea necesario
        try {
            // Suponiendo que tienes una conexión PDO establecida
            $stmt = $pdo->prepare("INSERT INTO paquetes (nombre_paquete, descripcion_paquete, noches_paquete, tipo_paquete, precio_paquete, disponibilidad_paquete, duracion_paquete) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt->execute([$nombre_paquete, $descripcion_paquete, $noches_paquete, $tipo_paquete, $precio_paquete, $disponibilidad_paquete, $duracion_paquete])) {
                // Redirige a la página de éxito
                header('Location: ../../../pages/paquetes/index.php?status=success&message=registrado');
                var_dump($_POST); // Agregar esto temporalmente para revisar los datos enviados.
    
                exit();
            } else {
                // Redirige en caso de error en la inserción
                header("Location: ../../../pages/paquetes/index.php?status=error&message=insert_error&entity=" . urlencode("Paquete"));
                exit();
            }
        } catch (PDOException $e) {
            // Redirige en caso de error de base de datos
            header('Location: ../../../pages/paquetes/index.php?status=error&message=db_error');
            exit();
        }
    } else {
        // Redirige si faltan datos en el formulario
        header("Location: ../../../pages/paquetes/index.php?status=error&message=missing_data&entity=" . urlencode("Paquete"));
        exit();
    }
}