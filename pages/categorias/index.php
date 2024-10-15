<?php
include '../../app/controller/config.php';
include '../layouts/header.php';
include '../../app/controller/categorias/listar-categoria.php';
include '../../app/controller/categorias/create.php';
include '../../app/controller/categorias/update.php';
include '../../app/controller/categorias/delete.php';

// Inicializar variables
$nombre_categoria = '';
$id_categoria = '';
$descripcion_categoria = '';

// Verifica si se ha proporcionado un ID en la cadena de consulta
if (isset($_GET['id_categoria'])) { 
    $id_categoria = $_GET['id_categoria'];

    // Obtén los datos actuales de la categoría
    $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id_categoria = :id_categoria");
    $stmt->bindParam(':id_categoria', $id_categoria);
    $stmt->execute();
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categoria) {
        $nombre_categoria = $categoria['nombre_categoria'];
        $descripcion_categoria = $categoria['descripcion_categoria'];
    } else {
        echo "Categoría no encontrada.";
    }
}
?>
<!-- Incluir jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Incluir SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Gestión de categorias</h3>
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
                    <a href="#">Categorías</a>
                </li>
            </ul>
        </div>

        <!--CONTENIDO INICIO-->
        <!-- Formulario de Registro -->
        <div class="col m-0" id="form_registrar">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Registro de Categoría</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="../../app/controller/categorias/create.php" method="post" enctype="multipart/form-data">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="nombre_categoria">Nombre de la categoría:</label>
                                        <input type="text" class="form-control" name="nombre_categoria" id="nombre_categoria" onkeyup="generarCodigoCategoria()" value="<?php echo htmlspecialchars($nombre_categoria); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cod_categoria">Código de la categoría:</label>
                                        <input type="text" class="form-control" id="cod_categoria" name="cod_categoria" readonly><br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="descripcion_categoria">Descripción de la categoría:</label>
                                        <textarea id="descripcion_categoria" name="descripcion_categoria" class="form-control" required><?php echo htmlspecialchars($descripcion_categoria); ?></textarea>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" id="btn_guardar_categoria" class="btn btn-success" data-entity="Categoria">Registrar</button>

                                    <button type="reset" class="btn btn-danger btn-nuevo">Nuevo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Actualización -->
        <div class="col m-0" id="form_actualizar" style="display:none;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Actualizar Categoría</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="<?php echo $URL; ?>app/controller/categorias/update.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="id_categoria_act" name="id_categoria_act">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="nombre_categoria_act">Nombre de la categoría:</label>
                                        <input type="text" class="form-control" id="nombre_categoria_act" name="nombre_categoria_act" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cod_categoria_act">Código de la categoría:</label>
                                        <input type="text" class="form-control" id="cod_categoria_act" name="cod_categoria_act" readonly><br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="descripcion_categoria_act">Descripción de la categoría:</label>
                                        <textarea id="descripcion_categoria_act" class="form-control" name="descripcion_categoria_act" required></textarea>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button type="submit" id="btn_actualizar_categoria" class="btn btn-info">Actualizar</button>

                                    <button type="button" class="btn btn-secondary" onclick="cancelarActualizacion('Categoria')" data-entity="Categoria">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Categorías -->
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de categorías</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="basic-datatables"
                                class="display table table-striped table-hover dataTable">
                                <thead>
                                    <tr role="row">
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Código</th>
                                        <th class="border-top-0">Categoría</th>
                                        <th class="border-top-0">Descripción</th>
                                        <th class="border-top-0">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($categorias_datos as $categoria_dato) {
                                        $id_categoria = htmlspecialchars($categoria_dato['id_categoria']);
                                        $nombre_categoria = htmlspecialchars($categoria_dato['nombre_categoria']);
                                        $codigo_categoria = htmlspecialchars($categoria_dato['cod_categoria']);
                                        $descripcion_categoria = htmlspecialchars($categoria_dato['descripcion_categoria']);
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo ++$contador; ?></center>
                                            </td>
                                            <td><?php echo $codigo_categoria; ?></td>
                                            <td><?php echo $nombre_categoria; ?></td>
                                            <td><?php echo $descripcion_categoria; ?></td>
                                            <td>
                                                <center>
                                                    <div class='col-sm-3 col-sm-12 d-flex flex-wrap gap-1'>
                                                        <a href='show.php?id=<?php echo $id_categoria; ?>' type='button' class='btn col btn-info'><i class='fa fa-eye'></i></a>

                                                        <button type='button' class='btn col btn-success' onclick='mostrarFormularioActualizar("<?php echo $id_categoria; ?>", "<?php echo addslashes($codigo_categoria); ?>", "<?php echo addslashes($nombre_categoria); ?>", "<?php echo addslashes($descripcion_categoria); ?>")'><i class='fa fa-pencil-alt'></i></button>

                                                        <a href='../../app/controller/categorias/delete.php?id=<?php echo $id_categoria; ?>' class='btn col btn-danger btn_eliminar' data-entity="Categoria"><i class='fa fa-trash'></i></a>


                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php 
    include '../layouts/modal.php'; 
    include '../layouts/forms.php'; 
    include '../layouts/database.php';
    include '../layouts/footer.php'; 
    ?>