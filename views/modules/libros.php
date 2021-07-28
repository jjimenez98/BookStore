<?php

$adminID = $_SESSION["id"];
$categorias = CategoriaController::buscarController(null, null);
$libros = LibroController::buscarController(null, null);
$url = TemplateController::obtenerUrlController();
$lista = new LibroController();

$counter = 0;
?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
</style>


<div class="modulo-categoria">
    <!-- Button modal Registrar Categoria -->
    <div class="caja mb-4">
        <div class="titulo-boton">
            <h6 class="titulo-modulo">Libros</h6>
            <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#librosModal">
                Registrar
            </button>
        </div>
    </div>





    <div class="modal fade" id="librosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="formularioLibroModal" onsubmit="return false">
                    <div class="modal-body">

                        <input type=hidden id="editarID">

                        <input type="hidden" id="registrarIdalta" value="<?php echo $adminID ?>">

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoria</label>

                                    <select id="registrarCategoriaLibro" class="form-control registrarCategoriaLibro" required>
                                        <?php foreach ($categorias as $key => $value) : ?>
                                            <?php if (isset($value['id']) && $value['estado'] != '2') : ?>

                                                <option value="<?php echo $value["id"] ?>"><?php echo $value["categoria"]; ?></option>

                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fname">Codigo:</label>
                                <input class="form-control validarCodigoLibro" type="text" id="registrarCodigoLibro" name="fname" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fname">Nombre del libro:</label>
                                <input class="form-control validarNombreLibro" type="text" id="registrarNombreLibro" name="fname" required>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="fname">Autor:</label>
                                <select class="form-control editable-select" type="text" id="registrarAutorLibro" name="fname" required>
                                    <?php
                                    $lista -> listaAutorController();
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fname">Editorial:</label>
                                <select class="form-control editable-select" type="text" id="registrarEditorialLibro" name="fname" required>
                                    <?php
                                    $lista -> listaEditorialController();
                                    ?>
                                </select>
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">Precio:</label>
                                <input class="form-control" type="number" id="registrarPrecioLibro" name="fname" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fname">Stock actual:</label>
                                <input class="form-control" type="text" id="registrarStockLibro" name="fname" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="registrarAlertaLibro"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="img">Select image:</label>
                                <input type="file" id="registrarImagenLibro" name="img" accept="image/*">
                            </div>
                        </div>







                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editarLibroSubmit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="librosEditarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="formularioLibroEditarModal" onsubmit="return false">
                    <div class="modal-body">

                        <input type=hidden id="editarLibrosID">

                        <input type="hidden" id="editarIdalta" value="<?php echo $adminID ?>">

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Categoria</label>

                                    <select id="editarCategoriaLibro" class="form-control" required>
                                        <?php foreach ($categorias as $key => $value) : ?>
                                            <?php if (isset($value['id']) && $value['estado'] != '2') : ?>

                                                <option value="<?php echo $value["categoria"] ?>"><?php echo $value["categoria"]; ?></option>

                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fname">Codigo:</label>
                                <input class="form-control" type="text" id="editarCodigoLibro" name="fname" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fname">Nombre del libro:</label>
                                <input class="form-control" type="text" id="editarNombreLibro" name="fname" required>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="fname">Autor:</label>
                                <select class="form-control" type="text" id="editarAutorLibro" name="fname" required>
                                    <?php 
                                        $lista -> listaAutorController()
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fname">Editorial:</label>
                                <select class="form-control" type="text" id="editarEditorialLibro" name="fname" required>
                                    <?php
                                    $lista -> listaEditorialController();
                                    ?>
                                </select>
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">Precio:</label>
                                <input class="form-control" type="text" id="editarPrecioLibro" name="fname" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fname">Stock:</label>
                                <input class="form-control" type="text" id="editarStockLibro" name="fname" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="img">Select image:</label>
                                <input type="file" id="editarImagenLibro" name="img" accept="image/*">
                            </div>

                            <div class="form-group col-md-6">
                                <prev>
                                    <image width=150 height=130 id="libroEditarImagenPreview" />
                                </prev>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editarLibroSubmit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stockModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregando Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="formulariostockModal" onsubmit="return false">
                    <div class="modal-body">
                        <input type=hidden id="editarLibrosStockID">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">Stock Actual:</label>
                                <label id="stockLabel"></label>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fname">Cantidad Agregar:</label>
                                <input class="from-control" type="number" min="1" id="stockAgregarLibro" name="fname" />
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary editarCategoriaSubmit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Caja -->
    <div class="caja mb-4">
        
        <div class="table-responsive">
            <table id="categoriasTable" class="table v2" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>fecha alta</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($libros as $key => $value) : ?>
                        <?php if (isset($value['id']) && $value['estado'] != '2') : ?>
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td>
                                    <?php if (isset($value["estado"]) && $value["estado"] == "0") : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="swtichLibroEstado" type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php else : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="swtichLibroEstado" type="checkbox">
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php endif ?>
                                </td>
                                <td> <?php echo $value["nombre"]; ?></td>
                                <td>  <image src="<?php echo $url . $value['imagen']; ?>" width="100" height="80"></td>
                                <td><?php echo $value["categoria"]; ?></td>
                                <td><?php echo $value["fecha_alta"]; ?></td>
                                <td><?php echo $value["autor"]; ?></td>
                                <td><?php echo $value["editorial"]; ?></td>
                                <td data-toggle="modal" value="<?php echo $value["stock"]; ?>" data-target="#stockModal" class="stockTabla" id=<?php echo $value["id"] ?>> <?php echo $value["stock"]; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <div class="px-1">

                                            <button type="button" id="<?php echo $value["id"]; ?>" class="btn btn-primary editarLibrosButton" data-toggle="modal" data-target="#librosEditarModal">
                                                Editar
                                            </button>


                                        </div>

                                        <form onsubmit="return false">

                                            <input type="hidden" id="<?php echo $value["id"]; ?>" name="eliminarRegistro">

                                            <button type="submit" id="<?php echo $value["id"]; ?>" class="btn btn-danger eliminarLibro">Borrar</button>

                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>


                </tbody>
            </table>
        </div>
    </div>







</div>
<script>
    $(document).ready(function() {
        $('#categoriasTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            responsive: true,
            ordering: true
        });
    });
</script>