<?php

// Obtener la IP del servidor
$server_ip = $_SERVER['SERVER_ADDR'];

// Verificar si la IP es localhost o una dirección externa
if ($server_ip === '127.0.0.1' || $server_ip === '::1') {
    // Si es localhost
    $URL = 'http://127.0.0.1/jmexpeditions/';
} else {
    // Si accedes desde otra IP (por ejemplo, tu IP local en la red)
    $URL = 'http://' . $server_ip . '/jmexpeditions/';
}


define('BASE_PATH', dirname(__DIR__));
define('SERVIDOR', 'localhost');
define('USUARIO', 'root'); // Cambia si usas otro usuario
define('PASSWORD', ''); // Cambia si usas una contraseña
define('BD', 'jmexpeditions');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para mostrar errores de PDO
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
date_default_timezone_set("America/Lima");
$fechaHora = date('Y-m-d H:i:s');

