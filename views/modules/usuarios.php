<?php

$usuarios = UsuarioController::buscarController(null, null);
$url = TemplateController::obtenerUrlController();
$adminID = $_SESSION["id"];
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
<!-- Button modal Registrar -->
<div class="container-fluid">
    <div class="row justify-content-end pt-5">

    </div>
</div>

<div class="caja mb-4">
    <div class="titulo-boton">
        <h6 class="titulo-modulo">Usuarios</h6>
        <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#exampleModal">
            Registrar
        </button>
    </div>
</div>




<!-- Modal Registrar-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="formularioUsuario" onsubmit="return false">
                <div class="modal-body">
                    <div class="caja mb-4">
                        <p class="titulo-caja">Formulario ejemplo</p>
                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input id="registrarNombre" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nivel</label>
                                    <select id="registrarNivel" class="form-control" required>
                                        <option selected>Open this select menu</option>
                                        <option value="admin">Administrador</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="cliente">Cliente</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-date-input">Fecha de Nacimiento</label>
                                    <div>
                                        <input class="form-control" type="date" id="registrarNacimiento" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input id="registrarCodigo" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input id="registrarCorreo" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" id="registrarContraseña" class="form-control contrasena" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirmar Contraseña</label>
                                    <input type="password" id="registrarCContraseña" class="form-control contrasena" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contrasenaMessage"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="img">Select image:</label><br>
                                <input type="file" id="registrarImagen" name="img" accept="image/*" required><br>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary registrarUsuario">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formularioEditarUsuario" onsubmit="return false">
                <div class="modal-body">

                    <input type=hidden id="editarID">

                    <div class="caja mb-4">
                        <p class="titulo-caja">Formulario ejemplo</p>
                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    <input id="editarNombre" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nivel</label>
                                    <select id="editarNivel" class="form-control">
                                        <option selected>Open this select menu</option>
                                        <option value="admin">Administrador</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="cliente">Cliente</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-date-input">Fecha de Nacimiento</label>
                                    <div>
                                        <input class="form-control" type="date" id="editarNacimiento">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input id="editarCodigo" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input id="editarCorreo" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" id="editarContraseña" class="editarcontrasena form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirmar Contraseña</label>
                                    <input type="password" id="editarCContraseña" class="editarcontrasena form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="editarcontrasenaMessage"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Select image:</label>
                                    <input type="file" id="editarImagen" name="img" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <prev>
                                        <image width=150 height=130 id="editarImagenPreview"></image>
                                    </prev>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary editarUsuario">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modulo-usuarios datatable">

    <div class="tabla">
        <table id="example" class="display dataTable table v2" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Nivel</th>
                    <th>fecha_alta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $key => $value) : ?>

                    <?php if (isset($value['id']) && $value['estado'] != '2') : ?>
                        <tr>
                            <td class="id"><?php echo ++$counter; ?></td>
                            <!-- <td class="estado"><?php echo $value['estado']; ?></td> -->
                            <td class="estado"><label class="switch">

                                    <?php if (isset($value["estado"]) && $value["estado"] == "0") : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="switchEstado" type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php else : ?>
                                        <label class="switch">
                                            <input id="<?php echo $value["id"]; ?>" class="switchEstado" type="checkbox">
                                            <span class="slider"></span>
                                        </label><br><br>

                                    <?php endif ?>
                            </td>
                            <td class="imagen">
                                <image src="<?php echo $url . $value['imagen']; ?>" width="100" height="80">
                            </td>
                            <td class="nombre"><?php echo $value['nombre_completo']; ?></td>
                            <td class="correo"><?php echo $value['correo']; ?></td>
                            <td class="nivel"><?php echo $value['nivel']; ?></td>
                            <td class="fecha_alta"><?php echo $value['fecha_alta']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <div class="px-1">

                                        <!-- <a href="index.php?pagina=editar&id=<?php echo $value["id"]; ?>" class="btn btn-warning">Editar</a> -->
                                        <!-- Button trigger modal -->
                                        <button type="button" id="<?php echo $value["id"]; ?>" class="btn btn-primary editarbutton" data-toggle="modal" data-target="#editarModal">
                                            Editar
                                        </button>
                                        <input type="hidden" class="codigoHiddenUsuario" id="<?php echo $value["codigo"]; ?>">

                                    </div>

                                    <form onsubmit="return false">

                                        <input type="hidden" id="<?php echo $value["id"]; ?>" name="eliminarRegistro">

                                        <button type="submit" id="<?php echo $value["id"]; ?>" class="btn btn-danger submitUsuario">Borrar</button>

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



<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            responsive: true,
            ordering: true
        });
    });
</script>