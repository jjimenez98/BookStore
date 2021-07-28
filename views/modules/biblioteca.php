<?php

$action = explode("/", $_GET['action']);

$lista = new BibliotecaController();


?>



<div class="modulo-biblioteca">

    <div class="titulo-boton">
        <h6 class="titulo-modulo">Biblioteca</h6>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="caja mb-4">
                <label>Categorias</label>
                <div class="list-group">
                    <?php
                    $lista->traerLibrosVendidosCategoria()
                    ?>
                </div>
            </div>
        </div>

        <div class="col-9">

            <?php if (!isset($action[1])) : ?>
                <?php
                $lista->traerSiesLibrosMasVendidosController();
                ?>
            <?php endif ?>

            <?php if (isset($action[1]) && !isset($action[2])) : ?>
                <label>Autores</label>
                <div class="row">
                    <ul class="list-group list-group-horizontal">
                        <?php
                        $lista->obtenerAutoresPorCategoriaController($action[1]);
                        ?>
                    </ul>
                </div>

                <?php
                $libros = BibliotecaController::traerLibrosPorCategoriaController($action[1]);

                ?>

                <div class="row p-5">
                    <div class="table-responsive">
                        <table id="categoriasTable" categoria="<?php echo $action[1] ?>" class="table v2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Categoria</th>
                                    <th>fecha alta</th>
                                    <th>Autor</th>
                                    <th>Editorial</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody class="categoriasTableBody">

                                <?php foreach ($libros as $key => $value) : ?>
                                    <?php if (isset($value['id']) && $value['estado'] != '2') : ?>
                                        <tr class="rowTableCategorias">
                                            <td><?php echo ($key + 1); ?></td>
                                            <td> <a href="<?php echo $url . "biblioteca/" . $action[1] . "/" . $value["ruta"] ?>"> <?php echo $value["nombre"]; ?></a></td>
                                            <td>
                                                <image src=" <?php echo $url . $value['imagen']; ?>" width="100" height="80">
                                            </td>
                                            <td><?php echo $value["categoria"]; ?></td>
                                            <td><?php echo $value["fecha_alta"]; ?></td>
                                            <td class="autorTable"><?php echo $value["autor"]; ?></td>
                                            <td><?php echo $value["editorial"]; ?></td>
                                            <td data-toggle="modal" value="<?php echo $value["stock"]; ?>" data-target="#stockModal" class="stockTabla" id=<?php echo $value["id"] ?>> <?php echo $value["stock"]; ?></td>

                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>


                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endif ?>

            <?php if (isset($action[2])) : ?>

                <?php
                $libro = BibliotecaController::traerlibroController($action[2], $action[1]);
                ?>

                <div class="card">
                    <div class="row p">
                        <div class="col-6">
                            <image style="object-fit:cover" width="100%" height="100%" src=" <?php echo $url . $libro['imagen']; ?>"></image>
                        </div>
                        <div class="col-6">
                            <p> <?php echo $libro['nombre'] ?> </p>
                            <p> <?php echo $libro['autor'] ?> </p>
                            <p> <?php echo $libro['editorial'] ?> </p>
                            <p> <?php echo $libro['stock'] ?> </p>
                            <div class="form-group mr-5">
                                <form id="cantidadFormulario" onsubmit="return false">
                                    <label for="exampleInputPassword1">Cantidad</label>
                                    <input type="number" min=1 class="form-control" idCantidad="<?php echo $libro[0] ?>" id="cantidadAgregar" placeholder="Cantidad">
                                    <input type="submit" class="btn btn-primary mt-1"></input>
                                </form>
                            </div>
                            <label></label>
                        </div>
                    </div>


                </div>
        </div>


    <?php endif ?>



    </div>

</div>


</div>