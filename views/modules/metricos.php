<?php


$totalVentasLibros = DashBoardController::traerTotalLibrosVendidosController();
$totalVentasMes = DashBoardController::traerTotalVentaMesController();
$cinco = DashBoardController::traerCincoLibrosMasVendidosController();

$counter = 0;


?>



<div class="modulo-metricos">
    <div class="text-center">
        <h1>Metricos</h1>
    </div>

    <input type="hidden" id="cargarPieMetricos" value="si">

    <div class="container">
        <form id="metricosFormulario" onsubmit="return false">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Fecha 1</label>
                        <input type="date" class="form-control" id="fecha1Metricos" placeholder="First name">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Fecha 2</label>
                        <input type="date" class="form-control" id ="fecha2Metricos" placeholder="Last name">
                    </div>
                </div>

                <div class="col-auto">
                    <div class="form-group mt-3 p-2">
                        <input type="submit" class="form-control btn-primary" placeholder="Last name">
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="row">

        <div class="col-6 p-5">


            <div class="row p-5">
                <h2> Total de Ventas en el Mes : <span class="badge badge-secondary"></span></h2>
            </div>

            <div class="row p-5 shadow">

                <div class="container-fluid">
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>




        </div>
        <div class="col-6 p-5">
            <div class="row p-5">
                <h2> Total Libros Vendidos : <span class="badge badge-secondary"><?php echo " MXN"; ?></span></h2>
            </div>

            <div class="row sp-5 shadow"> <canvas id="pieChartMetrico" weight="50" height="150"></canvas>
            </div>


        </div>
    </div>




</div>