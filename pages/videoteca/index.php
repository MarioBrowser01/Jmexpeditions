<?php
require_once '../../app/controller/config.php';
include '../layouts/header.php';

// Obtener todos los destinos con su portada y contar el número de videos
$sql_destinos = "
    SELECT d.id_destino, d.nombre_destino, COUNT(v.id_video) as num_videos 
    FROM destinos d
    LEFT JOIN videos_destinos v ON d.id_destino = v.id_destino 
    GROUP BY d.id_destino, d.nombre_destino";
$stmt_destinos = $pdo->prepare($sql_destinos);
$stmt_destinos->execute();
$destinos = $stmt_destinos->fetchAll();
?>
<link rel="stylesheet" href="<?php echo $URL; ?>public/css/videotecas/index.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Videoteca</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="../../index.php">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="index.php">Videoteca</a>
                </li>
            </ul>
        </div>

        <div class="row videoteca">
            <?php foreach ($destinos as $destino): ?>
                <div class="col-md-4 mb-4">
                    <div class="card text-white">
                        <a href="detalle-destino.php?nombre_destino=<?php echo urlencode($destino['nombre_destino']); ?>">
                        <?php
                        // Consultar los videos del destino
                        $sql_videos = "SELECT url_video FROM videos_destinos WHERE id_destino = :id_destino";
                        $stmt_videos = $pdo->prepare($sql_videos);
                        $stmt_videos->execute([':id_destino' => $destino['id_destino']]);
                        $videos = $stmt_videos->fetchAll();
                        ?>
                        <?php if (count($videos) > 0): ?>
                            <div class="video-wrapper">
                                <video controls class="card-img">
                                    <source src="../../public/uploads/videos/<?php echo htmlspecialchars($videos[0]['url_video']); ?>" type="video/mp4">
                                    Tu navegador no soporta el elemento de video.
                                </video>
                                <div class="portada-text">
                                    <h3 class="card-title text-white"><?php echo htmlspecialchars($destino['nombre_destino']); ?></h3>
                                </div>
                            </div>
                            <!-- Botón con el número de videos -->
                            <div class="text-center video-count">
                                <button class="btn btn-outline-light btn-md">
                                    <?php echo $destino['num_videos']; ?> &ThinSpace; <i class="fas fa-video"></i>  
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

<?php include '../layouts/footer.php'; ?>
