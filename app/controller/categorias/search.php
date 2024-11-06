<?php 

require_once dirname(__DIR__) . '/config.php';

// Obtener el término de búsqueda
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Si no hay término, devolver un array vacío
if (empty($query)) {
    echo json_encode([]);
    exit; // Terminar el script
}

// Buscar categorías
$sql = "SELECT nombre_categoria FROM categorias WHERE nombre_categoria LIKE :query LIMIT 10"; // Limitamos a 10 resultados
$stmt = $pdo->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);

if ($stmt->execute()) {
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Devolver los resultados como JSON
    echo json_encode($categorias);
} else {
    // Si hubo un error en la ejecución, devolver un error
    echo json_encode(['error' => 'Error al realizar la búsqueda.']);
}

exit; // Terminar el script
?>
