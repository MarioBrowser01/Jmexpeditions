<?php
include '../app/controller/config.php';
require_once dirname(__DIR__) . '/templates/layouts/header.php';

$id_paquete = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_paquete === 0) {
    echo "Paquete no válido.";
    exit;
}

// Obtener información del paquete
$sql = "SELECT nombre_paquete, duracion_paquete, precio_paquete 
        FROM paquetes 
        WHERE id_paquete = :id_paquete";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
$stmt->execute();
$paquete = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paquete) {
    echo "Paquete no encontrado.";
    exit;
}

// Obtener el id_destino del itinerario
$sql_itinerario = "SELECT id_destino FROM itinerarios WHERE id_paquete = :id_paquete";
$stmt_itinerario = $pdo->prepare($sql_itinerario);
$stmt_itinerario->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
$stmt_itinerario->execute();
$itinerario = $stmt_itinerario->fetch(PDO::FETCH_ASSOC);

if (!$itinerario) {
    echo "Itinerario no encontrado.";
    exit;
}

// Obtener imágenes del destino
try {
    $id_destino = $itinerario['id_destino'];
    $sql_imagenes = "SELECT url_imagen FROM imagenes_destinos WHERE id_destino = :id_destino";
    $stmt_imagenes = $pdo->prepare($sql_imagenes);
    $stmt_imagenes->bindParam(':id_destino', $id_destino, PDO::PARAM_INT);
    $stmt_imagenes->execute();
    $imagenes = $stmt_imagenes->fetchAll(PDO::FETCH_ASSOC);

    // Si no se encontraron imágenes para el destino, obtener una imagen aleatoria
    if (empty($imagenes)) {
        $stmt = $pdo->prepare("SELECT url_imagen FROM imagenes_destinos ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $imagen = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si se encuentra una imagen aleatoria, se agrega a la lista de imágenes
        if ($imagen) {
            $imagenes[] = $imagen; // Agregar la imagen aleatoria a la lista
        } else {
            // Si no se encontró imagen, usa una imagen por defecto
            $url_imagen = 'images/bg_1.jpg';
        }
    } else {
        // Si hay imágenes del destino, se toma la primera para usarla como fondo
        $url_imagen = $imagenes[0]['url_imagen'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $url_imagen = 'images/bg_1.jpg'; // Imagen por defecto en caso de error
}

// Si no se encontraron imágenes
if (empty($imagenes)) {
    echo "No se encontraron imágenes para el destino.";
    exit;
}

//Formulario de registro de reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $personas = (int)$_POST['personas'];

    if (empty($nombre) || empty($correo) || empty($telefono) || $personas <= 0) {
        $error = "Por favor completa todos los campos.";
    } else {
        $sql_insert = "INSERT INTO reservas (id_paquete, nombre_cliente, correo_cliente, telefono_cliente, personas) 
                       VALUES (:id_paquete, :nombre, :correo, :telefono, :personas)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindParam(':id_paquete', $id_paquete, PDO::PARAM_INT);
        $stmt_insert->bindParam(':nombre', $nombre);
        $stmt_insert->bindParam(':correo', $correo);
        $stmt_insert->bindParam(':telefono', $telefono);
        $stmt_insert->bindParam(':personas', $personas);

        if ($stmt_insert->execute()) {
            $success = "Reserva completada con éxito.";
        } else {
            $error = "Hubo un error al procesar la reserva. Inténtalo de nuevo.";
        }
    }
}
?>

<title>Reservar <?php echo htmlspecialchars($paquete['nombre_paquete']); ?> - JM Expeditions</title>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?php echo $URL; ?>/public/images/destinos/<?php echo $url_imagen; ?>');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row  js-fullheight align-items-end justify-content-end">
            <div class="container mt-5 mb-5 pt-5 ftco-animate pb-5">
                <div class="row">
                    <!-- Formulario de Reserva -->
                    <div class="col-md-8 mt-4">
                        <div class="form-section bg-light p-5 rounded shadow-lg position-relative">
                            <h2 class="text-center mb-4 font-weight-bold text-primary mt-4">Reserva tu Aventura: <span class="text-warning"><?php echo htmlspecialchars($paquete['nombre_paquete']); ?></span></h2>

                            <!-- Etiqueta de días en la esquina superior derecha -->
                            <span class="badge badge-danger position-absolute p-2" style="top: 20px; right: 20px;">
                                Número de días: <strong><?php echo htmlspecialchars($paquete['duracion_paquete']); ?></strong>
                            </span>

                            <!-- Barra de progreso -->
                            <div class="progress mb-4">
                                <div id="progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>

                            <!-- Mensajes de error o éxito -->
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
                            <?php elseif (!empty($success)): ?>
                                <div class="alert alert-success text-center"><?php echo htmlspecialchars($success); ?></div>
                            <?php endif; ?>

                            <!-- Formulario de reserva -->
                            <form method="post" action="reservar.php?id=<?php echo $id_paquete; ?>" class="animated-form" oninput="updateProgress()">
                                <!-- Nombre Completo -->
                                <div class="form-group mb-4">
                                    <label for="nombre" class="font-weight-bold">Nombre Completo:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-lg input-friendly" placeholder="Tu nombre completo" required>
                                </div>

                                <!-- Correo Electrónico -->
                                <div class="form-group mb-4">
                                    <label for="correo" class="font-weight-bold">Correo Electrónico:</label>
                                    <input type="email" id="correo" name="correo" class="form-control form-control-lg input-friendly" placeholder="ejemplo@correo.com" required>
                                </div>

                                <!-- Teléfono con Prefijos Internacionales -->
                                <div class="form-group">
                                    <label for="telefono" class="font-weight-bold">Teléfono:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select id="prefijo" class="custom-select" onchange="updatePrefix()">
                                                <option value="+51" data-icon="flag-icons/pe.png">🇵🇪 +51</option>
                                                <option value="+52" data-icon="flag-icons/mx.png">🇲🇽 +52</option>
                                                <option value="+54" data-icon="flag-icons/ar.png">🇦🇷 +54</option>
                                                <option value="+1" data-icon="flag-icons/us.png">🇺🇸 +1</option>
                                                <option value="+34" data-icon="flag-icons/es.png">🇪🇸 +34</option>
                                                <option value="+57" data-icon="flag-icons/co.png">🇨🇴 +57</option>
                                                <option value="+593" data-icon="flag-icons/ec.png">🇪🇨 +593</option>
                                                <option value="+56" data-icon="flag-icons/cl.png">🇨🇱 +56</option>
                                                <option value="+81" data-icon="flag-icons/jp.png">🇯🇵 +81</option>
                                                <!-- Agrega más países según sea necesario -->
                                            </select>
                                        </div>
                                        <input type="text" id="telefono" name="telefono" class="form-control form-control-lg" placeholder="Tu número de teléfono" required>
                                    </div>
                                </div>

                                <!-- Número de Personas -->
                                <div class="form-group mb-4">
                                    <label for="personas" class="font-weight-bold">¿Para cuántas personas?</label>
                                    <input type="number" id="personas" name="personas" class="form-control form-control-lg input-friendly" min="1" value="1" required oninput="updateSummary()">
                                </div>

                                <!-- Botón de Confirmación -->
                                <button type="submit" class="btn btn-success btn-lg btn-block mt-4 btn-friendly">Confirmar Reserva</button>
                            </form>
                        </div>
                    </div>


                    <!-- Aside: Resumen de reserva en tiempo real -->
                    <div class="col-md-4 mt-4">
                        <div class="reservation-summary bg-light p-4 rounded shadow-lg">
                            <h4 class="text-warning text-center mb-4">Resumen de tu Reserva</h4>

                            <hr class="my-md-2">


                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-0"><strong>Paquete:</strong></p>
                                <p class="text-right mb-0"><?php echo htmlspecialchars($paquete['nombre_paquete']); ?></p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-0"><strong>Numero de días:</strong></p>
                                <p class="text-right mb-0"><?php echo htmlspecialchars($paquete['duracion_paquete']); ?></p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-0"><strong>Personas:</strong></p>
                                <p class="text-right mb-0"><span id="summary-personas">1</span></p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-0"><strong>Precio por persona:</strong></p>
                                <p class="text-right mb-0"><?php echo number_format($paquete['precio_paquete'], 2); ?> PEN</p>
                            </div>

                            <hr class="my-3">

                            <div class="d-flex justify-content-between align-items-center text-dark">
                                <p class="mb-0"><strong>Total:</strong></p>
                                <p class="text-right mb-0 font-weight-bold "><span id="summary-total"><?php echo number_format($paquete['precio_paquete'], 2); ?></span> PEN</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-9 ftco-animate pb-5 text-center">

                <!-- <p class="breadcrumbs">
                    <span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span>
                    <span>Tour List <i class="fa fa-chevron-right"></i></span>
                </p>
                <h1 class="mb-0 bread">Tours List</h1> -->
            </div> -->
        </div>
    </div>

</section>

<script>
    $('#image-slider').carousel({
        interval: 1500 // Cambiar cada 1.5 segundos
    });
</script>






<script>
    $(document).ready(function() {
        $('#prefijo').select2({
            templateResult: formatState,
            templateSelection: formatState,
            width: '100%' // Asegura que el select tenga el ancho completo
        });
    });

    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        const icon = $(state.element).data('icon');
        const $state = $(
            `<span><img src="${icon}" style="width: 20px; height: 20px;" /> ${state.text}</span>`
        );
        return $state;
    }

    function updatePrefix() {
        const select = document.getElementById('prefijo');
        const selectedOption = select.options[select.selectedIndex];
        const prefix = selectedOption.value; // Prefijo seleccionado
        const icon = selectedOption.dataset.icon; // Icono de la bandera

        // Muestra el prefijo seleccionado
        document.getElementById('selected-prefix').innerHTML = `<img src="${icon}" alt="Bandera" style="width: 20px; height: 20px;"> ${prefix}`;
    }

    // Inicializa el contenido al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        updatePrefix();
        $('#prefijo').select2(); // Inicializa Select2 al cargar
    });

    function updateSummary() {
        const personas = document.getElementById('personas').value;
        const precioPorPersona = <?php echo $paquete['precio_paquete']; ?>;
        const total = personas * precioPorPersona;
        document.getElementById('summary-personas').textContent = personas;
        document.getElementById('summary-total').textContent = total.toFixed(2);

        const totalElement = document.getElementById('summary-total');
        totalElement.classList.add('flash');
        setTimeout(() => totalElement.classList.remove('flash'), 500);
    }

    function updateProgress() {
        const nombre = document.getElementById('nombre').value;
        const correo = document.getElementById('correo').value;
        const telefono = document.getElementById('telefono').value;
        const personas = document.getElementById('personas').value;

        let completedFields = 0;
        if (nombre) completedFields++;
        if (correo) completedFields++;
        if (telefono) completedFields++;
        if (personas > 0) completedFields++;

        const progress = (completedFields / 4) * 100;
        document.getElementById('progress-bar').style.width = progress + '%';
        document.getElementById('progress-bar').setAttribute('aria-valuenow', progress);
        document.getElementById('progress-bar').textContent = Math.round(progress) + '%';
    }
