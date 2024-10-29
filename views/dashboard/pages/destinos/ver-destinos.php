<?php
include '../../app/controller/config.php';
include '../../app/controller/categorias/listar-categoria.php';
include '../../app/controller/destinos/listar-departamentos.php';
include '../../app/controller/destinos/show.php';
include '../layouts/header.php';
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detalles del Destino</h3>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card"> 
                    <div class="card-header">
                        <div class="card-title">Información del Destino</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del Destino:</label>
                                    <p><?php echo htmlspecialchars($destino['nombre_destino']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Ubicación:</label>
                                    <p><?php echo htmlspecialchars($destino['ubicacion_destino']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Departamento:</label>
                                    <p><?php echo htmlspecialchars($destino['nombre_departamento']); ?></p>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Provincia:</label>
                                    <p><?php echo htmlspecialchars($destino['nombre_provincia']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Parque o Reserva:</label>
                                    <p><?php echo htmlspecialchars($destino['parque_reserva_destino']); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Código:</label>
                                    <p><?php echo htmlspecialchars($destino['codigo_destino']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Categoría:</label>
                                    <p><?php echo htmlspecialchars($destino['id_categoria']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Número de Días de Tour:</label>
                                    <p><?php echo htmlspecialchars($destino['dias_destino']); ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Breve Descripción:</label>
                                    <p><?php echo htmlspecialchars($destino['descripcion_destino']); ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Fotos:</label>
                                    <div class="row">
                                        <?php if (!empty($destino['imagen1_destino'])) : ?>
                                            <div class="col-md-4">
                                                <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen1_destino']); ?>" alt="Imagen 1" class="img-thumbnail">
                                                <p>Imagen 1</p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($destino['imagen2_destino'])) : ?>
                                            <div class="col-md-4">
                                                <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen2_destino']); ?>" alt="Imagen 2" class="img-thumbnail">
                                                <p>Imagen 2</p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($destino['imagen3_destino'])) : ?>
                                            <div class="col-md-4">
                                                <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen3_destino']); ?>" alt="Imagen 3" class="img-thumbnail">
                                                <p>Imagen 3</p>
                                            </div>
                                            
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php';">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
