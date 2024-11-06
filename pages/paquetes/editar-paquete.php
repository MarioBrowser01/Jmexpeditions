<?php
include '../../app/controller/config.php';
include '../layouts/header.php';
include '../../app/controller/paquetes/update.php';

if (isset($_GET['id'])) {
    $id_paquete = $_GET['id'];

    // Consulta para obtener los datos del paquete
    $sql = "SELECT * FROM paquetes WHERE id_paquete = :id_paquete";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_paquete' => $id_paquete]);
    $paquete = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se obtuvo un paquete
    if (!$paquete) {
        echo "<p>No se encontró el paquete con el id especificado.</p>";
        exit;
    }
} else {
    echo "<p>No se ha especificado un id de paquete válido.</p>";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itinerarios = $_POST['itinerarios']; // Recibir itinerarios como array
    // Procesar el resto de los campos y actualizar en la base de datos...
}

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Editar Paquete</h3>
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
                    <a href="#">Editar Paquete</a>
                </li>
            </ul>
        </div>
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Editar Paquete</div>
                    </div>
                    <div class="card-body">
                        <form action="../../app/controller/paquetes/update.php" method="post">
                            <input type="hidden" name="id_paquete" value="<?php echo htmlspecialchars($paquete['id_paquete']); ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="nombreGroup" class="form-group">
                                        <label for="nombre_paquete">Nombre del Paquete</label>
                                        <input type="text" name="nombre_paquete" onkeyup="verificarNombreEntidad('nombre_paquete', 'nombreGroup')" class="form-control" id="nombre_paquete" value="<?php echo htmlspecialchars($paquete['nombre_paquete']); ?>" required>
                                        <span class="help-block" style="display:none;">Este nombre de paquete ya existe</span>
                                    </div>

                                    <div id="duracionGroup" class="form-group">
                                        <label for="duracion_paquete">Duración (Días)</label>
                                        <input type="number" class="form-control" id="duracion_paquete" name="duracion_paquete" value="<?php echo htmlspecialchars($paquete['duracion_paquete']); ?>" required>
                                        <small id="duracionError" class="form-text text-muted" style="display:none;">La duración debe ser mayor que 1.</small>
                                    </div>
                                    <div class="form-group" id="nochesGroup" style="display: none;">
                                        <label for="noches_paquete">Número de Noches</label>
                                        <input type="number" class="form-control" id="noches_paquete" name="noches_paquete" value="<?php echo htmlspecialchars($paquete['noches_paquete']); ?>">
                                        <small id="nochesError" class="form-text text-muted" style="display:none;">El número de noches debe ser mayor que 0.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_paquete">Tipo de Paquete</label>
                                        <select class="form-control" id="tipo_paquete" name="tipo_paquete" required onchange="ajustarDuracion()">
                                            <option value="Varios días" <?php echo $paquete['tipo_paquete'] == 'VariosDías' ? 'selected' : ''; ?>>Varios Días</option>
                                            <option value="FullDay" <?php echo $paquete['tipo_paquete'] == 'FullDay' ? 'selected' : ''; ?>>FullDay</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_paquete">Precio</label>
                                        <input type="text" class="form-control" id="precio_paquete" name="precio_paquete" value="<?php echo htmlspecialchars($paquete['precio_paquete']); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="disponibilidad_paquete">Disponibilidad</label>
                                        <select class="form-control" id="disponibilidad_paquete" name="disponibilidad_paquete" required>
                                            <option value="1" <?php echo $paquete['disponibilidad_paquete'] == 1 ? 'selected' : ''; ?>>Disponible</option>
                                            <option value="0" <?php echo $paquete['disponibilidad_paquete'] == 0 ? 'selected' : ''; ?>>No Disponible</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_paquete">Descripción del Paquete</label>
                                        <textarea class="form-control" id="descripcion_paquete" name="descripcion_paquete" rows="4" required><?php echo htmlspecialchars($paquete['descripcion_paquete']); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-primary">Actualizar Paquete</button>
                                <button onclick="cancelarActualizar('Paquete')" data-entity="Paquete" class="btn btn-danger" type="reset" >Salir</button>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Itinerarios de paquetes</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">

                            <div id="itinerarios">
                                <?php foreach ($itinerariosExistentes as $itinerario): ?>
                                    <div class="itinerario">
                                        <input type="text" name="itinerarios[]" class="form-control" value="<?php echo htmlspecialchars($itinerario); ?>" required>
                                        <button type="button" class="btn btn-danger" onclick="eliminarItinerario(this)">Eliminar</button>
                                    </div>
                                <?php endforeach; ?>
                                <div class="itinerario">
                                    <input type="text" name="itinerarios[]" class="form-control" placeholder="Descripción del itinerario" required>
                                    <button type="button" class="btn btn-danger" onclick="eliminarItinerario(this)">Eliminar</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="agregarItinerario()">Agregar Itinerario</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function agregarItinerario() {
        const itinerariosDiv = document.getElementById('itinerarios');
        const nuevoItinerario = document.createElement('div');
        nuevoItinerario.classList.add('itinerario');
        nuevoItinerario.innerHTML = `
        <input type="text" name="itinerarios[]" class="form-control" placeholder="Descripción del itinerario" required>
        <button type="button" class="btn btn-danger" onclick="eliminarItinerario(this)">Eliminar</button>
    `;
        itinerariosDiv.appendChild(nuevoItinerario);
    }

    function eliminarItinerario(button) {
        const itinerarioDiv = button.parentElement;
        itinerarioDiv.remove();
    }





    function verificarNombreEntidad(entidad, grupo) {
        const nombreEntidad = document.getElementById(entidad).value;
        fetch(`../../app/controller/paquetes/create.php?nombre_paquete=${nombreEntidad}`)
            .then(response => response.json())
            .then(data => {
                const helpBlock = document.querySelector(`#${grupo} .help-block`);
                if (data.existe) {
                    helpBlock.style.display = 'block';
                } else {
                    helpBlock.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error al verificar el nombre de paquetes:', error);
            });
    }

    function ajustarDuracion() {
        const tipoPaquete = document.getElementById("tipo_paquete").value;
        const duracionPaquete = document.getElementById("duracion_paquete");
        const nochesGroup = document.getElementById("nochesGroup");
        const nochesPaquete = document.getElementById("noches_paquete");
        if (tipoPaquete === "Varios Días"){
            duracionPaquete.value = 2;
            duracionPaquete.min = 2;
            duracionPaquete.max = "";
            duracionPaquete.disabled = false;
            nochesGroup.style.display = "block";
        }

        if (tipoPaquete === "FullDay") {
            duracionPaquete.value = 1;
            duracionPaquete.min = 1;
            duracionPaquete.max = 1;
            duracionPaquete.disabled = true;
            nochesGroup.style.display = "none";
            nochesPaquete.value = ""; // Limpiar el campo de noches
            ocultarErrorNoches();
        } else {
            duracionPaquete.value = 2;
            duracionPaquete.min = 2;
            duracionPaquete.max = "";
            duracionPaquete.disabled = false;
            nochesGroup.style.display = "block";
        }
        
        
    }

    function ocultarErrorNoches() {
        const nochesGroup = document.getElementById("nochesGroup");
        const nochesError = document.getElementById("nochesError");
        nochesGroup.classList.remove("has-error", "has-feedback");
        nochesError.style.display = "none";
    }

    // Ejecutar ajuste de duración al cargar la página
    ajustarDuracion();
</script>

<?php
include '../layouts/modal.php';
include '../layouts/footer.php';
?>