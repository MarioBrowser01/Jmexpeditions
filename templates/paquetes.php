<?php
// require_once 'layouts/header.php';
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';

// Consulta inicial para obtener todos los destinos
$query = "
    SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
";
$stmt = $pdo->query($query); // Ejecuta la consulta y devuelve un objeto PDOStatement



$departamento_filtro = isset($_GET['departamento']) ? $_GET['departamento'] : '';
$provincia_filtro = isset($_GET['provincia']) ? $_GET['provincia'] : '';
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precio_filtro = isset($_GET['precio']) ? $_GET['precio'] : '';

// Consulta SQL base
$query = "
    SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento, 
           paq.nombre_paquete, paq.duracion_paquete, paq.precio_paquete, paq.noches_paquete, paq.tipo_paquete
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
    LEFT JOIN itinerarios i ON d.id_destino = i.id_destino
    LEFT JOIN paquetes paq ON i.id_paquete = paq.id_paquete
    WHERE 1=1
";

// Agregar filtros dinámicos
if (!empty($departamento_filtro)) {
    $query .= " AND dep.id_departamento = :departamento_filtro";
}
if (!empty($provincia_filtro)) {
    $query .= " AND p.id_provincia = :provincia_filtro";
}
if (!empty($categoria_filtro)) {
    $query .= " AND c.id_categoria = :categoria_filtro";
}
if (!empty($precio_filtro)) {
    $query .= " AND paq.precio_paquete <= :precio_filtro";
}

// Preparar la consulta
$stmt = $pdo->prepare($query);

// Asignar parámetros de filtro
if (!empty($departamento_filtro)) {
    $stmt->bindParam(':departamento_filtro', $departamento_filtro, PDO::PARAM_INT);
}
if (!empty($provincia_filtro)) {
    $stmt->bindParam(':provincia_filtro', $provincia_filtro, PDO::PARAM_INT);
}
if (!empty($categoria_filtro)) {
    $stmt->bindParam(':categoria_filtro', $categoria_filtro, PDO::PARAM_INT);
}
if (!empty($precio_filtro)) {
    $stmt->bindParam(':precio_filtro', $precio_filtro, PDO::PARAM_INT);
}

