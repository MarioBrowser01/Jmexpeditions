<?php
require_once dirname(__DIR__) . '/config.php'; // Asegúrate de que la ruta sea correcta

if (isset($_GET['id_departamento'])) {
    $id_departamento = $_GET['id_departamento'];

    // Consulta para obtener las provincias basadas en el id_departamento
    $sql = "SELECT id_provincia, nombre_provincia FROM provincias WHERE id_departamento = :id_departamento";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_departamento', $id_departamento, PDO::PARAM_INT);
    $stmt->execute();
    $provincias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las provincias en formato JSON
    echo json_encode($provincias);
} else {
    echo json_encode([]);
}
