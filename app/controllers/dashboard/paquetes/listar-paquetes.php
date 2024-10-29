<?php

require_once dirname(__DIR__) . '/config.php'; // Asegúrate de que la ruta sea correcta

if (!isset($pdo)) {
    die("No se pudo conectar a la base de datos.");
}

try {
    // Consulta para obtener los paquetes
    $sql_paquetes = "SELECT 
        pa.id_paquete as id_paquete, 
        pa.nombre_paquete as nombre_paquete, 
        pa.duracion_paquete as duracion_paquete,  
        pa.tipo_paquete as tipo_paquete,  
        pa.precio_paquete as precio_paquete,      
        pa.noches_paquete as noches_paquete,      
        pa.disponibilidad_paquete as disponibilidad_paquete 
        FROM paquetes as pa";

    // Preparar y ejecutar la consulta
    $query_paquetes = $pdo->prepare($sql_paquetes);
    $query_paquetes->execute();
    $paquetes_datos = $query_paquetes->fetchAll(PDO::FETCH_ASSOC);

    if ($paquetes_datos === false) {
        // Si la consulta falla
        echo "Error en la consulta: ";
        var_dump($query_paquetes->errorInfo());
        $paquetes_datos = [];
    } elseif (empty($paquetes_datos)) {
        // Si no se encuentran paquetes
        echo "No se encontraron paquetes.";
    }

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    $paquetes_datos = [];
}
