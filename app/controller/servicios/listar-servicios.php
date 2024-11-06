<?php
// Incluir archivo de configuración o establecer conexión a la base de datos
require_once dirname(__DIR__) . '/config.php';


// Consultar todos los servicios desde la base de datos
$sql_servicios = "SELECT * FROM `servicios`";
$query_servicios = $pdo->prepare($sql_servicios);
$query_servicios->execute();
$servicios_datos = $query_servicios->fetchAll(PDO::FETCH_ASSOC);


// Si no hay servicios
if (empty($servicios_datos)) {
    echo "<p>No se encontraron servicios disponibles.</p>";
    exit();
}

?>