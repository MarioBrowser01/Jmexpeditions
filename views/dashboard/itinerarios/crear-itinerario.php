<?php
include '../../app/controller/config.php';
include '../layouts/header.php';

// Consulta para obtener los paquetes
$sql_paquetes = "SELECT id_paquete, nombre_paquete FROM paquetes";
$query_paquetes = $pdo->prepare($sql_paquetes);
$query_paquetes->execute();
$paquetes_datos = $query_paquetes->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener los destinos
$sql_destinos = "SELECT id_destino, nombre_destino FROM destinos";
$query_destinos = $pdo->prepare($sql_destinos);
$query_destinos->execute();
$destinos_datos = $query_destinos->fetchAll(PDO::FETCH_ASSOC);

include '../../app/controller/itinerarios/create.php';
?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Itinerarios</h3>
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
                    <a href="index.php">Itinerario</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Registro de Itinerario</a>
                </li>
            </ul>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Registro de Itinerario</div>
                    </div>
                    <div class="card-body">
                        <form action="../../app/controller/itinerarios/create.php" method="post">
                            <div class="row">
                                <!-- Selección de Paquete -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_paquete">Paquete</label>
                                        <select class="form-control" id="id_paquete" name="id_paquete" required>
                                            <option value="">--- Seleccione un paquete ---</option>
                                            <?php
                                            if (!empty($paquetes_datos)) {
                                                foreach ($paquetes_datos as $paquete) {
                                                    echo "<option value='" . $paquete['id_paquete'] . "'>" . htmlspecialchars($paquete['nombre_paquete']) . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No hay paquetes disponibles</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Selección de Destino -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_destino">Destino</label>
                                        <select class="form-control" id="id_destino" name="id_destino" required>
                                            <option value="">--- Seleccione un destino ---</option>
                                            <?php
                                            if (!empty($destinos_datos)) {
                                                foreach ($destinos_datos as $destino) {
                                                    echo "<option value='" . $destino['id_destino'] . "'>" . htmlspecialchars($destino['nombre_destino']) . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No hay destinos disponibles</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Orden del Itinerario -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="orden_itinerario">Orden del Itinerario</label>
                                        <input type="number" class="form-control" id="orden_itinerario" name="orden_itinerario" required>
                                    </div>
                                </div>
                                <!-- Hora de Salida -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hora_salida">Hora de Salida (HH:MM)</label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
                                            <div class="input-group-append">
                                                <select class="form-control" id="tipo_hora" name="tipo_hora" required>
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tipo de Destino -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_destino">Tipo destino</label>
                                        <select class="form-control" id="tipo_destino" name="tipo_destino" required>

                                            <option selected>--- Seleccione un tipo de destino ---</option>

                                            <option value="Transitorio">Transitorio</option>
                                            <option value="Final">Final</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion_actividad">Descripción de la Actividad</label>
                                        <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad" rows="3" required></textarea>
                                    </div>
                                </div>


                            </div>

                            <!-- Botones de acción -->
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Registrar Itinerario</button>
                                <button type="reset" class="btn btn-danger">Limpiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
?>
