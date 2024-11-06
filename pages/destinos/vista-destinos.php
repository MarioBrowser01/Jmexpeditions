<?php
include '../../app/controller/config.php';
include '../layouts/header.php';

// Consulta inicial para obtener todos los destinos
$query = "
    SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
";
$stmt = $pdo->query($query); // Ejecuta la consulta y devuelve un objeto PDOStatement
?>

<!--Exportar para carousel-->
<link rel="stylesheet" href="<?php echo $URL; ?>public/css/galerias/index.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<div class="container">
  <div class="page-inner">
    <div class="card col">
      <div class="card-body row position-relative">
        <!-- Filtro por Departamento -->
        <div class="form-group col-md-3">
          <label for="departamento">Departamento</label>
          <select id="departamento" class="form-control">
            <option value="">Selecciona un departamento</option>
            <?php
            // Obtener departamentos para el filtro
            $departamentos = $pdo->query("SELECT * FROM departamentos")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($departamentos as $departamento) {
              echo "<option value=\"" . htmlspecialchars($departamento['id_departamento']) . "\">" . htmlspecialchars($departamento['nombre_departamento']) . "</option>";
            }
            ?>
          </select>
        </div>

        <!-- Filtro por Provincia -->
        <div class="form-group col-md-3">
          <label for="provincia">Provincia</label>
          <select id="provincia" class="form-control">
            <option value="">Selecciona una provincia</option>
            <!-- Opciones se cargarán dinámicamente con JavaScript -->
          </select>
        </div>

        <!-- Filtro por Categoría -->
        <div class="form-group col-md-3">
          <label for="categoria">Categoría</label>
          <select id="categoria" class="form-control">
            <option value="">Selecciona una categoría</option>
            <?php
            // Obtener categorías para el filtro
            $categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categorias as $categoria) {
              echo "<option value=\"" . htmlspecialchars($categoria['id_categoria']) . "\">" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
            }
            ?>
          </select>
        </div>

        <!-- Filtro por Ubicación -->
        <div class="form-group col-md-3">
          <label for="ubicacion">Ubicación</label>
          <input type="text" id="ubicacion" class="form-control" placeholder="Ingresa la ubicación">
        </div>
        <div class="">
          <button type="button" class="btn btn-primary" id="filtrar">Aplicar Filtros</button>
        </div>
      </div>
    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="destinos-list">
      <?php
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <!-- Carousel de imágenes -->
            <div id="carousel-<?php echo $row['id_destino']; ?>" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?php echo $URL; ?>public/images/destinos/<?php echo htmlspecialchars($row['imagen1_destino']); ?>" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de <?php echo htmlspecialchars($row['nombre_destino']); ?>">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo $URL; ?>public/images/destinos/<?php echo htmlspecialchars($row['imagen2_destino']); ?>" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de <?php echo htmlspecialchars($row['nombre_destino']); ?>">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo $URL; ?>public/images/destinos/<?php echo htmlspecialchars($row['imagen3_destino']); ?>" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de <?php echo htmlspecialchars($row['nombre_destino']); ?>">
                </div>
              </div>
              <!-- Controles del carrusel -->
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $row['id_destino']; ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $row['id_destino']; ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
              </button>
            </div>

            <!-- Información del destino -->
            <div class="card-body">
              <h5 class="card-title">
                <a href="#" class="text-decoration-none text-dark"><?php echo htmlspecialchars($row['nombre_destino']); ?></a>
              </h5>
              <p class="text-muted">
                <i class="fas fa-tag"></i> <a href="#" class="text-info text-decoration-none"><?php echo htmlspecialchars($row['nombre_categoria']); ?></a> &MediumSpace;
                <i class="fas fa-ruler-vertical"></i> <?php echo htmlspecialchars($row['altitud_destino']); ?> m.s.n.m.
              </p>
              <p class="text-center">
                <span class="badge bg-secondary"><?php echo htmlspecialchars($row['nombre_departamento']); ?></span> |
                <span class="badge bg-primary"><?php echo htmlspecialchars($row['nombre_provincia']); ?></span>
              </p>
              <p class="card-text text-muted">
                <?php echo htmlspecialchars($row['descripcion_destino']); ?>
              </p>

            </div>

            <!-- Botón Ver más -->
            <div class="card-footer text-center fw-bold">
              <a href="ver-destinos.php?id=<?php echo urlencode($row['id_destino']); ?>">Ver más</a>

            </div>
          </div>
        </div>
      <?php
      }

      ?>
    </div>



  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const departamentoSelect = document.getElementById('departamento');
    const provinciaSelect = document.getElementById('provincia');

    departamentoSelect.addEventListener('change', function() {
      const departamentoId = this.value;
      if (departamentoId) {
        fetch(`../../app/controller/destinos/listar-provincias.php?id_departamento=${departamentoId}`)
          .then(response => response.json())
          .then(data => {
            provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
            data.forEach(provincia => {
              provinciaSelect.innerHTML += `<option value="${provincia.id_provincia}">${provincia.nombre_provincia}</option>`;
            });
          });
      } else {
        provinciaSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
      }
    });

    document.getElementById('filtrar').addEventListener('click', function() {
      const departamento = departamentoSelect.value;
      const provincia = provinciaSelect.value;
      const categoria = document.getElementById('categoria').value;
      const ubicacion = document.getElementById('ubicacion').value;

      fetch(`filtro-destinos.php?departamento=${departamento}&provincia=${provincia}&categoria=${categoria}&ubicacion=${ubicacion}`)
        .then(response => response.text())
        .then(data => {
          const destinosList = document.getElementById('destinos-list');
          destinosList.innerHTML = data;

          // Re-inicializar el carrusel después de actualizar el contenido
          $('.owl-carousel').owlCarousel({
            autoplaySpeed: 100,
            navSpeed: 800,
            items: 1,
            loop: true,
          });
        });
    });
    $('.owl-carousel').owlCarousel({
      autoplaySpeed: 100,
      navSpeed: 800,
      items: 1,
      loop: true,
    });
  });
</script>

<?php
include '../layouts/footer.php';
?>