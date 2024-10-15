<?php
require_once dirname(__DIR__) . '/config.php';

/**
 * Created by SENATI.
 * User: DENIS
 * Date: 30/07/2024
 * Time: 15:00
 */
// Verifica si $pdo está definido
if (!isset($pdo)) {
    die("No se pudo conectar a la base de datos.");
}

try {
    // Consulta para obtener las categorías
    $sql_categorias = "SELECT 
        id_categoria, 
        cod_categoria, 
        nombre_categoria, 
        descripcion_categoria 
        FROM categorias";

    $query_categorias = $pdo->prepare($sql_categorias);
    $query_categorias->execute();
    $categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);

    // Depuración: Verificar si se obtienen datos
    if ($categorias_datos === false) {
        echo "Error en la consulta.";
    } elseif (empty($categorias_datos)) {
        echo "No se encontraron categorías.";
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
