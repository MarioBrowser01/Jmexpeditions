<?php
// require_once 'layouts/header.php';
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';

// Aquí se obtiene el id del paquete seleccionado.
$id_paquete = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consulta SQL para obtener los detalles del paquete
$sql = "SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento, 
                    i.id_itinerario, i.id_paquete, i.id_destino, 
                    paq.nombre_paquete, paq.duracion_paquete, paq.precio_paquete, paq.noches_paquete, paq.tipo_paquete,
                    i.tipo_destino,
                    d.imagen1_destino, d.imagen2_destino, d.imagen3_destino
                FROM destinos d
                LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
                LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
                LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
                LEFT JOIN itinerarios i ON d.id_destino = i.id_destino
                LEFT JOIN paquetes paq ON i.id_paquete = paq.id_paquete
                WHERE paq.id_paquete = :id_paquete";

// SELECT i.id_itinerario, i.id_paquete, i.id_destino, p.nombre_paquete, 
//                d.nombre_destino, d.imagen1_destino, d.imagen2_destino, d.imagen3_destino
//         FROM itinerarios i
//         JOIN paquetes p ON i.id_paquete = p.id_paquete
//         JOIN destinos d ON i.id_destino = d.id_destino";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
$stmt->execute();
$paquete = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paquete) {
    echo "Paquete no encontrado.";
    exit;
}

// Imágenes del paquete (si las hay)
$imagenes_destino = array_filter([
    $paquete['imagen1_destino'],
    $paquete['imagen2_destino'],
    $paquete['imagen3_destino']
]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>
        <?php 
            if ($paquete) {
                // Si el paquete tiene nombre y departamento, lo incluimos en el título.
                echo htmlspecialchars($paquete['nombre_paquete']) . " | " . "JM Expeditions";
            } else {
                // Título alternativo si no se encuentra el paquete.
                echo "Paquete no encontrado - JM Expeditions";
            }
        ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Cargar tus recursos del header -->

</head>

    <!-- Mostrar barra de navegación -->


    <!-- Contenedor principal -->
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <!-- Sección de imágenes del paquete -->
                <div class="col-md-6">
                    <div id="packageCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php if (!empty($imagenes_destino)): ?>
                                <?php foreach ($imagenes_destino as $index => $imagen): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <img src="/jmexpeditions/public/images/destinos/<?php echo htmlspecialchars($imagen); ?>" class="d-block w-100" alt="Imagen del destino">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="carousel-item active">
                                    <img src="/jmexpeditions/templates/images/default-image.jpg" class="d-block w-100" alt="Imagen por defecto">
                                </div>
                            <?php endif; ?>
                        </div>
                        <a class="carousel-control-prev" href="#packageCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#packageCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <!-- Detalles del paquete -->
                <div class="col-md-6">
                    <div class="text p-4">
                        <h2><?php echo htmlspecialchars($paquete['nombre_paquete']); ?></h2>
                        <p><span class="fa fa-map-marker"></span> Perú, <?php echo htmlspecialchars($paquete['nombre_departamento']); ?>, <?php echo htmlspecialchars($paquete['nombre_provincia']); ?></p>
                        <p><strong>Duración:</strong> <?php echo htmlspecialchars($paquete['duracion_paquete']); ?> días</p>
                        <p><strong>Noches:</strong> <?php echo htmlspecialchars($paquete['noches_paquete']); ?></p>
                        <p><strong>Precio:</strong> <?php echo number_format($paquete['precio_paquete'], 2); ?> PEN</p>
                        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($paquete['nombre_categoria']); ?></p>
                        <p><strong>Tipo de Paquete:</strong> <?php echo htmlspecialchars($paquete['tipo_paquete']); ?></p>

                        <a href="reservar.php?id=<?php echo $paquete['id_paquete']; ?>" class="btn btn-primary">Reservar Ahora</a>
                    </div>
                </div>
            </div>

            <!-- Sección de itinerarios -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Itinerarios</h3>
                    <ul class="list-group">
                        <?php
                        // Consulta SQL para obtener itinerarios del paquete
                        $sql_itinerarios = "SELECT i.*, d.nombre_destino, d.imagen1_destino 
                                            FROM itinerarios i
                                            LEFT JOIN destinos d ON i.id_destino = d.id_destino
                                            WHERE i.id_paquete = :id_paquete";

                        $stmt_itinerarios = $pdo->prepare($sql_itinerarios);
                        $stmt_itinerarios->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
                        $stmt_itinerarios->execute();
                        $itinerarios = $stmt_itinerarios->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($itinerarios as $itinerario): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo htmlspecialchars($itinerario['nombre_destino']); ?>
                                <span><?php echo htmlspecialchars($itinerario['tipo_destino']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

   



<?php
require_once dirname(__DIR__) . '/templates/layouts/footer.php';
?>