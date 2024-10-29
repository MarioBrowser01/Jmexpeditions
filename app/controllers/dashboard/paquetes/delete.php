<?php
require_once dirname(__DIR__) . '/config.php';

// Verifica que se haya enviado el ID del paquete a eliminar
if (isset($_GET['id'])) {
    $id_paquete = $_GET['id'];

    try {
        // Prepara la consulta para eliminar el paquete
        $stmt = $pdo->prepare("DELETE FROM paquetes WHERE id_paquete = :id_paquete");
        $stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Redirige a la página de éxito si la eliminación fue exitosa
            header('Location: ../../../pages/paquetes/index.php?status=success&message=eliminado');
            exit();
        } else {
            // Redirige en caso de error en la eliminación
            header("Location: ../../../pages/paquetes/index.php?status=error&message=delete_error&entity=" . urlencode("Paquete"));
            exit();
        }
    } catch (PDOException $e) {
        // Redirige en caso de error de base de datos
        header('Location: ../../../pages/paquetes/index.php?status=error&message=db_error');
        exit();
    }
} else {
    // Redirige si no se ha proporcionado un ID
    header("Location: ../../../pages/paquetes/index.php?status=error&message=missing_id&entity=" . urlencode("Paquete"));
    exit();
}
