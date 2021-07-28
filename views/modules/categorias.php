<?php

$adminID = $_SESSION["id"];
$categorias = CategoriaController::buscarController(null, null);
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
        <p class="titulo-caja">Agregar Categoria</p>
        <form onsubmit="return false" id="formularioCategorias" class="form-inline">
            <input type="hidden" id="id_alta" value="<?php echo $adminID ?>">
            <div class="form-group mb-2">
                <label for="categoria" class="sr-only">Categoria</label>
                <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoria" required>
            </div>
            <button type="submit" id="rbtnCategorias" class="btn btn-primary mx-sm-3 mb-2">Agregar</button>
        </form>

    </div>

    <div class="modal fade" id="editarCategoriasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="formularioCategoriasModal" onsubmit="return false">
                    <div class="modal-body">

                        <input type=hidden id="editarID">

                        <input type="hidden" id="registrarIdalta" value="<?php echo $adminID ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-date-input">Categoria: </label>
                                <div>
                                    <input class="form-control" type="text" id="editarCategoria" required>
                                </div>
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
        <p class="titulo-caja">Estilo para tabla v2</p>
        <div class="table-responsive">
            <table id="categoriasTable" class="table v2" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Categoria</th>
                        <th>fecha alta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $key => $value) : ?>
                        <?php if (isset($value['id']) && $value['estado'] != '2') : ?>
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td>
                                    <?php if (isset($value["estado"]) && $value["estado"] == "0") : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="categoriaswitchEstado" type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php else : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="categoriaswitchEstado" type="checkbox">
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php endif ?>
                                </td>
                                <td><?php echo $value["categoria"]; ?></td>
                                <td><?php echo $value["fecha_alta"]; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <div class="px-1">

                                            <button type="button" id="<?php echo $value["id"]; ?>" class="btn btn-primary editarCategoriaButton" data-toggle="modal" data-target="#editarCategoriasModal">
                                                Editar
                                            </button>


                                        </div>

                                        <form onsubmit="return false">

                                            <input type="hidden" id="<?php echo $value["id"]; ?>" name="eliminarRegistro">

                                            <button type="submit" id="<?php echo $value["id"]; ?>" class="btn btn-danger eliminarCategoria">Borrar</button>

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