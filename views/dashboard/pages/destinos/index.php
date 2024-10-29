<?php
include '../../app/controller/config.php';
include '../../app/controller/destinos/listar-destino.php'; // Asegúrate de que el nombre del archivo sea correcto
include '../layouts/header.php';
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
                    <a href="#">Destinos</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Lista destino</a>
                </li>
            </ul>
        </div>

        <!-- Mostrar notificación si se pasa el parámetro message -->
        <?php if (isset($_GET['message'])) : ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Mostrar la notificación
                    $.notify({
                        icon: "icon-bell",
                        title: "Éxito",
                        message: decodeURIComponent("<?php echo $_GET['message']; ?>")
                    }, {
                        type: "success",
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        time: 5000
                    });

                    // Eliminar el parámetro de la URL después de mostrar la notificación
                    var url = new URL(window.location.href);
                    url.searchParams.delete('message');
                    window.history.replaceState({}, document.title, url.toString());
                });
            </script>
        <?php endif; ?>

        <!-- Listado de Destinos -->
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de destinos</div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="basic-datatables" 
                            class="display table table-striped table-hover" 
                            cellspacing="0" width="100%">
                                <thead>
                                <tr role="row">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Código</th>
                                    <th class="border-top-0">Destino</th>
                                    <th class="border-top-0">Ubicación</th>
                                    
                                    <th class="border-top-0">Categoría</th>
                                    <th class="border-top-0">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($destinos_datos as $destinos_dato) {
                                        $id_destino = htmlspecialchars($destinos_dato['id_destino']);
                                        $codigo_destino = htmlspecialchars($destinos_dato['codigo_destino']);
                                        $nombre_destino = htmlspecialchars($destinos_dato['nombre_destino']);
                                        $ubicacion_destino = htmlspecialchars($destinos_dato['ubicacion_destino']);
                                        $nombre_departamento = htmlspecialchars($destinos_dato['nombre_departamento']);
                                        $nombre_provincia = htmlspecialchars($destinos_dato['nombre_provincia']);
                                      
                                        $nombre_categoria = htmlspecialchars($destinos_dato['nombre_categoria']);
                                        $parque_reserva_destino = htmlspecialchars($destinos_dato['parque_reserva_destino']);
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo ++$contador; ?></center>
                                            </td>
                                            <td><?php echo $codigo_destino; ?></td>
                                            <td><?php echo $nombre_destino; ?></td>
                                            <td>
                                                <?php echo $ubicacion_destino; ?>
                                                <br>
                                                <span><?php echo $parque_reserva_destino; ?></span><br>
                                                <span class="text-muted"><?php echo $nombre_departamento; ?></span>,
                                                <code><?php echo $nombre_provincia; ?></code>
                                            </td>
                                            
                                            <td><?php echo $nombre_categoria; ?></td>
                                            <td>
                                                <center>
                                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                        <a href="ver-destinos.php?id=<?php echo $id_destino; ?>" type="button" class="btn col text-center btn-info"><i class="fa fa-eye"></i></a>

                                                        <a href="editar-destinos.php?id=<?php echo $id_destino; ?>" type="button" class="btn col text-center btn-success"><i class="fa fa-pencil-alt"></i></a>

                                                        <a href="<?php echo $URL; ?>app/controller/destinos/delete.php?id=<?php echo $id_destino; ?>" type="button" class="btn col text-center btn-danger" onclick="return data-entity="destino" ><i class="fa fa-trash"></i></a>
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
</div>

<?php 
include '../layouts/modal.php'; 
include '../layouts/database.php'; 
include '../layouts/footer.php'; 
?>