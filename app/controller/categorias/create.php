<?php
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['nombre'])) { 
    $nombre_categoria = $_GET['nombre'];
    $sql_check = "SELECT COUNT(*) FROM categorias WHERE nombre_categoria = :nombre_categoria";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':nombre_categoria', $nombre_categoria, PDO::PARAM_STR);
    $query_check->execute();
    $existe = $query_check->fetchColumn();

    echo json_encode(['existe' => $existe > 0]); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre_categoria']) && isset($_POST['descripcion_categoria'])) {
        $nombre_categoria = $_POST['nombre_categoria'];
        $descripcion_categoria = $_POST['descripcion_categoria'];

        try {
            // Inserta la categoría sin el código
            $stmt = $pdo->prepare("INSERT INTO categorias (nombre_categoria, descripcion_categoria) VALUES (?, ?)");
            $stmt->execute([$nombre_categoria, $descripcion_categoria]);

            // Obtén el `id_categoria` de la última inserción
            $id_categoria = $pdo->lastInsertId();

            // Genera el código usando "CA" y rellenando el ID hasta 4 dígitos
            $codigo_categoria = "CA" . str_pad($id_categoria, 4, "0", STR_PAD_LEFT);

            // Actualiza la categoría con el código generado
            $stmt = $pdo->prepare("UPDATE categorias SET cod_categoria = ? WHERE id_categoria = ?");
            $stmt->execute([$codigo_categoria, $id_categoria]);

            header("Location: ../../../pages/categorias/index.php?status=success&message=registrado&entity=" . urlencode("Categoría"));
            exit();
        } catch (PDOException $e) {
            header("Location: ../../../pages/categorias/index.php?status=error&message=database_error&entity=" . urlencode("Categoría"));
            exit();
        }
    } else {
        header("Location: ../../../pages/categorias/index.php?status=error&message=missing_data&entity=" . urlencode("Categoría"));
        exit();
    }
} 
