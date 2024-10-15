<?php
include '../../app/controller/config.php';
include '../../app/controller/paquetes/show.php';
// include '../../app/controller/itinerarios/listar-itinerarios.php';
include '../layouts/header.php';
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detalles del Paquete</h3>
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
                    <a href="index.php">Paquetes</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detalles del Paquete</a>
                </li>
            </ul>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo htmlspecialchars($paquete['nombre_paquete']); ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-info-circle"></i> <strong>Descripción</strong></td>
                                        <td><?php echo htmlspecialchars($paquete['descripcion_paquete']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-clock"></i>
                                        <strong>Duración</strong></td>
                                        <td><?php echo htmlspecialchars($paquete['duracion_paquete']); ?> días</td>
                                    </tr>
                                    <?php if ($paquete['noches_paquete'] > 0) { ?>
                                        <tr>
                                            <td><i class="fas fa-moon"></i> <strong>Noches</strong></td>
                                            <td><?php echo htmlspecialchars($paquete['noches_paquete']); ?> noches</td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><i class="fas fa-tags"></i> <strong>Tipo</strong></td>
                                        <td><?php echo htmlspecialchars($paquete['tipo_paquete']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-dollar-sign"></i> <strong>Precio</strong></td>
                                        <td>$<?php echo htmlspecialchars($paquete['precio_paquete']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-check-circle"></i> <strong>Disponibilidad</strong></td>
                                        <td>
                                            <?php if ($paquete['disponibilidad_paquete']) { ?>
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check"></i> Disponible
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times"></i> No Disponible
                                                </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Volver a Paquetes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Itinerarios -->
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Itinerarios Vinculados</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Paquete</th>
                                    <th class="border-top-0">Destino</th>
                                    <th class="border-top-0">Orden</th>
                                    <th class="border-top-0">Hora de salida</th>
                                    <th class="border-top-0">Tipo de Destino</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($itinerarios_datos as $itinerario) {
                                    $id_itinerario = htmlspecialchars($itinerario['id_itinerario']);
                                    $nombre_paquete = htmlspecialchars($itinerario['nombre_paquete']);
                                    $nombre_destino = htmlspecialchars($itinerario['nombre_destino']);
                                    $orden_itinerario = htmlspecialchars($itinerario['orden_itinerario']);
                                    $hora_salida = htmlspecialchars($itinerario['hora_salida']);
                                    $tipo_destino = htmlspecialchars($itinerario['tipo_destino']);
                                ?>
                                    <tr>
                                        <td>
                                            <center><?php echo ++$contador; ?></center>
                                        </td>
                                        <td><?php echo $nombre_paquete; ?></td>
                                        <td><?php echo $nombre_destino; ?></td>
                                        <td><?php echo $orden_itinerario; ?></td>
                                        <td><?php echo $hora_salida; ?></td>
                                        <td><?php echo $tipo_destino; ?></td>
                                        <td>
                                            <center>
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    <a href="ver-itinerario.php?id=<?php echo $id_itinerario; ?>" type="button" class="btn col text-center btn-info"><i class="fa fa-eye"></i></a>

                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>