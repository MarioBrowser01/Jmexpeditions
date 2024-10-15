<?php
require_once dirname(__DIR__) . '/config.php';

/**
 * Listar Itinerarios
 * Fecha: 30/09/2024 
 * Creador: DENIS
 */

// Verifica si $pdo está definido
if (!isset($pdo)) {
    die("No se pudo conectar a la base de datos."); 
}

try {
    // Consulta para obtener los itinerarios con información de paquetes y destinos
    $sql_itinerarios = "SELECT 
        i.id_itinerario, 
        p.nombre_paquete, 
        d.nombre_destino, 
        i.orden_itinerario, 
        i.tipo_destino, 
        i.hora_salida, 

        i.descripcion_actividad 
        FROM itinerarios i
        JOIN paquetes p ON i.id_paquete = p.id_paquete
        JOIN destinos d ON i.id_destino = d.id_destino";

    $query_itinerarios = $pdo->prepare($sql_itinerarios);
    $query_itinerarios->execute();
    $itinerarios_datos = $query_itinerarios->fetchAll(PDO::FETCH_ASSOC);

    // Depuración: Verificar si se obtienen datos
    if ($itinerarios_datos === false) {
        echo "Error en la consulta.";
    } 
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}