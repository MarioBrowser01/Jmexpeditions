<?php
include '../../app/controller/config.php';
include '../../app/controller/paquetes/listar-paquetes.php'; // Asegúrate de que el nombre del archivo sea correcto
include '../layouts/header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Paquetes</h3>
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
                    <a href="#">Paquetes</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Listas Paquetes</a>
                </li>
            </ul>
        </div>

        <!-- Listado de Paquetes -->
        <div class="col m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Listado de Paquetes</div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr role="row">
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Nombre</th>
                                        <th class="border-top-0">Duración</th>
                                        <th class="border-top-0">Precio</th>
                                        <th class="border-top-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($paquetes_datos as $paquete) {
                                        $id_paquete = htmlspecialchars($paquete['id_paquete']);
                                        $nombre_paquete = htmlspecialchars($paquete['nombre_paquete']);
                                        $duracion_paquete = htmlspecialchars($paquete['duracion_paquete']);
                                        $noche_paquete = htmlspecialchars($paquete['noches_paquete']); // Obtener noches
                                        $precio_paquete = htmlspecialchars($paquete['precio_paquete']);
                                        $disponibilidad_paquete = $paquete['disponibilidad_paquete'] ? 'Disponible' : 'No Disponible';
                                        $badge_color = $paquete['disponibilidad_paquete'] ? 'badge-success' : 'badge-danger'; // Define el color
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo ++$contador; ?></center>
                                            </td>
                                            <td>
                                                <?php echo $nombre_paquete; ?><br>
                                                <span class="badge <?php echo $badge_color; ?>"><?php echo $disponibilidad_paquete; ?></span>
                                            </td>
                                            <td>
                                                
                                                <?php if ($noche_paquete > 0) { ?>
                                                    <?php echo $duracion_paquete; ?> días / <?php echo $noche_paquete; ?> noches
                                                <?php }else{
                                                    echo $duracion_paquete; ?> día
                                                <?php
                                                } ?>
                                            </td>
                                            <td><?php echo $precio_paquete; ?> PEN</td>
                                            <td>
                                                <center>
                                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                        <a href="ver-paquetes.php?id=<?php echo $id_paquete; ?>" type="button" class="btn col text-center btn-info"><i class="fa fa-eye"></i></a>

                                                        <a href="editar-paquete.php?id=<?php echo $id_paquete; ?>" type="button" class="btn col text-center btn-success"><i class="fa fa-pencil-alt"></i></a>

                                                        <a href="<?php echo $URL; ?>app/controller/paquetes/delete.php?id=<?php echo $id_paquete; ?>" type="button" class="btn col text-center btn-danger btn_eliminar" data-entity="paquete"><i class="fa fa-trash"></i></a>

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