</script>

<style>
    /* Estilos más amigables y suaves */
    .input-friendly {
        border-radius: 20px;
        border: none;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        font-size: 1.1rem;
    }

    .input-friendly:focus {
        outline: none;
        box-shadow: 0px 0px 8px rgba(66, 133, 244, 0.5);
        border: 1px solid rgba(66, 133, 244, 0.3);
    }

    .btn-friendly {
        background-color: #28a745;
        border: none;
        border-radius: 25px;
        padding: 12px;
        font-size: 1.2rem;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-friendly:hover {
        background-color: #218838;
    }

    /* Barra de progreso */
    .progress-bar {
        /* height: 10px; */
        border-radius: 5px;
        transition: width 0.4s ease;
    }

    /* Efecto visual al actualizar el total */
    .flash {
        animation: flash-animation 0.5s ease-in-out;
    }

    @keyframes flash-animation {
        0% {
            background-color: yellow;
        }

        100% {
            background-color: transparent;
        }
    }

    /* Estilos generales */
    .form-group label {
        font-weight: bold;
        color: #555;
    }

    .input-group {
        display: flex;
        /* align-items: stretch; */
    }

    .custom-select {
        border-radius: 20px 0 0 20px;
        border: none;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 4px;
        font-size: 1.1rem;
        margin-right: -1px;
        /* Para unirlo con el input */
        height: auto;
        width: 100px;

    }


    /* Inicio de selector */
    .input-group-prepend {
        min-width: 100px;
        /* Ajusta el tamaño del selector */
    }

    .custom-select {
        padding-left: .5rem;
        /* Espacio para la bandera */
    }

    .input-group-prepend {
        background-color: #f8f9fa;
        /* Fondo claro para el selector */
    }

    .input-group .custom-select option[data-icon]::before {
        content: '';
        display: inline-block;
        width: 1.5rem;
        height: 1rem;
        background-image: url('https://cdn.jsdelivr.net/npm/flag-icons@3.2.0/flags/');
        background-size: contain;
        background-repeat: no-repeat;
        margin-right: 0.5rem;
        vertical-align: middle;
    }


    /* FIN de selector */

    .form-control-lg {
        border-radius: 0 20px 20px 0;
        border: none;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        font-size: 1.1rem;
    }

    /* Inicio-Carrousel */
    .hero-wrap {
        position: relative;
        overflow: hidden;
        /* Evitar que el contenido se desborde */
        height: 100vh;
        /* Altura de la sección */
        background-size: cover;
        /* Ajustar la imagen de fondo */
        background-position: center;
        /* Centrar la imagen */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Para un overlay oscuro */
    }


    /* Fin-Carrousel */
</style>


<?php
require_once dirname(__DIR__) . '/templates/layouts/footer.php';
?>