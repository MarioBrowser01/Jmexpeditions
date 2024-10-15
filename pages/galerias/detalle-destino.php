<?php
require_once '../../app/controller/config.php';
include '../layouts/header.php';

// Obtener el nombre del destino desde la URL
$nombre_destino = isset($_GET['nombre_destino']) ? urldecode($_GET['nombre_destino']) : '';

// Consultar el ID del destino según su nombre
$sql_destino = "SELECT id_destino FROM destinos WHERE nombre_destino = :nombre_destino";
$stmt_destino = $pdo->prepare($sql_destino);
$stmt_destino->execute([':nombre_destino' => $nombre_destino]);
$destino = $stmt_destino->fetch();

if ($destino) {
    $id_destino = $destino['id_destino'];

    // Consultar todas las imágenes del destino
    $sql_imagenes = "SELECT id_imagen, url_imagen FROM imagenes_destinos WHERE id_destino = :id_destino";
    $stmt_imagenes = $pdo->prepare($sql_imagenes);
    $stmt_imagenes->execute([':id_destino' => $id_destino]);
    $imagenes = $stmt_imagenes->fetchAll();
} else {
    $imagenes = [];
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="<?php echo htmlspecialchars($URL); ?>public/css/galerias/crudImage.min.css" />

<div class="container">
    <div class="page-inner">
    <div class="page-header">
            <h3 class="fw-bold mb-3">Galería</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="index.php">Galería</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Imagenes de <span class="code"><?php echo htmlspecialchars($nombre_destino); ?></span></a>
                </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars($nombre_destino); ?></h3>
            </div>
            <div class="card-body">
                <div class="row image-gallery">
                    <?php if (count($imagenes) > 0): ?>
                        <?php foreach ($imagenes as $imagen): ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="card text-white gallery-inner">
                                    <div class="image-container">
                                        <a href="../../public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>"
                                            class="image-popup"
                                            data-mfp-src="../../public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>">

                                            <div class="gallery-item">
                                                <img src="../../public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>"
                                                    alt="Imagen del destino" class="img-fluid card-img">
                                            </div>
                                        </a>
                                        <div class="image-actions">
                                            <!-- Botón de Editar -->
                                            <a href="editar-imagen.php?id_imagen=<?php echo htmlspecialchars($imagen['id_imagen']); ?>"
                                                class="btn text-center btn-info">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <!-- Botón de Eliminar -->
                                            <form id="form-eliminar-<?php echo $imagen['id_imagen']; ?>" action="../../app/controller/imagenes/delete.php" method="POST">
                                                <input type="hidden" name="id_imagen" value="<?php echo $imagen['id_imagen']; ?>">
                                                <button type="button" class='btn text-center btn-danger btn_eliminar' data-entity="Imagen" onclick="confirmDelete(<?php echo $imagen['id_imagen']; ?>)">
                                                    <i class='fa fa-trash'></i>
                                                </button>
                                            </form>




                                            <!-- <form id="form-eliminar-<?php echo $imagen['id_imagen']; ?>" action="../../app/controller/imagenes/delete.php" method="POST">
                                                <input type="hidden" name="id_imagen" value="<?php echo $imagen['id_imagen']; ?>">
                                                <button type="button" class='btn col btn-danger btn_eliminar' data-entity="Imagen" onclick="confirmDelete(<?php echo $imagen['id_imagen']; ?>)">
                                                    <i class='fa fa-trash'></i>
                                                </button>
                                            </form> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning text-center" role="alert">
                            No hay imágenes disponibles para este destino.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include '../layouts/modal.php';
include '../layouts/footer.php'; ?>
