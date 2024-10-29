<?php
require_once 'app/Http/Controllers/config.php';
include_once 'resource/views/dashboard/layouts/header.php';

// Obtener todos los destinos con su portada y contar el número de imágenes
$sql_destinos = "
    SELECT d.id_destino, d.nombre_destino, COUNT(i.id_imagen) as num_imagenes 
    FROM destinos d
    LEFT JOIN imagenes_destinos i ON d.id_destino = i.id_destino 
    GROUP BY d.id_destino, d.nombre_destino";
$stmt_destinos = $pdo->prepare($sql_destinos);
$stmt_destinos->execute();
$destinos = $stmt_destinos->fetchAll();
?>
<link rel="stylesheet" href="<?php echo $URL; ?>public/css/galerias/index.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="row galeria">
            <?php foreach ($destinos as $destino): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-black text-white">
                        <a href="resource/views/dashboard/destinos/ver-destinos.php?id=<?php echo urlencode($destino['id_destino']); ?>">
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
                                            <img src="public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>" alt="Imagen del destino" class="d-block w-100 card-img">
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
                                <div class="portada-text">
                                    <h3 class="card-title text-white"><?php echo htmlspecialchars($destino['nombre_destino']); ?></h3>
                                </div>
                            </div>
        
                            <!-- Botón con el número de fotos -->
                            <div class="text-center img-count">
                                <button class="btn btn-outline-light btn-md">
                                    <?php echo $destino['num_imagenes']; ?> &ThinSpace; <i class="fas fa-camera"></i>  
                                </button>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelectorAll('.carouselImage');
        myCarousel.forEach(function(carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 2000, // Cambia la imagen cada 2 segundos
                ride: 'carousel'
            });
        });
    });
</script>

<?php include 'resource/views/dashboard/layouts/footer.php'; ?>
