<?php
include '../../app/controller/config.php';
include '../../app/controller/categorias/listar-categoria.php';
include '../layouts/header.php';
?>
<link rel="stylesheet" href="<?php echo $URL; ?>public/css/forms/frm-video.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Subir Videos</h3>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Formulario de Videos</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="../../app/controller/videos/upload.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id_destino">Destino:</label>
                                    <select id="id_destino" class="form-control" name="id_destino" required>
                                        <!-- Opciones de destino desde la base de datos -->
                                        <option value="">--- Seleccione un destino ---</option>
                                        <?php
                                        $sql = "SELECT id_destino, nombre_destino FROM destinos";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute();
                                        $destinos = $stmt->fetchAll();

                                        foreach ($destinos as $destino) {
                                            echo "<option value='" . $destino['id_destino'] . "'>" . $destino['nombre_destino'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="video-upload">
                                            <label for="video" class="upload-box">
                                                <i class="fas fa-upload h-10"></i>
                                                <span class="sm"> Subir video</span>
                                                <input type="file" id="video" name="url_video" accept="video/*" class="upload-input-video" required>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="descripcion_video">Descripción del video:</label>
                                        <textarea class="form-control" id="descripcion_video" name="descripcion_video" rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Subir Video</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/modal.php';
include '../layouts/footer.php';
?>
