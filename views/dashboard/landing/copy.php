<?php
include '../../app/controller/config.php';

// Consulta para obtener los destinos
$query = "
    SELECT d.*, c.nombre_categoria, p.nombre_provincia, dep.nombre_departamento
    FROM destinos d
    LEFT JOIN categorias c ON d.id_categoria = c.id_categoria
    LEFT JOIN provincias p ON d.id_provincia = p.id_provincia
    LEFT JOIN departamentos dep ON p.id_departamento = dep.id_departamento
    ORDER BY RAND()  -- Ordena aleatoriamente

";
/*
LIMIT 1            -- Limita el resultado a 1
*/
$stmt = $pdo->query($query); // Ejecuta la consulta
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JM Expeditions</title>
    <link rel="stylesheet" href="<?php echo $URL; ?>public/css/landing/index.min.css" />
</head>

<body>
    <header>
        <a href="#">
            <img src="<?php echo $URL; ?>public/images/source/Horizontal_jm.png" alt="logo" class="logo">
        </a>
        <nav>
            <a href="">Nosotros</a>
            <a href="">Servicios</a>
            <a href="">Destinos</a>
            <a href="" class="bg-orange">Reservas</a>
        </nav>
    </header>

    <div class="carousel">
        <div class="list">
            <?php
            // Iterar a través de los destinos y crear cada ítem del carrusel
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Arreglo con las tres imágenes del destino
                $imagenes = [
                    $row['imagen1_destino'],
                    $row['imagen2_destino'],
                    $row['imagen3_destino']
                ];

                // Selecciona una imagen aleatoria
                $imagen_aleatoria = $imagenes[array_rand($imagenes)];
            ?>
                <div class="item" style="background-image: url('<?php echo $URL; ?>public/uploads/<?php echo htmlspecialchars($imagen_aleatoria); ?>');">

                    <div class="content">
                        <div class="title"><?php echo htmlspecialchars($row['nombre_destino']); ?></div>

                        <div class="ubicacion">
                            <?php echo htmlspecialchars($row['nombre_provincia']); ?>, 
                            <?php echo htmlspecialchars($row['nombre_departamento']); ?>
                        </div>

                        <!-- <div class="des"><?php echo htmlspecialchars($row['descripcion_destino']); ?></div> -->
                        <div class="btn">
                            <button>Reservar</button>
                            <button>Ver</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!--next prev button-->
        <div class="arrows">
            <button class="prev">
                <</button>
                    <button class="next">></button>
        </div>

        <!-- time running -->
        <div class="timeRunning"></div>
    </div>

    <script src="<?php echo $URL; ?>public/js/landing/landing.min.js"></script>
</body>

</html>