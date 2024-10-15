<?php
include '../../app/controller/config.php';
include '../../app/controller/categorias/listar-categoria.php';
include '../layouts/header.php';
?>
<link rel="stylesheet" href="<?php echo $URL; ?>public/css/forms/frm-img.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Subir Imagenes</h3>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Formulario de Imagenes</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="../../app/controller/imagenes/upload.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id_destino">Destino:</label>
                                    <select id="id_destino" class="form-control" name="id_destino" required>
                                        <!-- Opciones de destino desde la base de datos -->
                                        <?php
                                        include '../../app/controller/config.php';
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
                                        <div class="image-upload">
                                            <label for="foto3" class="upload-box">
                                                <i class="fas fa-upload h-10"><span class="sm"> Subir imagen</span></i>
                                                <input type="file" id="foto3" name="url_imagen" accept="image/*" class="upload-input-img">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="descripcion_imagen">Descripción de la imagen:</label>
                                        <textarea class="form-control" id="descripcion_imagen" name="descripcion_imagen" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
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