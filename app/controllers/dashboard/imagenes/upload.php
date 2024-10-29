<?php
require_once dirname(__DIR__) . '/config.php'; // Asegúrate de que el archivo de configuración se incluya correctamente

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_destino = $_POST['id_destino'];
    $descripcion_imagen = $_POST['descripcion_imagen'];

    // Verificar que el archivo se haya subido sin errores
    if (isset($_FILES['url_imagen']) && $_FILES['url_imagen']['error'] == 0) {
        $upload_dir = __DIR__ . '/../../../public/uploads/photos/'; // Ruta al directorio de subida
        $imagen_name = basename($_FILES['url_imagen']['name']);
        $imagen_path = $upload_dir . $imagen_name;

        // Verificar que el directorio de subida exista
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Mover la imagen subida a la carpeta de destino
        if (move_uploaded_file($_FILES['url_imagen']['tmp_name'], $imagen_path)) {
            // Insertar la información en la base de datos
            $sql = "INSERT INTO imagenes_destinos (id_destino, descripcion_imagen, url_imagen) VALUES (:id_destino, :descripcion_imagen, :url_imagen)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([
                ':id_destino' => $id_destino,
                ':descripcion_imagen' => $descripcion_imagen,
                ':url_imagen' => $imagen_name
            ])) {
                // Redirigir con parámetros de éxito
                header("Location: ../../../pages/galerias/subir-imagen.php?status=success&message=registrado&entity=" . urlencode("Imagen"));
            } else {
                // Redirigir con parámetros de error en la base de datos
                header("Location: ../../../pages/galerias/subir-imagen.php?status=error&message=db_error&entity=" . urlencode("Imagen"));
            }
        } else {
            // Redirigir con parámetros de error al mover la imagen
            header("Location: ../../../pages/galerias/subir-imagen.php?status=error&message=move_error&entity=" . urlencode("Imagen"));
        }
    } else {
        // Redirigir con parámetros de error al subir la imagen
        header("Location: ../../../pages/galerias/subir-imagen.php?status=error&message=upload_error&entity=" . urlencode("Imagen"));
    }
    exit();
}
