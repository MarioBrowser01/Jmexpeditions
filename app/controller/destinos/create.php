<?php
require_once dirname(__DIR__) . '/config.php';

if (isset($_GET['nombre'])) { 
    $nombre_destino = $_GET['nombre'];
    $sql_check = "SELECT COUNT(*) FROM destinos WHERE nombre_destino = :nombre_destino";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':nombre_destino', $nombre_destino, PDO::PARAM_STR);
    $query_check->execute();
    $existe = $query_check->fetchColumn();

    echo json_encode(['existe' => $existe > 0]); 
    exit();
}

// Verificación final al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_destino = $_POST['nombre'];

    // Verificar si el nombre ya existe en la base de datos
    $sql_check = "SELECT COUNT(*) FROM destinos WHERE nombre_destino = :nombre_destino";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':nombre_destino', $nombre_destino, PDO::PARAM_STR);
    $query_check->execute();
    $existe = $query_check->fetchColumn();

    if ($existe > 0) {
        // Si el nombre ya existe, redirige de vuelta al formulario con un error
        header("Location: ../../../pages/destinos/index.php?status=error&message=nombre_existente&entity=" . urlencode("Destino"));
        exit();
    }

    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $id_departamento = $_POST['departamento']; // Este será el ID del departamento
    $id_provincia = $_POST['provincia']; // Este será el ID de la provincia
    $parque_reserva = $_POST['parque_reserva'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['id_categoria']; // Asegúrate de que coincida con el formulario
    $descripcion = $_POST['descripcion'];
    $altitud = $_POST['altitud_destino']; // Asegúrate de que coincida con el formulario

    // Ruta para almacenar las imágenes
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/jmexpeditions/public/images/destinos/';

    // Manejar archivos subidos
    $foto1_name = !empty($_FILES['fotos']['name'][0]) ? $_FILES['fotos']['name'][0] : null;
    $foto2_name = !empty($_FILES['fotos']['name'][1]) ? $_FILES['fotos']['name'][1] : null;
    $foto3_name = !empty($_FILES['fotos']['name'][2]) ? $_FILES['fotos']['name'][2] : null;

    $foto1_tmp = !empty($_FILES['fotos']['tmp_name'][0]) ? $_FILES['fotos']['tmp_name'][0] : null;
    $foto2_tmp = !empty($_FILES['fotos']['tmp_name'][1]) ? $_FILES['fotos']['tmp_name'][1] : null;
    $foto3_tmp = !empty($_FILES['fotos']['tmp_name'][2]) ? $_FILES['fotos']['tmp_name'][2] : null;

    // Definir destinos
    $foto1_dest = $upload_dir . basename($foto1_name);
    $foto2_dest = $upload_dir . basename($foto2_name);
    $foto3_dest = $upload_dir . basename($foto3_name);

    // Mover archivos si están presentes
    if ($foto1_tmp) move_uploaded_file($foto1_tmp, $foto1_dest);
    if ($foto2_tmp) move_uploaded_file($foto2_tmp, $foto2_dest);
    if ($foto3_tmp) move_uploaded_file($foto3_tmp, $foto3_dest);

    try {
        // Preparar la inserción
        $sql = "INSERT INTO destinos (nombre_destino, ubicacion_destino, id_departamento, id_provincia, parque_reserva_destino, codigo_destino, id_categoria, descripcion_destino, altitud_destino" .
            ($foto1_name ? ", imagen1_destino" : "") .
            ($foto2_name ? ", imagen2_destino" : "") .
            ($foto3_name ? ", imagen3_destino" : "") .
            ") VALUES (:nombre, :ubicacion, :id_departamento, :id_provincia, :parque_reserva, :codigo, :categoria, :descripcion, :altitud" .
            ($foto1_name ? ", :imagen1" : "") .
            ($foto2_name ? ", :imagen2" : "") .
            ($foto3_name ? ", :imagen3" : "") . ")";

        $stmt = $pdo->prepare($sql);

        $params = [
            ':nombre' => $nombre,
            ':ubicacion' => $ubicacion,
            ':id_departamento' => $id_departamento,
            ':id_provincia' => $id_provincia,
            ':parque_reserva' => $parque_reserva,
            ':codigo' => $codigo,
            ':categoria' => $categoria,
            ':descripcion' => $descripcion,
            ':altitud' => $altitud
        ];

        if ($foto1_name) $params[':imagen1'] = $foto1_name;
        if ($foto2_name) $params[':imagen2'] = $foto2_name;
        if ($foto3_name) $params[':imagen3'] = $foto3_name;

        if ($stmt->execute($params)) {
            header("Location: ../../../pages/destinos/index.php?status=success&message=registrado&entity=" . urlencode("Destino"));
            exit();
        } else {
            header("Location: ../../../pages/destinos/index.php?status=error&message=insert_error&entity=" . urlencode("Destino"));
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../../../pages/destinos/index.php?status=error&message=database_error&entity=" . urlencode("Destino"));
        exit();
    }
}
