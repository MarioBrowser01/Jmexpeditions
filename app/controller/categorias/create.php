<?php
require_once dirname(__DIR__) . '/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['nombre_categoria']) && isset($_POST['cod_categoria']) && isset($_POST['descripcion_categoria'])) {
        $nombre_categoria = $_POST['nombre_categoria'];
        $cod_categoria = $_POST['cod_categoria'];
        $descripcion_categoria = $_POST['descripcion_categoria'];

        try {
            $stmt = $pdo->prepare("INSERT INTO categorias (nombre_categoria, cod_categoria, descripcion_categoria) VALUES (?, ?, ?)");
            if ($stmt->execute([$nombre_categoria, $cod_categoria, $descripcion_categoria])) {
                // Redirige a la página de éxito o muestra un mensaje
                
                // Después de insertar la categoría en la base de datos
                header("Location: ../../../pages/categorias/index.php?status=success&message=registrado&entity=" . urlencode("Categoría"));
                exit();
            } else {
                header("Location: ../../../pages/categorias/index.php?status=error&message=insert_error&entity=" . urlencode("Categoría"));
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../../../pages/categorias/index.php?status=error&message=database_error&entity=" . urlencode("Categoría"));
            exit();
        }
    } else {
        header("Location: ../../../pages/categorias/index.php?status=error&message=missing_data&entity=" . urlencode("Categoría"));
        exit();
    }
} 
