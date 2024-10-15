<?php
include '../../app/controller/config.php';

// Obtener los filtros desde la URL
$departamento = $_GET['departamento'] ?? null;
$provincia = $_GET['provincia'] ?? null;
$categoria = $_GET['categoria'] ?? null;
$ubicacion = $_GET['ubicacion'] ?? null;

// Construir la consulta SQL con los filtros
$query = "
    SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
    WHERE 1=1
";

if ($departamento) {
  $query .= " AND dep.id_departamento = :departamento";
}

if ($provincia) {
  $query .= " AND p.id_provincia = :provincia";
}

if ($categoria) {
  $query .= " AND d.id_categoria = :categoria";
}

if ($ubicacion) {
  $query .= " AND d.ubicacion_destino LIKE :ubicacion";
}

$stmt = $pdo->prepare($query);

if ($departamento) {
  $stmt->bindParam(':departamento', $departamento);
}

if ($provincia) {
  $stmt->bindParam(':provincia', $provincia);
}

if ($categoria) {
  $stmt->bindParam(':categoria', $categoria);
}

if ($ubicacion) {
  $ubicacion = '%' . $ubicacion . '%';
  $stmt->bindParam(':ubicacion', $ubicacion);
}

$stmt->execute();
?>

<?php
if ($stmt->rowCount() > 0) {
    // echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="destinos-list">';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col">';
        echo '<div class="card h-100 shadow-sm">';
        
        // Carousel de imágenes
        echo '<div id="carousel-' . htmlspecialchars($row['id_destino']) . '" class="carousel slide" data-bs-ride="carousel">';
        echo '<div class="carousel-inner">';
        
        echo '<div class="carousel-item active">';
        echo '<img src="' . $URL . 'public/uploads/' . htmlspecialchars($row['imagen1_destino']) . '" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de ' . htmlspecialchars($row['nombre_destino']) . '">';
        echo '</div>';
        
        echo '<div class="carousel-item">';
        echo '<img src="' . $URL . 'public/uploads/' . htmlspecialchars($row['imagen2_destino']) . '" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de ' . htmlspecialchars($row['nombre_destino']) . '">';
        echo '</div>';
        
        echo '<div class="carousel-item">';
        echo '<img src="' . $URL . 'public/uploads/' . htmlspecialchars($row['imagen3_destino']) . '" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Imagen de ' . htmlspecialchars($row['nombre_destino']) . '">';
        echo '</div>';
        
        echo '</div>';  // Cierre de carousel-inner
        
        // Controles del carrusel
        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carousel-' . htmlspecialchars($row['id_destino']) . '" data-bs-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo '<span class="visually-hidden">Anterior</span>';
        echo '</button>';
        
        echo '<button class="carousel-control-next" type="button" data-bs-target="#carousel-' . htmlspecialchars($row['id_destino']) . '" data-bs-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '<span class="visually-hidden">Siguiente</span>';
        echo '</button>';
        
        echo '</div>';  // Cierre del carrusel
        
        // Información del destino
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><a href="#" class="text-decoration-none text-dark">' . htmlspecialchars($row['nombre_destino']) . '</a></h5>';
        echo '<p class="text-muted">';
        echo '<i class="fas fa-tag"></i> <a href="#" class="text-info text-decoration-none">' . htmlspecialchars($row['nombre_categoria']) . '</a>&MediumSpace;';
        echo '<i class="fas fa-ruler-vertical"></i> ' . htmlspecialchars($row['altitud_destino']) . ' m.s.n.m.';
        echo '</p>';
        
        echo '<p>';
        echo '<span class="badge bg-secondary">' . htmlspecialchars($row['nombre_departamento']) . '</span>';
        echo '<span class="badge bg-info">' . htmlspecialchars($row['nombre_provincia']) . '</span>';
        echo '</p>';
        
        // Descripción limitada a 2 líneas con elipsis
        echo '<p class="card-text text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; max-height: 3.6em; line-height: 1.8em;">';
        echo htmlspecialchars($row['descripcion_destino']);
        echo '</p>';
        
        echo '</div>';  // Cierre del card-body
        
        // Botón Ver más
        echo '<div class="card-footer text-center">';
        echo '<a href="ver-destinos.php?id='. htmlspecialchars($row['id_destino']) . '">Ver más</a>';
        
        echo '</div>';
        
        echo '</div>';  // Cierre del card
        echo '</div>';  // Cierre de la columna
    }
    echo '</div>';  // Cierre del row
} else { ?>

  <div class="col-md-12">
    <div class="alert alert-warning text-center" role="alert">
      No se encontraron destinos que coincidan con los filtros aplicados.
    </div>
  </div>

<?php } ?>
