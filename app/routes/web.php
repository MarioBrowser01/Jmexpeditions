<?php
// router.php

// Obtener la URI y el método de la solicitud
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Definir las rutas y los métodos asociados
$routes = [
    'GET' => [
        '/home' => 'HomeController@index',
        '/destino' => 'DestinoController@show',
    ],
    'POST' => [
        '/destino' => 'DestinoController@store',
    ],
    // Agrega otras rutas aquí
];

// Verificar si la ruta solicitada está definida
if (isset($routes[$requestMethod][$requestUri])) {
    list($controller, $method) = explode('@', $routes[$requestMethod][$requestUri]);
    require_once "app/controllers/$controller.php";
    $controllerInstance = new $controller();
    $controllerInstance->$method();
} else {
    // Manejo de ruta no encontrada
    http_response_code(404);
    echo "404 - Página no encontrada";
}
?>
