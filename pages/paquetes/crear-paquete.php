<?php
include '../../app/controller/config.php';
include '../layouts/header.php';
include '../../app/controller/paquetes/create.php';
?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Paquetes</h3>

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
                    <a href="#">Registro de Paquete</a>
                </li>
            </ul>
        </div>
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Registro de Paquete</div>
                    </div>
                    <div class="card-body">
                        <form action="../../app/controller/paquetes/create.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="nombreGroup" class="form-group">
                                        <label for="nombre_paquete">Nombre del Paquete</label>
                                        <input type="text" name="nombre_paquete" onkeyup="verificarNombreEntidad('nombre_paquete', 'nombreGroup')" class="form-control" id="nombre_paquete" required>
                                        <small id="nombreError" class="form-text text-muted" style="display:none;">El nombre de paquete ya existe.</small>
                                    </div>
                                    <div id="duracionGroup" class="form-group">
                                        <label for="duracion_paquete">Duración (Días)</label>
                                        <input type="number" class="form-control" id="duracion_paquete" name="duracion_paquete" min="1" required oninput="validarDuracion()">
                                        <small id="duracionError" class="form-text text-muted" style="display:none;">La duración debe ser mayor que 1.</small>
                                    </div>
                                    <div class="form-group" id="nochesGroup" style="display: none;">
                                        <label for="noches_paquete">Número de Noches</label>
                                        <input type="number" class="form-control" id="noches_paquete" name="noches_paquete" min="1">
                                        <small id="nochesError" class="form-text text-muted" style="display:none;">El número de noches debe ser mayor que 0.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_paquete">Tipo de Paquete</label>
                                        <select class="form-control" id="tipo_paquete" name="tipo_paquete" required onchange="ajustarDuracion()">
                                            <option value="FullDay">FullDay</option>
                                            <option value="VariosDías">Varios Días</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_paquete">Precio</label>
                                        <input type="number" class="form-control" id="precio_paquete" name="precio_paquete" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="disponibilidad_paquete">Disponibilidad</label>
                                        <select class="form-control" id="disponibilidad_paquete" name="disponibilidad_paquete" required>
                                            <option value="1">Disponible</option>
                                            <option value="0">No Disponible</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_paquete">Descripción del Paquete</label>
                                        <textarea class="form-control" id="descripcion_paquete" name="descripcion_paquete" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success" data-entity="Paquete">Registrar Paquete</button>

                                <button type="reset" class="btn btn-danger">Nuevo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    

    function verificarNombreEntidad(entidad, grupo) {
        const nombreEntidad = document.getElementById(entidad).value;
        const nombreGroup = document.getElementById(grupo);
        const nombreError = document.getElementById('nombreError');

        fetch(`../../app/controller/paquetes/create.php?nombre_paquete=${nombreEntidad}`)
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    // Aplicar clases de error
                    nombreGroup.classList.add("has-error", "has-feedback");
                    nombreError.style.display = 'block';
                } else {
                    // Remover clases de error
                    nombreGroup.classList.remove("has-error", "has-feedback");
                    nombreError.style.display = 'none';
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

        if (tipoPaquete === "FullDay") {
            duracionPaquete.value = 1;
            duracionPaquete.min = 1;
            duracionPaquete.max = 1;
            duracionPaquete.disabled = true; // Deshabilitar cuando es FullDay
            nochesGroup.style.display = "none"; // Ocultar el campo de noches
            nochesPaquete.value = ""; // Limpiar el campo de noches
            ocultarErrorNoches(); // Ocultar el error de noches
            ocultarErrorDuracion(); // Ocultar el error de duración
        } else {
            duracionPaquete.value = 2; // Valor predeterminado para varios días
            duracionPaquete.min = 2;
            duracionPaquete.max = ""; // Quitar restricción de máximo
            duracionPaquete.disabled = false; // Habilitar cuando es Varios Días
            nochesGroup.style.display = "block"; // Mostrar el campo de noches
        }
    }

    function validarDuracion() {
        const duracionPaquete = document.getElementById("duracion_paquete").value;
        const duracionGroup = document.getElementById("duracionGroup");
        const duracionError = document.getElementById("duracionError");

        if (duracionPaquete < 2 && document.getElementById("tipo_paquete").value === "VariosDías") {
            // Aplicar estilo de error
            duracionGroup.classList.add("has-error", "has-feedback");
            duracionError.style.display = "block";
        } else {
            // Remover estilo de error
            ocultarErrorDuracion();
        }
    }

    function validarNoches() {
        const nochesPaquete = document.getElementById("noches_paquete").value;
        const nochesGroup = document.getElementById("nochesGroup");
        const nochesError = document.getElementById("nochesError");

        if (nochesPaquete < 1 && document.getElementById("tipo_paquete").value === "VariosDías") {
            // Aplicar estilo de error
            nochesGroup.classList.add("has-error", "has-feedback");
            nochesError.style.display = "block";
        } else {
            // Remover estilo de error
            ocultarErrorNoches();
        }
    }

    function ocultarErrorDuracion() {
        const duracionGroup = document.getElementById("duracionGroup");
        const duracionError = document.getElementById("duracionError");

        duracionGroup.classList.remove("has-error", "has-feedback");
        duracionError.style.display = "none";
    }

    function ocultarErrorNoches() {
        const nochesGroup = document.getElementById("nochesGroup");
        const nochesError = document.getElementById("nochesError");

        nochesGroup.classList.remove("has-error", "has-feedback");
        nochesError.style.display = "none";
    }

    // Eventos para validar al cambiar el valor 
    document.getElementById("duracion_paquete").addEventListener('input', validarDuracion);
    document.getElementById("noches_paquete").addEventListener('input', validarNoches);

    // Inicializar ajuste al cargar la página
    ajustarDuracion();
</script>

<?php
include '../layouts/modal.php';
// include '../layouts/forms.php';
include '../layouts/footer.php';
?>