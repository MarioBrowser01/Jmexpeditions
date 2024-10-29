<?php
// app/controllers/web/HomeController.php
require_once 'C:\xampp\htdocs\jmexpeditions\app\config.php';


class HomeController {
    public function index() {
        // Cargar la vista principal
        include(BASE_PATH . '/views/web/index.php'); // Asegúrate de que esta ruta sea correcta también
    }
}
?>
