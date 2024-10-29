<?php
// Incluir la conexión a la base de datos y configuración

require_once dirname(__DIR__) . '/config.php';


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_imagen = $_POST['id_imagen'];
    $id_destino = $_POST['id_destino'];
    $descripcion_imagen = $_POST['descripcion_imagen'];

    // Inicializar la variable de URL de imagen
    $nueva_imagen_url = null;

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['url_imagen']) && $_FILES['url_imagen']['error'] == 0) {
        // Ruta donde se guardarán las imágenes
        $directorio_subida = '../../public/uploads/photos/';
        $nombre_imagen = basename($_FILES['url_imagen']['name']);
        $ruta_imagen = $directorio_subida . $nombre_imagen;

        // Intentar mover el archivo subido al directorio de destino
        if (move_uploaded_file($_FILES['url_imagen']['tmp_name'], $ruta_imagen)) {
            // Si la imagen se subió correctamente, guardamos la ruta
            $nueva_imagen_url = $nombre_imagen;
        } else {
            echo "Error al subir la nueva imagen.";
            exit;
        }
    }

    // Crear la consulta SQL para actualizar la información de la imagen
    $sql = "UPDATE imagenes_destinos 
            SET id_destino = :id_destino, descripcion_imagen = :descripcion_imagen";

    // Si se subió una nueva imagen, agregarla a la consulta
    if ($nueva_imagen_url) {
        $sql .= ", url_imagen = :url_imagen";
    }

    $sql .= " WHERE id_imagen = :id_imagen";

    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Crear el array con los parámetros para ejecutar la consulta
    $params = [
        ':id_destino' => $id_destino,
        ':descripcion_imagen' => $descripcion_imagen,
        ':id_imagen' => $id_imagen
    ];

    // Si hay una nueva imagen, agregarla a los parámetros
    if ($nueva_imagen_url) {
        $params[':url_imagen'] = $nueva_imagen_url;
    }

    // Ejecutar la consulta dentro de un bloque try-catch
    try {
        $stmt->execute($params);


        // Obtener el nombre del destino según el id_destino
        $queryDestino = $pdo->prepare("SELECT nombre_destino FROM destinos WHERE id_destino = :id_destino");
        $queryDestino->execute([':id_destino' => $id_destino]);
        $destino = $queryDestino->fetch(PDO::FETCH_ASSOC);

        if ($destino) {
            $nombre_destino = $destino['nombre_destino'];

            // Redirigir de vuelta a la página de detalles del destino después de actualizar
            header("Location: ../../../pages/galerias/detalle-destino.php?nombre_destino=" . urlencode($nombre_destino) . "&status=success&message=actualizado&entity=imagen");
            exit();
        } else {
            echo "Error: No se encontró el destino.";
            exit();
        }


    } catch (PDOException $e) {
        // Mostrar error si algo salió mal
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    // Si no se envió el formulario, redirigir o mostrar mensaje de error
    echo "No se ha enviado ningún dato.";
    exit;
}