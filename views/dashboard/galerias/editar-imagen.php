    <?php
    include '../../app/controller/config.php';
    include '../layouts/header.php';

    // Verificar si el parámetro `id_imagen` está presente en la URL
    if (isset($_GET['id_imagen'])) {
        $id_imagen = $_GET['id_imagen'];

        // Consulta SQL para obtener la información de la imagen
        $sql = "SELECT * FROM imagenes_destinos WHERE id_imagen = :id_imagen";
        $stmt = $pdo->prepare($sql);

        try {
            // Ejecutar la consulta con el parámetro adecuado
            $stmt->execute([':id_imagen' => $id_imagen]);

            // Verificar si se obtuvo algún resultado
            $imagen = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$imagen) {
                echo "Imagen no encontrada.";
                exit;
            }

            // Consulta para obtener el nombre del destino asociado con la imagen
            $sql_destino = "SELECT id_destino, nombre_destino FROM destinos WHERE id_destino = :id_destino";
            $stmt_destino = $pdo->prepare($sql_destino);
            $stmt_destino->execute([':id_destino' => $imagen['id_destino']]);
            $destino = $stmt_destino->fetch(PDO::FETCH_ASSOC);

            if (!$destino) {
                echo "Destino no encontrado.";
                exit;
            }

            // Guardar el nombre del destino para usarlo en el botón "Salir"
            $nombre_destino = $destino['nombre_destino'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    } else {
        echo "ID de imagen no proporcionado.";
        exit;
    }
    ?>

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Listas</h3>
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
                        <a href="#">Galeria</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Lista destino</a>
                    </li>
                </ul>
            </div>
            <div class="page-header">
                <h3 class="fw-bold mb-3">Editar Imagen</h3>
            </div>

            <div class="col m-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Formulario de Imagen</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="../../app/controller/imagenes/update.php" method="POST" enctype="multipart/form-data">
                                    <!-- Campo oculto para enviar el ID de la imagen -->
                                    <input type="hidden" name="id_imagen" value="<?php echo $imagen['id_imagen']; ?>">

                                    <div class="form-group">
                                        <label for="id_destino">Destino:</label>
                                        <select id="id_destino" class="form-control" name="id_destino" required>
                                            <option value="<?php echo $destino['id_destino']; ?>"><?php echo $destino['nombre_destino']; ?></option>
                                            <?php
                                            // Consulta para obtener todos los destinos
                                            $sql = "SELECT id_destino, nombre_destino FROM destinos";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $destinos = $stmt->fetchAll();

                                            foreach ($destinos as $d) {
                                                // Mostrar todos los destinos excepto el que ya está seleccionado
                                                if ($d['id_destino'] != $destino['id_destino']) {
                                                    echo "<option value='" . $d['id_destino'] . "'>" . $d['nombre_destino'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="image-upload">
                                                <label for="foto3" class="upload-box">
                                                    <i class="fas fa-upload h-10"></i>
                                                    <span class="text-primary"> Subir nueva imagen</span>
                                                    <input type="file" id="foto3" name="url_imagen" accept="image/*" class="upload-input-img">
                                                </label>
                                            </div>
                                            <br>
                                            <!-- Mostrar la imagen actual -->
                                            <img src="../../public/uploads/photos/<?php echo htmlspecialchars($imagen['url_imagen']); ?>" class="img-fluid rounded" alt="Imagen actual">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="descripcion_imagen">Descripción de la imagen:</label>
                                            <textarea class="form-control" id="descripcion_imagen" name="descripcion_imagen" rows="10"><?php echo htmlspecialchars($imagen['descripcion_imagen']); ?></textarea>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn_actualizar" data-entity="Imagen">Actualizar </button>

                                        <a href="detalle-destino.php?nombre_destino=<?php echo urlencode($nombre_destino); ?>" class="btn btn-primary btn-border" onclick="cancelarActualizar('Imagen')" data-entity="Imagen"><i class="fas fa-door-open"></i> Salir</a>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../layouts/modal.php';
    include '../layouts/footer.php';
    ?>

