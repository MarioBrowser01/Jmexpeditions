<?php
include '../../app/controller/config.php'; // Incluir archivo de configuración
include '../layouts/header.php'; // Incluir encabezado

// Verificar si se ha pasado el id_itinerario en la URL
if (isset($_GET['id'])) {
    $id_itinerario = intval($_GET['id']); // Convertir el ID a entero para mayor seguridad
} else {
    echo "<p>No se proporcionó un ID de itinerario válido.</p>";
    include '../layouts/footer.php'; // Incluir pie de página si hay un error
    exit;
}

// Incluir el archivo show.php para obtener los detalles del itinerario
include '../../app/controller/itinerarios/show.php';

?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Itinerario</h3>
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
                    <a href="index.php">Itinerarios</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Ver Itinerario</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary2 text-white">
                        <h4 class="card-title text-white">Detalles del Itinerario</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($itinerario)) { ?>
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-map-signs"></i> Paquete</label>
                                        <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($itinerario['nombre_paquete']); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-map-marker-alt"></i> Destino</label>
                                        <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($itinerario['nombre_destino']); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-sort-numeric-up"></i> Orden</label>
                                        <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($itinerario['orden_itinerario']); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-clock"></i> Hora de Salida</label>
                                        <input type="text" class="form-control bg-light" value="<?php echo date("g:i A", strtotime($itinerario['hora_salida'])); ?>" disabled>
                                    </div>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-flag"></i> Tipo de Destino</label>
                                        <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($itinerario['tipo_destino']); ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-primary"><i class="fas fa-tasks"></i> Descripción de la Actividad</label>
                                        <textarea class="form-control bg-light" rows="3" disabled><?php echo htmlspecialchars($itinerario['descripcion_actividad']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        
                                            <br>
                                            <button type="button" class="btn btn-primary col-md-12 d-flex justify-content-between align-items-center" onclick="window.location.href='index.php';">
                                                <i class="fas fa-arrow-left"></i>
                                                <span class="ml-2">Volver</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <p>No se encontraron detalles para este itinerario.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
include '../layouts/footer.php'; // Incluir pie de página
?>