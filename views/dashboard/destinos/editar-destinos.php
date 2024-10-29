<?php
include '../../app/controller/config.php';
include '../../app/controller/destinos/update.php';
include '../../app/controller/categorias/listar-categoria.php';
include '../../app/controller/destinos/listar-departamentos.php'; // Para obtener la lista de departamentos
include '../layouts/header.php';

if (isset($_GET['id'])) {
    $id_destino = $_GET['id'];

    try {
        // Consulta para obtener los datos del destino
        $sql = "SELECT * FROM destinos WHERE id_destino = :id_destino";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_destino' => $id_destino]);
        $destino = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvieron datos del destino
        if (!$destino) {
            die("Destino no encontrado.");
        }
    } catch (PDOException $e) {
        die("Error al obtener los datos del destino: " . $e->getMessage());
    }
} else {
    die("ID del destino no especificado.");
}
?>
<!-- Incluye SweetAlert2 desde un CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Editar Destino</h3>
        </div>

        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Formulario de Edición</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="<?php echo $URL; ?>app/controller/destinos/update.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_destino" value="<?php echo htmlspecialchars($destino['id_destino']); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_destino">Nombre del Destino</label>
                                            <input type="text" class="form-control" id="nombre_destino" name="nombre_destino" value="<?php echo htmlspecialchars($destino['nombre_destino']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="ubicacion_destino">Ubicación</label>
                                            <input type="text" class="form-control" id="ubicacion_destino" name="ubicacion_destino" value="<?php echo htmlspecialchars($destino['ubicacion_destino']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="departamento">Departamento</label>
                                            <select class="form-control" id="departamento" name="id_departamento" onchange="cargarProvincias()" required>
                                                <option value="" readonly>--- Seleccione un departamento ---</option>
                                                <?php
                                                if (!empty($departamentos_datos)) {
                                                    foreach ($departamentos_datos as $departamento) {
                                                        $selected = $departamento['id_departamento'] == $destino['id_departamento'] ? 'selected' : '';
                                                        echo "<option value='" . $departamento['id_departamento'] . "' $selected>" . htmlspecialchars($departamento['nombre_departamento']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No hay departamentos disponibles</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="provincia">Provincia</label>
                                            <select class="form-control" id="provincia" name="id_provincia" required>
                                                <option value="">--- Seleccione una provincia ---</option>
                                                <?php
                                                if (!empty($provincias_datos)) {
                                                    foreach ($provincias_datos as $provincia) {
                                                        $selected = $provincia['id_provincia'] == $provinciaSeleccionada ? 'selected' : '';
                                                        echo "<option value='" . $provincia['id_provincia'] . "' $selected>" . htmlspecialchars($provincia['nombre_provincia']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No hay provincias disponibles</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="parque_reserva_destino">Parque o Reserva</label>
                                            <input type="text" class="form-control" id="parque_reserva_destino" name="parque_reserva_destino" value="<?php echo htmlspecialchars($destino['parque_reserva_destino'] ?? ''); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="codigo_destino">Código</label>
                                            <input type="text" class="form-control" id="codigo_destino" name="codigo_destino" value="<?php echo htmlspecialchars($destino['codigo_destino']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <select class="form-control" id="categoria" name="id_categoria" required>
                                                <option value="" readonly>--- Seleccione alguna categoría ---</option>
                                                <?php
                                                if (!empty($categorias_datos)) {
                                                    foreach ($categorias_datos as $categoria) {
                                                        $selected = $categoria['id_categoria'] == $destino['id_categoria'] ? 'selected' : '';
                                                        echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No hay categorías disponibles</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dias_destino">Número de Días de Tour</label>
                                            <input type="number" class="form-control" id="dias_destino" name="dias_destino" value="<?php echo htmlspecialchars($destino['dias_destino']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion_destino">Breve Descripción</label>
                                            <textarea class="form-control" id="descripcion_destino" name="descripcion_destino" rows="3" required><?php echo htmlspecialchars($destino['descripcion_destino']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fotos">Fotos</label>
                                            <div class="image-upload col-md-12">
                                                <!-- Mostrar imágenes actuales -->
                                                <div>
                                                    <?php if (!empty($destino['imagen1_destino'])) : ?>
                                                        <div class="current-image">
                                                            <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen1_destino']); ?>" alt="Imagen 1" class="img-thumbnail">
                                                            <p>Imagen 1 Actual</p>
                                                        </div>
                                                    <?php endif; ?>
                                                    <label for="foto1" class="upload-box">
                                                        <i class="fas fa-upload"></i>
                                                        <input type="file" id="foto1" name="fotos[]" accept="image/*">
                                                    </label>
                                                </div>
                                                <div>
                                                    <?php if (!empty($destino['imagen2_destino'])) : ?>
                                                        <div class="current-image">
                                                            <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen2_destino']); ?>" alt="Imagen 2" class="img-thumbnail">
                                                            <p>Imagen 2 Actual</p>
                                                        </div>
                                                    <?php endif; ?>
                                                    <label for="foto2" class="upload-box">
                                                        <i class="fas fa-upload"></i>
                                                        <input type="file" id="foto2" name="fotos[]" accept="image/*">
                                                    </label>
                                                </div>
                                                <div>
                                                    <?php if (!empty($destino['imagen3_destino'])) : ?>
                                                        <div class="current-image">
                                                            <img src="<?php echo '../../app/controller/public/uploads/' . htmlspecialchars($destino['imagen3_destino']); ?>" alt="Imagen 3" class="img-thumbnail">
                                                            <p>Imagen 3 Actual</p>
                                                        </div>
                                                    <?php endif; ?>
                                                    <label for="foto3" class="upload-box">
                                                        <i class="fas fa-upload"></i>
                                                        <input type="file" id="foto3" name="fotos[]" accept="image/*">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success" data-entity="destino">Actualizar</button>
                                        
                                        <button type="button" class="btn btn-secondary" onclick="cancelarActualizar('Destino')" data-entity="Destino">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Cargar provincias basadas en el departamento seleccionado
    function cargarProvincias(provinciaSeleccionada = null) {
        var id_departamento = document.getElementById('departamento').value;
        var provinciaSelect = document.getElementById('provincia');

        if (id_departamento) {
            fetch(`../../app/controller/destinos/listar-provincias.php?id_departamento=${id_departamento}`)
                .then(response => response.json())
                .then(data => {
                    provinciaSelect.innerHTML = '<option value="">--- Seleccione una provincia ---</option>';
                    data.forEach(provincia => {
                        let selected = provincia.id_provincia == provinciaSeleccionada ? 'selected' : '';
                        provinciaSelect.innerHTML += `<option value="${provincia.id_provincia}" ${selected}>${provincia.nombre_provincia}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error al cargar las provincias:', error);
                });
        } else {
            provinciaSelect.innerHTML = '<option value="">--- Seleccione un departamento primero ---</option>';
        }
    }



    // Llamar a la función cargarProvincias si ya hay un departamento seleccionado
    document.addEventListener('DOMContentLoaded', function() {
        var provinciaSeleccionada = <?php echo json_encode($destino['id_provincia']); ?>;
        if (document.getElementById('departamento').value) {
            cargarProvincias(provinciaSeleccionada);
        }
    });
</script>

<?php 
include '../layouts/footer.php'; 
include '../layouts/modal.php'; 
?>