<?php
include '../../app/controller/config.php';
include '../layouts/header.php';
include '../../app/controller/categorias/listar-categoria.php';

// Consulta para obtener los departamentos
$sql_departamentos = "SELECT id_departamento, nombre_departamento FROM departamentos";
$query_departamentos = $pdo->prepare($sql_departamentos);
$query_departamentos->execute();
$departamentos_datos = $query_departamentos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener las provincias (se llenará dinámicamente en base al departamento seleccionado)
$sql_provincias = "SELECT id_provincia, nombre_provincia FROM provincias";
$query_provincias = $pdo->prepare($sql_provincias);
$query_provincias->execute();
$provincias_datos = $query_provincias->fetchAll(PDO::FETCH_ASSOC);

include '../../app/controller/destinos/create.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Registro de destinos</h3>
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
          <a href="#">Destinos</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Registro de destino</a>
        </li>
      </ul>
    </div>
    <!--Eliminados-->
    <!--CONTENIDO INICIO-->
    <div class="col m-0">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Registro de destinos</div>
          </div>
          <div class="card-body">
            <div class="row">
              <form action="../../app/controller/destinos/create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="nombreGroup">
                      <label for="nombre">Nombre del Destino</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="verificarNombreDestino()" required>
                      <small id="nombreError" class="form-text text-muted" style="display: none;">Este nombre de destino ya existe. Por favor, elija otro.</small>
                    </div>


                    <div class="form-group">
                      <label for="ubicacion">Ubicación</label>
                      <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>
                    <div class="form-group">
                      <label for="departamento">Departamento</label>
                      <select class="form-control" id="departamento" name="departamento" required onchange="cargarProvincias(this.value)">
                        <option value="">--- Seleccione un departamento ---</option>
                        <?php
                        if (!empty($departamentos_datos)) {
                          foreach ($departamentos_datos as $departamento) {
                            echo "<option value='" . $departamento['id_departamento'] . "'>" . htmlspecialchars($departamento['nombre_departamento']) . "</option>";
                          }
                        } else {
                          echo "<option value=''>No hay departamentos disponibles</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="provincia">Provincia</label>
                      <select class="form-control" id="provincia" name="provincia" required>
                        <option value="">--- Seleccione una provincia ---</option>
                        <!-- Las provincias se cargarán dinámicamente -->
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="parque_reserva">Parque o Reserva</label>
                      <input type="text" class="form-control" id="parque_reserva" name="parque_reserva" required>
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="codigo">Código</label>
                      <input type="text" class="form-control" id="codigo" name="codigo" readonly>
                    </div>
                    <div class="form-group">
                      <label for="id_categoria">Categoría</label>
                      <select class="form-control" id="id_categoria" onchange="generarCodigo()" name="id_categoria" required>
                        <option value=" " readonly>--- Seleccione alguna categoría ---</option>
                        <?php
                        if (!empty($categorias_datos)) {
                          foreach ($categorias_datos as $categoria) {
                            echo "<option value='" . $categoria['id_categoria'] . "'>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                          }
                        } else {
                          echo "<option value=''>No hay categorías disponibles</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="numero_dias">Número de Días de Tour</label>
                      <input type="number" class="form-control" id="numero_dias" name="numero_dias" required>
                    </div>
                    <div class="form-group">
                      <label for="altitud_destino">Altitud del Destino (msnm)</label>
                      <input type="number" class="form-control" id="altitud_destino" name="altitud_destino" required>
                    </div>
                    <div class="form-group">
                      <label for="descripcion">Breve Descripción</label>
                      <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label >Fotos</label>
                      <div class="image-upload">
                        <label for="foto1" class="upload-box">
                          <i class="fas fa-upload"></i>
                          <input type="file" id="foto1" name="fotos[]" accept="image/*">
                        </label>
                        <label for="foto2" class="upload-box">
                          <i class="fas fa-upload"></i>
                          <input type="file" id="foto2" name="fotos[]" accept="image/*">
                        </label>
                        <label for="foto3" class="upload-box">
                          <i class="fas fa-upload"></i>
                          <input type="file" id="foto3" name="fotos[]" accept="image/*">
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" class="btn btn-success" data-entity="Destino">Registrar</button>
                    <button class="btn btn-danger btn-nuevo">Nuevo</button>
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--CONTENIDO FIN-->
  </div>
</div>

<script>
  // Función para cargar las provincias según el departamento seleccionado
  function cargarProvincias(id_departamento) {
    const provinciaSelect = document.getElementById('provincia');
    provinciaSelect.innerHTML = '<option value="">--- Seleccione una provincia ---</option>'; // Resetear las opciones

    if (id_departamento) {
      fetch(`../../app/controller/destinos/listar-provincias.php?id_departamento=${id_departamento}`)
        .then(response => response.json())
        .then(data => {
          data.forEach(provincia => {
            const option = document.createElement('option');
            option.value = provincia.id_provincia;
            option.textContent = provincia.nombre_provincia;
            provinciaSelect.appendChild(option);
          });
        })
        .catch(error => console.error('Error al cargar provincias:', error));
    }
  }

  //verificar la existencia del destino mediante nombres
  function verificarNombreDestino() {
    const nombreDestino = document.getElementById('nombre').value;
    const nombreGroup = document.getElementById('nombreGroup');
    const nombreError = document.getElementById('nombreError');

    if (nombreDestino.length > 0) {
      fetch(`../../app/controller/destinos/create.php?nombre=${encodeURIComponent(nombreDestino)}`)
        .then(response => response.json())
        .then(data => {
          if (data.existe) {
            nombreGroup.classList.add('has-error', 'has-feedback');
            nombreError.style.display = 'block';
          } else {
            nombreGroup.classList.remove('has-error', 'has-feedback');
            nombreError.style.display = 'none';
          }
        })
        .catch(error => console.error('Error al verificar el nombre del destino:', error));
    } else {
      nombreGroup.classList.remove('has-error', 'has-feedback');
      nombreError.style.display = 'none';
    }
  }
</script>

<?php 
include '../layouts/modal.php'; 
include '../layouts/forms.php'; 
include '../layouts/footer.php'; 
?>