<?php
// public/index.php

// Incluir controladores
require_once '../app/controllers/config.php';
require_once '../app/controllers/web/HomeController.php';
require_once '../app/controllers/web/DestinoController.php';
// require_once '../app/controllers/web/GaleriaController.php';

// Incluir modelos si es necesario
// require_once '../app/Http/Models/Destino.php'; // Ajusta según necesites

$basePath = 'views/web';
$request_uri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);


// Manejar las rutas
// $request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// Simplicidad en el enrutamiento básico
switch ($request_uri) {
    case '/':
        $controller = new HomeController();
        $controller->index(); // Método para mostrar la vista de inicio
        break;
    case '/destinos':
        $controller = new DestinoController();
        $controller->index(); // Método para listar destinos
        break;
    
    // Agrega más rutas según sea necesario
    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}

?>
