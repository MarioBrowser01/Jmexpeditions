<?php
include '../../app/controller/config.php';
include '../../app/controller/itinerarios/update.php';
include '../layouts/header.php';

if (isset($_GET['id'])) { 
    $id_itinerario = $_GET['id'];

    try {

        $sql = "SELECT * FROM itinerarios WHERE id_itinerario = :id_itinerario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_itinerario' => $id_itinerario]);
        $itinerario = $stmt->fetch(PDO::FETCH_ASSOC);

        $hora_salida = isset($itinerario['hora_salida']) ? substr($itinerario['hora_salida'], 0, 5) : '00:00';


        // Verificar si se obtuvieron datos del itinerario
        if (!$itinerario) {
            die("Itinerario no encontrado.");
        }


        // Obtener los paquetes para mostrarlos en el select
        $sql_paquetes = "SELECT id_paquete, nombre_paquete FROM paquetes";
        $stmt_paquetes = $pdo->query($sql_paquetes);
        $paquetes = $stmt_paquetes->fetchAll(PDO::FETCH_ASSOC);

        // Obtener los destinos para mostrarlos en el select
        $sql_destinos = "SELECT id_destino, nombre_destino FROM destinos";
        $stmt_destinos = $pdo->query($sql_destinos);
        $destinos = $stmt_destinos->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error al obtener los datos del itinerario: " . $e->getMessage());
    }
} else {
    die("ID del itinerario no especificado.");
}
?>
<!-- Incluye SweetAlert2 desde un CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
                    <a href="index.php">Itinerarios</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Editar de itinerarios</a>
                </li>

            </ul>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Formulario de Edición</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="<?php echo $URL; ?>app/controller/itinerarios/update.php" method="post">
                                <input type="hidden" name="id_itinerario" value="<?php echo htmlspecialchars($itinerario['id_itinerario']); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_paquete">Paquete</label>
                                            <select class="form-control" id="id_paquete" name="id_paquete" required>
                                                <option value="">Seleccione un paquete</option>
                                                <?php foreach ($paquetes as $paquete) : ?>
                                                    <option value="<?php echo $paquete['id_paquete']; ?>" <?php echo $itinerario['id_paquete'] == $paquete['id_paquete'] ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($paquete['nombre_paquete']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="id_destino">Destino</label>
                                            <select class="form-control" id="id_destino" name="id_destino" required>
                                                <option value="">Seleccione un destino</option>
                                                <?php foreach ($destinos as $destino) : ?>
                                                    <option value="<?php echo $destino['id_destino']; ?>" <?php echo $itinerario['id_destino'] == $destino['id_destino'] ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($destino['nombre_destino']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="orden_itinerario">Orden del Itinerario</label>
                                            <input type="number" class="form-control" id="orden_itinerario" name="orden_itinerario" value="<?php echo htmlspecialchars($itinerario['orden_itinerario']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_salida">Hora de salida</label>
                                            
                                            <input type="time" class="form-control" id="hora_salida" name="hora_salida" value="<?php echo htmlspecialchars($hora_salida); ?>" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="tipo_destino">Tipo de Destino</label>
                                            <input type="text" class="form-control" id="tipo_destino" name="tipo_destino" value="<?php echo htmlspecialchars($itinerario['tipo_destino']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion_actividad">Descripción de la Actividad</label>
                                            <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad" rows="3" required><?php echo htmlspecialchars($itinerario['descripcion_actividad']); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button onclick="cancelarActualizar('Itinerario')" data-entity="Itinerario" class="btn btn-danger">Cancelar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <?php
                try {
                    // Consulta para obtener los datos del itinerario
                    $sql = "SELECT * FROM itinerarios WHERE id_itinerario = :id_itinerario";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':id_itinerario' => $id_itinerario]);
                    $itinerario = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Depurar los datos recuperados
                    // var_dump($itinerario); // Muestra todos los datos del itinerario

                    // Verifica si se obtuvieron datos del itinerario
                    if (!$itinerario) {
                        die("Itinerario no encontrado.");
                    }
                } catch (PDOException $e) {
                    die("Error al obtener los datos del itinerario: " . $e->getMessage());
                }

                ?>

            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
include '../layouts/modal.php';
?>
