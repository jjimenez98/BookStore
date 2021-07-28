<?php

$totalVentasLibros = DashBoardController::traerTotalLibrosVendidosController();
$totalVentasMes = DashBoardController::traerTotalVentaMesController();
$cinco = DashBoardController::traerCincoLibrosMasVendidosController();

$counter = 0;



?>




<div class="modulo-dashboard">
    <input type="hidden" id="cargarPieMetricosDashboard" value="si">

    <div class="container-fluid">

        <div class="text-center">
            <h1>Dashboard de Administrador</h1>
        </div>

        <div class="row">

            <div class="col-6 p-5">


                <div class="row p-5">
                    <h2> Total de Ventas en el Mes : <span class="badge badge-secondary"><?php echo $totalVentasMes ?></span></h2>
                </div>

                <div class="row p-5 shadow">


                    <table id="tablaCincoLibros" class="table v2" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>nombre</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th>fecha alta</th>
                                <th>Editorial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cinco as $key => $value) : ?>

                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <td><?php echo $value["nombre"]; ?></td>
                                    <td><?php echo $value["autor"]; ?></td>
                                    <td><?php echo $value["id_categoria"]; ?></td>
                                    <td><?php echo $value["fecha_alta"]; ?></td>
                                    <td><?php echo $value["editorial"]; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>




            </div>
            <div class="col-6 p-5">
                <div class="row p-5">
                    <h2> Total Libros Vendidos : <span class="badge badge-secondary"><?php echo $totalVentasLibros[0] . " MXN"; ?></span></h2>
                </div>

                <div class="row sp-5 shadow"> <canvas id="pieChartMetrico" weight="50" height="150"></canvas>
                </div>


            </div>
        </div>
    </div>

</div>