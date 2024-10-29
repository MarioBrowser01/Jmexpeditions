<?php
require_once dirname(__DIR__) . '/config.php';
if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];

    try {
        // Consulta para obtener los datos del destino
        $sql = "SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento WHERE id_destino = :id_destino";
       
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_destino' => $id_destino]);
        $destino = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvieron datos del destino
        if (!$destino) {
            die("Destino no encontrado.");
        }
    } catch (PDOException $e) {
        die("Error al obtener los datos del destino: " . $e->getMessage());
    }
} else {
    die("ID del destino no especificado.");
}
?>