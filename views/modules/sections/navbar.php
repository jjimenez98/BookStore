<?php
$url = TemplateController::obtenerUrlController();
?>


<?php if (isset($_SESSION["nivel"]) && ($_SESSION["nivel"] == "admin" || $_SESSION["nivel"] == "supervisor")) : ?>

    <nav class="navbar">
        <a class="navbar-brand" href="#"><img src="https://via.placeholder.com/280x150"></a>
        <button class="btn btn-menu"></button>
        <div class="info-usuario">
            <div class="media">
                <div class="media-body">
                    <p>Hola, <span><?php echo $_SESSION["nivel"] ?></span></p>
                </div>
                <img src="<?php echo $url . $_SESSION['imagen']; ?>" class="ml-3" alt="">
                <a class="btn btn-sesion" href="index.php?action=salir"><i class="flaticon-log-out"></i></a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <nav id="sidebar">
        <!-- Menu ### Cambiar clase dependiendo del usuario -->
        <ul id="menu" class="default">
            <!-- Dashboard -->
            <li class="nav-item">
                ><a class="nav-link" href="<?php echo $url; ?>dashboard"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
            </li>
            <!-- Usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>usuarios"><i class="flaticon-user"></i><span>Usuarios</span></a>
            </li>
            <!-- Categorias -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>categorias"><i class="flaticon-inventory"></i><span>Categorias</span></a>
            </li>
            <!-- Libros -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>libros"><i class="flaticon-human-resources"></i><span>Libros</span></a>
            </li>
            <!-- Clientes -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>clientes"><i class="flaticon-configuration"></i><span>Clientes</span></a>
            </li>
            <!-- Metricos -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>metricos"><i class="flaticon-inventory"></i><span>Metricos</span></a>
            </li>
            <!-- Ventas -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url; ?>ventas"><i class="flaticon-dashboard"></i><span>Ventas</span></a>
            </li>

            <!--/Grupo -->
        </ul>
    </nav>

<?php else : ?>

    <nav class="navbar">
        <a class="navbar-brand" href="#"><img src="https://via.placeholder.com/280x150"></a>
        <button class="btn btn-menu"></button>
        <div class="info-usuario">
            <div class="media">
                <div class="media-body">
                    <p>Hola, <span><?php echo $_SESSION["nivel"] ?></span></p>
                </div>
                <img src="https://via.placeholder.com/50x50" class="ml-3" alt="">
                <a id="btnCarrito" class="btn btn-info mr-1" data-toggle="modal" data-target="#exampleModal">Carrito</i></a>
                <a class="btn btn-sesion" href="<?php echo $url; ?>salir"><i class="flaticon-log-out"></i></a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->
    <nav id="sidebar">
        <!-- Menu ### Cambiar clase dependiendo del usuario -->
        <ul id="menu" class="default">
            <!-- Dashboard -->
            <li class="nav-item">
                ><a class="nav-link" href="<?php echo $url; ?>biblioteca"><i class="flaticon-dashboard"></i><span>Biblioteca</span></a>
            </li>

            <!--/Grupo -->
        </ul>
    </nav>



<?php endif ?>