<?php
$action = explode("/", $_GET['action']);
$url = TemplateController::obtenerUrlController();

?>

<div class="modulo-clientes">

    <?php if (!isset($action[1])) : ?>



        <!-- Caja -->
        <div class="caja mb-4">
            <div class="titulo-boton">
                <h6 class="titulo-modulo">Clientes</h6>
                <a href="#" class="btn btn-agregar">Agregar contenido</a>
            </div>
        </div>

        <input type="hidden" id="cargarTablaClientes" value="si">

        <table id="tablaClientes" class="table v2" style="width:100%">
            <thead>
                <tr class="bg-primary text-white">
                    <th>id</th>
                    <th>Estado</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Fecha Alta</th>
                    <th>Codigo</th>
                </tr>
            </thead>
            <tbody>

            </tbody>


        </table>


    <?php else : ?>

        <?php

        $cliente = ClienteController::traerClienteCodigoController($action[1]);
        $numero_libros = ClienteController::traerClienteTotalLibrosController($cliente["id"]);
        $total = ClienteController::traerClienteTotalDineroController($cliente["id"]);
        ?>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../clientes">Cliente</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $cliente["nombre_completo"] ?></li>
            </ol>
        </nav>

        <input type="hidden" id="cargarTablaClientesSingular" value="si">
        <input type="hidden" id="idCliente" value="<?php echo $cliente["id"] ?>">

        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <image src="<?php echo $url . $cliente['imagen']; ?>" width="100%" height="100%">
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col">
                            <div class="container">
                                <div class="d-flex justify-content-center row">
                                    <span class="badge badge-primary con-borde m-2 p-3"> Total de libros comprados</span>
                                </div>

                                <div class="d-flex justify-content-center row">
                                    <span class="badge badge-primary con-borde m-2 p-3"> <?php echo $numero_libros ?> </span>
                                </div>


                            </div>
                        </div>
                        <div class="col">
                            <div class="container">
                                <div class="d-flex justify-content-center row">
                                    <span class="badge badge-primary con-borde m-2 p-3"> Total de Dinero</span>
                                </div>

                                <div class="d-flex justify-content-center row">
                                    <span class="badge badge-primary con-borde m-2 p-3"> <?php echo $total ?></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="tablaClienteVentas" class="table v2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cantidad</th>
                                    <th>Monto</th>
                                    <th>fecha</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>





<?php endif ?>

</div>