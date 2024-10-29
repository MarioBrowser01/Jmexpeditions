<?php
require_once '../../app/controller/config.php';
include '../layouts/header.php';

// Obtener todos los destinos con su portada
$sql_destinos = "SELECT id_destino, nombre_destino FROM destinos";
$stmt_destinos = $pdo->prepare($sql_destinos);
$stmt_destinos->execute();
$destinos = $stmt_destinos->fetchAll();

?>

<!-- <div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Portadas de Destinos</h3>
        </div>

        <div class="row">
            <?php foreach ($destinos as $destino): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="ver-imagenes-destino.php?id=<?php echo $destino['id_destino']; ?>">
                            <img src="<?php echo $URL . 'public/uploads/photos/' . htmlspecialchars($destino['portada_destino']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($destino['nombre_destino']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($destino['nombre_destino']); ?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="page-inner">
        <div class="row">
            <?php foreach ($destinos as $destino): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5><?php echo htmlspecialchars($destino['nombre_destino']); ?></h5>
                        </div>
                        <div class="card">
                            <?php
                            // Consultar las imágenes del destino
                            $sql_imagenes = "SELECT url_imagen FROM imagenes_destinos WHERE id_destino = :id_destino";
                            $stmt_imagenes = $pdo->prepare($sql_imagenes);
                            $stmt_imagenes->execute([':id_destino' => $destino['id_destino']]);
                            $imagenes = $stmt_imagenes->fetchAll();
                            ?>

                            <?php if (count($imagenes) > 0): ?>
                                <div id="carousel-<?php echo $destino['id_destino']; ?>" class="carousel slide carouselImage">
                                    <div class="carousel-inner">
                                        <?php foreach ($imagenes as $index => $imagen): ?>
                                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                <img src="../../public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>" alt="Imagen del destino" class="d-block w-100">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $destino['id_destino']; ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $destino['id_destino']; ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <p>No hay imágenes disponibles para este destino.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('.carouselImage')
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Cambia la imagen cada 2 segundos
            ride: 'carousel'
        })
    });
</script>
<?php include '../layouts/footer.php'; ?>