<?php
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id_destino = $_GET['id'];  // Validar que el id sea un número entero

    try {
        // Comprobar si el registro existe antes de intentar eliminarlo
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM destinos WHERE id_destino = ?");
        $checkStmt->execute([$id_destino]);
        if ($checkStmt->fetchColumn() == 0) {
            // Redirigir si no se encuentra el registro
            header("Location: ../../../pages/destinos/index.php?status=error&message=registro_no_encontrado&entity=Destino");
            exit();
        }

        // Iniciar la transacción
        $pdo->beginTransaction();

        // Eliminar el destino
        $stmt = $pdo->prepare("DELETE FROM destinos WHERE id_destino = ?");
        if ($stmt->execute([$id_destino])) {
            // Confirmar la transacción
            $pdo->commit();
            // Redirigir con un mensaje de éxito
            header("Location: ../../../pages/destinos/index.php?status=success&message=eliminado&entity=Destino");
            exit();
        } else {
            // Revertir la transacción en caso de fallo
            $pdo->rollBack();
            // Redirigir con un mensaje de error
            header("Location: ../../../pages/destinos/index.php?status=error&message=error_eliminando&entity=Destino");
            exit();
        }
    } catch (PDOException $e) {
        // Revertir la transacción si hay una excepción
        $pdo->rollBack();
        // Registrar el error en el log del servidor
        error_log("Error eliminando destino: " . $e->getMessage());
        // Redirigir con un mensaje de error
        header("Location: ../../../pages/destinos/index.php?status=error&message=" . urlencode($e->getMessage()) . "&entity=Destino");
        exit();
    }
} else {
    // Redirigir con mensaje de error si el id no es válido
    header("Location: ../../../pages/destinos/index.php?status=error&message=invalid_id&entity=Destino");
    exit();
}
