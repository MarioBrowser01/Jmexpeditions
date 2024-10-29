<?php
require_once dirname(__DIR__) . '/config.php';

try {
    // Consulta para obtener la lista de departamentos
    $sql = "SELECT id_departamento, nombre_departamento FROM departamentos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all departments
    $departamentos_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los departamentos: " . $e->getMessage());
}