// Ejecutar la consulta
$stmt->execute();
$itinerarios_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Tour List <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Tours List</h1>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-wrap-1 ftco-animate">
                    <form action="" method="GET" class="search-property-1">
                        <div class="row no-gutters">
                            <div class="col-md d-flex">
                                <div class="form-group p-4 border-0">
                                    <label for="departamento">Departamento</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select id="departamento" name="departamento" class="form-control">
                                                <option value="">Seleccione</option>
                                                <?php
                                                // Obtener departamentos para el filtro
                                                $departamentos = $pdo->query("SELECT * FROM departamentos")->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($departamentos as $departamento) {
                                                    echo "<option value=\"" . htmlspecialchars($departamento['id_departamento']) . "\">" . htmlspecialchars($departamento['nombre_departamento']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group p-4">
                                    <label for="provincia">Provincia</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select id="provincia" name="provincia" class="form-control">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group p-4">
                                    <label for="#">Categoría</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>

                                            <select id="categoria" name="categoria" class="form-control">
                                                <option value="">Seleccione</option>
                                                <?php
                                                // Obtener categorías para el filtro
                                                $categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($categorias as $categoria) {
                                                    echo "<option value=\"" . htmlspecialchars($categoria['id_categoria']) . "\">" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group p-4">
                                    <label for="#">Límite de Precio</label>
                                    <div class="form-field">
                                        <select name="precio" id="precio" class="form-control">
                                            <option value="">Asigne</option>
                                            <option value="5000">$5,000</option>
                                            <option value="10000">$10,000</option>
                                            <option value="50000">$50,000</option>
                                            <option value="100000">$100,000</option>
                                            <option value="200000">$200,000</option>
                                            <option value="300000">$300,000</option>
                                            <option value="400000">$400,000</option>
                                            <option value="500000">$500,000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md d-flex">
                                <div class="form-group d-flex w-100 border-0">
                                    <div class="form-field w-100 align-items-center d-flex">
                                        <!-- <i class="fas fa-globe"></i> -->
                                        <button type="submit" class="align-self-stretch form-control btn btn-primary">
                                            <i class="fas fa-search"></i> &ThinSpace;
                                            Explorar
                                        </button>
                                        <!-- <input type="submit" value="Explorar" class="align-self-stretch form-control btn btn-primary"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="ftco-section">
    <div class="container">
        <div class="row">
            <?php
            // Definir el límite y la página actual
            $limit = 9; // Por ejemplo, 9 itinerarios por página
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Consulta SQL para obtener los datos de los itinerarios
            $sql = "SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento, 
                    i.id_itinerario, i.id_paquete, i.id_destino, 
                    paq.nombre_paquete, paq.duracion_paquete, paq.precio_paquete, paq.noches_paquete, paq.tipo_paquete,
                    i.tipo_destino,
                    d.imagen1_destino, d.imagen2_destino, d.imagen3_destino
                FROM destinos d
                LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
                LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
                LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
                LEFT JOIN itinerarios i ON d.id_destino = i.id_destino
                LEFT JOIN paquetes paq ON i.id_paquete = paq.id_paquete
                WHERE i.tipo_destino = 'final'
                LIMIT :limit OFFSET :offset";

            // Preparar la consulta
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

            try {
                // Ejecutar la consulta
                $stmt->execute();
                $itinerarios_datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Verificar si se encontraron resultados
                if (!empty($itinerarios_datos)) {
                    foreach ($itinerarios_datos as $itinerario) {
                        // Seleccionar imagen aleatoria o imagen por defecto
                        $imagenes_destino = array_filter([
                            $itinerario['imagen1_destino'],
                            $itinerario['imagen2_destino'],
                            $itinerario['imagen3_destino']
                        ]);

                        $imagen_aleatoria = !empty($imagenes_destino) ? $imagenes_destino[array_rand($imagenes_destino)] : 'default-image.jpg';
                        $noche_paquete = htmlspecialchars($itinerario['noches_paquete']);
                        $duracion_paquete = htmlspecialchars($itinerario['duracion_paquete']);
            ?>
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="detalle_paquete.php?id=<?php echo $itinerario['id_paquete']; ?>" class="img" style="background-image: url('/jmexpeditions/public/images/destinos/<?php echo htmlspecialchars($imagen_aleatoria); ?>');">
                                    <span class="price">
                                        <?php echo number_format($itinerario['precio_paquete'], 2); ?> PEN
                                        / <i class="fas fa-user text-orange"></i>
                                    </span>
                                </a>
                                <div class="text p-4">
                                    <span class="days"><?php echo $duracion_paquete; ?> Days Tour</span>

                                    <h3><a href="detalle_paquete.php?id=<?php echo $itinerario['id_paquete']; ?>"><?php echo htmlspecialchars($itinerario['nombre_paquete']); ?></a></h3>

                                    <p class="location"><span class="fa fa-map-marker"></span> Perú, <?php echo htmlspecialchars($itinerario['nombre_departamento']); ?>, <?php echo htmlspecialchars($itinerario['nombre_provincia']); ?></p>

                                    <ul>
                                        <?php if ($noche_paquete > 0): ?>
                                            <li><i class="fas fa-shower text-info"></i> <?php echo $duracion_paquete; ?> días</li>
                                            <li><i class="fas fa-bed text-info"></i> <?php echo $noche_paquete; ?> noches</li>
                                        <?php else: ?>
                                            <li><i class="fas fa-clock text-info"></i> <?php echo $duracion_paquete; ?> día</li>
                                            <li><i class="fas fa-bed text-info"></i> <?php echo $itinerario['tipo_paquete']; ?></li>
                                        <?php endif; ?>
                                        <li><i class="fas fa-mountain text-info"></i> <?php echo $itinerario['nombre_categoria']; ?></li>
                                    </ul>


                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "<p>No se encontraron itinerarios.</p>";
                }
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
            }
            ?>
        </div>
        <!-- Paginación -->
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <li><a href="#">&lt;</a></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url(images/bg_2.jpg);">
                    <div class="overlay"></div>
                    <h2>We Are Pacific A Travel Agency</h2>
                    <p>We can manage your dream building A small river named Duden flows by their place</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departamentoSelect = document.getElementById('departamento');
        const provinciaSelect = document.getElementById('provincia');

        departamentoSelect.addEventListener('change', function() {
            const departamentoId = this.value;
            if (departamentoId) {
                fetch(`../app/controller/destinos/listar-provincias.php?id_departamento=${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        provinciaSelect.innerHTML = '<option value="">Seleccione</option>';
                        data.forEach(provincia => {
                            provinciaSelect.innerHTML += `<option value="${provincia.id_provincia}">${provincia.nombre_provincia}</option>`;
                        });
                    });
            } else {
                provinciaSelect.innerHTML = '<option value="">Seleccione</option>';
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
require_once dirname(__DIR__) . '/templates/layouts/footer.php';
?>
<!-- <section class="ftco-section ftco-no-pb">