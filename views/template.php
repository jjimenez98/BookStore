<?php
session_start();
// session_destroy();
$template = new TemplateController();
$url = $template->obtenerUrlController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Proyecto de prueba</title>


    <!-- Estilos internos -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/css/flaticon.css">
    <link rel="stylesheet" type="text/css" href="https://e-sol.mx/plantilla/views/resources/css/style.css">
    <!-- Estilos internos -->

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>views/assets/plugins/DataTables/datatables.min.css" />
    <!-- DataTables -->

    <!-- Select2 stylesheet -->
    <link href="<?php echo $url; ?>views/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Select2 stylesheet -->

    <!-- Editable select -->
    <link href="<?php echo $url; ?>views/assets/plugins/editable-select/jquery-editable-select.min.css" rel="stylesheet">
    <!-- Editable select -->

    <!-- FullCalendar -->
    <link href='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <!-- FullCalendar -->

    <!-- Moment -->
    <script src='<?php echo $url; ?>views/assets/plugins/moment/min/moment.min.js'></script>
    <!-- Moment -->

    <!-- Chart js -->
    <script src="<?php echo $url; ?>views/assets/plugins/chartjs/chart.js"></script>
    <!-- Chart js -->

    <!-- Jquery -->
    <script src="<?php echo $url; ?>views/assets/js/jquery-3.3.1.min.js"></script>
    <!-- Jquery -->

    <!-- SweetAlert -->
    <script src="<?php echo $url; ?>views/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
    <!-- SweetAlert -->

    <!-- Bootstrap JS  -->
    <script src="https://e-sol.mx/plantilla/views/resources/js/bootstrap.min.js"></script>
    <script src="https://e-sol.mx/plantilla/views/resources/js/popper.min.js"></script>
    <script src="https://e-sol.mx/plantilla/views/resources/js/main.js"></script>
    <!-- Bootstrap JS  -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://e-sol.mx/plantilla/views/resources/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <input type="hidden" class="url" value="<?php echo $url; ?>">

</head>

<body>


    <div id="sistema">

        <input type="hidden" class="url" value="<?php echo $url; ?>">

        <?php

        if (isset($_GET['action'])) {

            $action = explode("/", $_GET['action']);
        }
        if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {
            include "modules/sections/navbar.php";
        }

        //modulos
        echo '<div class="contenido"><div class="modulos">';
        if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == 'ok') {


            if (isset($action[0])) {

                if ($_SESSION['nivel'] == 'admin') {
                    //Administrador

                    if (
                        $action[0] == "dashboard" ||
                        $action[0] == "salir" ||
                        $action[0] == "usuarios" ||
                        $action[0] == "categorias" ||
                        $action[0] == "libros" ||
                        $action[0] == "clientes" ||
                        $action[0] == "metricos" ||
                        $action[0] == "ventas"
                    ) {

                        include "modules/" . $action[0] . ".php";
                    } else {

                        include "modules/404.php";
                    }
                } else if ($_SESSION['nivel'] == 'supervisor') {
                    if (
                        $action[0] == "dashboard" ||
                        $action[0] == "salir" ||
                        $action[0] == "categorias" ||
                        $action[0] == "libros" ||
                        $action[0] == "clientes" ||
                        $action[0] == "metricos" ||
                        $action[0] == "ventas"
                    ) {

                        include "modules/" . $action[0] . ".php";
                    } else {

                        include "modules/404.php";
                    }
                } else if ($_SESSION['nivel'] == "cliente") {
                    if (
                        $action[0] == "biblioteca" ||
                        $action[0] == "carrito" ||
                        $action[0] == "salir"

                    ) {

                        include "modules/" . $action[0] . ".php";
                    } else {

                        include "modules/404.php";
                    }
                } else {

                    include "modules/" . $action[0] . ".php";
                }
            } else {
                if ($_SESSION['nivel'] == 'admin' || $_SESSION['nivel'] == "supervisor") {
                    include "modules/dashboard.php";
                }
                if ($_SESSION['nivel'] == "cliente") {
                    include "modules/biblioteca.php";
                } else {
                    include "modules/404.php";
                }
            }
        } else {
            include "modules/login.php";
        }
        echo '</div></div>';
        //modulos

        ?>

    </div>

    <!-- Modal Carrito-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-carrito">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <img src="https://via.placeholder.com/280x150" width="120" height="80">
                            </div>

                        </div>

                        <div class="col">
                            <div class="form-group">
                                <div class="row">
                                    <label>Informacion:</label>
                                </div>
                                <div class="row">
                                    <span>Libro : </span>
                                </div>


                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <div class="row">
                                    <label>Cantidad:</label>
                                    <input width="48" type="number" class="form-control"></input>
                                </div>

                            </div>
                        </div>

                        <div class="col">
                            <button class="btn btn-eliminar v3 mt-4 ml-2">Eliminar</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar -->
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/fullcalendar.js'></script>
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/locale/es.js'></script>
    <script src='<?php echo $url; ?>views/assets/plugins/fullcalendar/dist/locale-all.js'></script>
    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo $url; ?>views/assets/plugins/DataTables/datatables.min.js"></script>
    <!--Select2 JQuery-->
    <script src="<?php echo $url; ?>views/assets/plugins/select2/dist/js/select2.full.min.js"></script>
    <!--Editable select-->
    <script src="<?php echo $url; ?>views/assets/plugins/editable-select/jquery-editable-select.min.js"></script>
    <script src="<?php echo $url; ?>views/assets/plugins/jqueryLoading/loading.js"></script>
    <!-- Custom scripts -->
    <script src="<?php echo $url; ?>views/assets/js/scripts/general.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/login.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/usuario.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/categoria.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/libro.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/cliente.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/ventas.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/metricos.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/dashboard.js"></script>
    <script src="<?php echo $url; ?>views/assets/js/scripts/biblioteca.js"></script>


</body>

</html>