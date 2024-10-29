<?php
include '../../app/controller/config.php';
include '../layouts/header.php';
include '../../app/controller/itinerarios/listar-itinerarios.php'; 

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
    <div class="page-inner"> 
        <div class="page-header">
            <h3 class="fw-bold mb-3">Itinerarios</h3>

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
                    <a href="index.php">Itinerarios</a>

                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Lista de itinerarios</a>
                </li>
            </ul>
        </div>

        <!-- Mostrar notificación si se pasa el parámetro message -->
        <?php if (isset($_GET['message'])) : ?>
            <!-- <script>
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
            </script> -->
        <?php endif; ?>

        <!-- Listado de Itinerarios -->
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de Itinerarios</div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="basic-datatables" 
                            class="display table table-striped table-hover" 
                            cellspacing="0" width="100%">
                                <thead>
                                <tr role="row">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Paquete</th>
                                    <th class="border-top-0">Destino</th>
                                    <th class="border-top-0">Orden</th>

                                    <th class="border-top-0">Hora de salida</th>
                                    <th class="border-top-0">Tipo de Destino</th>
                                    

                                    <th class="border-top-0">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($itinerarios_datos as $itinerario) {
                                        $id_itinerario = htmlspecialchars($itinerario['id_itinerario']);
                                        $nombre_paquete = htmlspecialchars($itinerario['nombre_paquete']);
                                        $nombre_destino = htmlspecialchars($itinerario['nombre_destino']);
                                        $orden_itinerario = htmlspecialchars($itinerario['orden_itinerario']);
                                        $hora_salida = htmlspecialchars($itinerario['hora_salida']);
                                        $tipo_destino = htmlspecialchars($itinerario['tipo_destino']);
                                        

                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo ++$contador; ?></center>
                                            </td>
                                            <td><?php echo $nombre_paquete; ?></td>
                                            <td><?php echo $nombre_destino; ?></td>
                                            <td><?php echo $orden_itinerario; ?></td>

                                            <td><?php echo $hora_salida; ?></td>
                                            <td><?php echo $tipo_destino; ?></td>
                                            
                                            <td>
                                                <center>
                                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                        <a href="ver-itinerario.php?id=<?php echo $id_itinerario; ?>" type="button" class="btn col text-center btn-info"><i class="fa fa-eye"></i></a>

                                                        <a href="editar-itinerario.php?id=<?php echo $id_itinerario; ?>" type="button" class="btn col text-center btn-success"><i class="fa fa-pencil-alt"></i></a>

                                                        <a href="<?php echo $URL; ?>app/controller/itinerarios/delete.php?id=<?php echo $id_itinerario; ?>" type="button" class="btn col text-center btn-danger btn_eliminar" data-entity="Itinerario"><i class="fa fa-trash"></i></a>
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
