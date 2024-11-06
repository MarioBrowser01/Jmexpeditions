<?php
// Incluir configuración de la base de datos
require_once dirname(__DIR__) . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar si los campos requeridos están presentes
    if (
        !empty($_POST['nombre_paquete']) && !empty($_POST['descripcion_paquete']) && !empty($_POST['tipo_paquete']) &&
        !empty($_POST['precio_paquete']) && isset($_POST['disponibilidad_paquete']) && isset($_POST['categorias']) &&
        isset($_POST['servicios_incluidos']) && isset($_POST['servicios_no_incluidos'])
    ) {

        // Asignar valores de los campos
        $nombre_paquete = $_POST['nombre_paquete'];
        $descripcion_paquete = $_POST['descripcion_paquete'];
        $tipo_paquete = $_POST['tipo_paquete'];
        $precio_paquete = $_POST['precio_paquete'];
        $disponibilidad_paquete = $_POST['disponibilidad_paquete'];
        $duracion_paquete = !empty($_POST['duracion_paquete']) ? $_POST['duracion_paquete'] : 1;
        $noches_paquete = !empty($_POST['noches_paquete']) ? $_POST['noches_paquete'] : 0;
        $categorias_seleccionadas = $_POST['categorias'];  // Las categorías seleccionadas
        $servicios_incluidos = $_POST['servicios_incluidos'];  // Servicios incluidos
        $servicios_no_incluidos = $_POST['servicios_no_incluidos'];  // Servicios no incluidos

        try {
            // Iniciar la transacción
            $pdo->beginTransaction();

            // Insertar el paquete
            $stmt = $pdo->prepare("INSERT INTO paquetes (nombre_paquete, descripcion_paquete, noches_paquete, tipo_paquete, precio_paquete, disponibilidad_paquete, duracion_paquete) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre_paquete, $descripcion_paquete, $noches_paquete, $tipo_paquete, $precio_paquete, $disponibilidad_paquete, $duracion_paquete]);

            // Obtener el ID del paquete insertado
            $paquete_id = $pdo->lastInsertId();

            // Insertar las categorías seleccionadas en la tabla intermedia
            foreach ($categorias_seleccionadas as $nombre_categoria) {
                $stmt_categoria = $pdo->prepare("SELECT id FROM categorias WHERE nombre_categoria = ?");
                $stmt_categoria->execute([$nombre_categoria]);
                $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);

                if ($categoria) {
                    $stmt_insert_categoria = $pdo->prepare("INSERT INTO paquetes_categorias (paquete_id, categoria_id) VALUES (?, ?)");
                    $stmt_insert_categoria->execute([$paquete_id, $categoria['id']]);
                } else {
                    throw new Exception("Categoria no encontrada: " . $nombre_categoria);
                }
            }

            // Insertar los servicios incluidos
            foreach ($servicios_incluidos as $nombre_servicio) {
                $stmt_servicio = $pdo->prepare("SELECT id FROM servicios WHERE nombre_servicio = ?");
                $stmt_servicio->execute([$nombre_servicio]);
                $servicio = $stmt_servicio->fetch(PDO::FETCH_ASSOC);

                if ($servicio) {
                    $stmt_insert_incluido = $pdo->prepare("INSERT INTO paquetes_servicios_incluidos (paquete_id, servicio_id) VALUES (?, ?)");
                    $stmt_insert_incluido->execute([$paquete_id, $servicio['id']]);
                } else {
                    throw new Exception("Servicio no encontrado: " . $nombre_servicio);
                }
            }

            // Insertar los servicios no incluidos
            foreach ($servicios_no_incluidos as $nombre_servicio) {
                $stmt_servicio = $pdo->prepare("SELECT id FROM servicios WHERE nombre_servicio = ?");
                $stmt_servicio->execute([$nombre_servicio]);
                $servicio = $stmt_servicio->fetch(PDO::FETCH_ASSOC);

                if ($servicio) {
                    $stmt_insert_no_incluido = $pdo->prepare("INSERT INTO paquetes_servicios_no_incluidos (paquete_id, servicio_id) VALUES (?, ?)");
                    $stmt_insert_no_incluido->execute([$paquete_id, $servicio['id']]);
                } else {
                    throw new Exception("Servicio no encontrado: " . $nombre_servicio);
                }
            }

            // Confirmar la transacción
            $pdo->commit();

            // Redirigir a la página de éxito
            header('Location: ../../../pages/paquetes/index.php?status=success&message=registrado');
            exit();

        } catch (Exception $e) {
            // Si hay un error, hacer rollback de la transacción
            $pdo->rollBack();

            // Redirigir con el mensaje de error
            header('Location: ../../../pages/paquetes/index.php?status=error&message=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header("Location: ../../../pages/paquetes/index.php?status=error&message=missing_data&entity=" . urlencode("Paquete"));
        exit();
    }
}
?>
