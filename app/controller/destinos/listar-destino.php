<?php
require_once dirname(__DIR__) . '/config.php';

/**
 * Created by SENATI.
 * User: DENIS
 * Date: 30/07/2024
 * Time: 15:00
 */

// Verifica si $pdo está definido y si la conexión es válida
if (!isset($pdo)) {
    die("No se pudo conectar a la base de datos.");
}

try {
    // Consulta para obtener los destinos, incluyendo parque_reserva_destino
    $sql_destinos = "SELECT 
        de.id_destino as id_destino, 
        de.codigo_destino as codigo_destino,
        de.nombre_destino as nombre_destino, 
        dep.nombre_departamento as nombre_departamento, 
        de.ubicacion_destino as ubicacion_destino, 
        prov.nombre_provincia as nombre_provincia,
        de.dias_destino as dias_destino, 
        de.descripcion_destino as descripcion_destino, 
        de.parque_reserva_destino as parque_reserva_destino,
        cat.nombre_categoria as nombre_categoria 
        FROM destinos as de 
        INNER JOIN categorias as cat ON de.id_categoria = cat.id_categoria
        INNER JOIN provincias as prov ON de.id_provincia = prov.id_provincia
        INNER JOIN departamentos as dep ON prov.id_departamento = dep.id_departamento";

    // Preparar y ejecutar la consulta
    $query_destinos = $pdo->prepare($sql_destinos);
    $query_destinos->execute();
    $destinos_datos = $query_destinos->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se obtienen datos
    if ($destinos_datos === false) {
        echo "Error en la consulta.";
    } elseif (empty($destinos_datos)) {
        echo "No se encontraron datos.";
    } else {
        // Los datos están disponibles para usar en el HTML
        // Puedes procesarlos y mostrarlos en la parte HTML del archivo.
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>
