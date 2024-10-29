<?php
// app/config.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir la URL base
define('URL', 'http://localhost/jmexpeditions/');


// Obtener la IP del servidor
// $server_ip = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '127.0.0.1';

// // Verificar si la IP es localhost o una dirección externa
// if ($server_ip === '127.0.0.1' || $server_ip === '::1') {
//     // Si es localhost
//     $URL = 'http://127.0.0.1/jmexpeditions/';
//     // $URL = 'http://localhost:3000/jmexpeditions/';

// }elseif($server_ip === 'localhost:3000'){
//     $URL = 'http://localhost/jmexpeditions/';

// } else {
//     $URL = 'http://' . $server_ip . '/jmexpeditions/';
// }



define('BASE_PATH', dirname(__DIR__)); // Define la base del proyecto
define('PUBLIC_URL', URL . 'public/');
define('SERVIDOR', 'localhost');
define('USUARIO', 'root'); 
define('PASSWORD', ''); 
define('BD', 'jmexpeditions');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}

date_default_timezone_set("America/Lima");
$fechaHora = date('Y-m-d H:i:s');


