<?php
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id_categoria = ?");
        if ($stmt->execute([$id_categoria])) {
            // Redirigir al listado con un mensaje de éxito
            header("Location: ../../../pages/categorias/index.php?status=success&message=eliminado&entity=Categoría");
            exit();
        } else {
            // Redirigir con un mensaje de error
            header("Location: ../../../pages/categorias/index.php?status=error&message=error_eliminando&entity=Categoría");
            exit();
        }
    } catch (PDOException $e) {
        // Redirigir con un mensaje de error en caso de excepción
        header("Location: ../../../pages/categorias/index.php?status=error&message=" . urlencode($e->getMessage()) . "&entity=Categoría");
        exit();
    }
}


/*

if (isset($_GET['id_categoria'])) {
    $id_categoria = $_GET['id_categoria'];

    try {
        $sql = "DELETE FROM categorias WHERE id_categoria = :id_categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_categoria', $id_categoria);

        if ($stmt->execute()) {
           
            exit();
        } else {
            echo "Error al eliminar la categoría.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de categoría no proporcionado.";
}*/


