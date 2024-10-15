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
                <div class="card shadow-sm">
                    <div class="card-header bg-info">
                        <h5 class="card-title text-white">Información de <?php echo htmlspecialchars($destino['nombre_destino']); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                $infoFields = [
                                    'Nombre del Destino' => ['icon' => 'map-marker-alt', 'value' => $destino['nombre_destino']],
                                    'Ubicación' => ['icon' => 'globe', 'value' => $destino['ubicacion_destino']],
                                    'Departamento' => ['icon' => 'building', 'value' => $destino['nombre_departamento']],
                                    'Provincia' => ['icon' => 'map', 'value' => $destino['nombre_provincia']],
                                    'Parque o Reserva' => ['icon' => 'tree', 'value' => $destino['parque_reserva_destino']],
                                    'Código' => ['icon' => 'tag', 'value' => $destino['codigo_destino']],
                                    'Categoría' => ['icon' => 'list-alt', 'value' => $destino['nombre_categoria']],
                                    'Breve Descripción' => ['icon' => 'info-circle', 'value' => $destino['descripcion_destino']]
                                ];

                                foreach ($infoFields as $label => $field) : ?>
                                    <div class="card mb-3 border-0">
                                        <div class="card-body">
                                            <h6 class="card-title"><i class="fas fa-<?php echo $field['icon']; ?> text-primary"></i> <?php echo $label; ?>:</h6>
                                            <p class="text-muted"><?php echo htmlspecialchars($field['value']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3 border-0">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-image text-primary"></i> Fotos:</h6>
                                        <div class="row">
                                            <?php 
                                            for ($i = 1; $i <= 3; $i++) {
                                                if (!empty($destino["imagen{$i}_destino"])) : ?>
                                                    <div class="col-12 mb-3">
                                                        <div class="card border-0">
                                                            <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino["imagen{$i}_destino"]); ?>" alt="Imagen <?php echo $i; ?>" class="img-fluid img-thumbnail" style="width: 100%; height: auto;">
                                                            <div class="card-body text-center">
                                                                <p class="text-muted">Imagen <?php echo $i; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; 
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action mt-3">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php';">Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
