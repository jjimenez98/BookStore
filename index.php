<?php

//controllers
require_once "controllers/controller_template.php";
require_once "controllers/controller_login.php";
require_once "controllers/controller_usuarios.php";
require_once "controllers/controller_categoria.php";
require_once "controllers/controller_libro.php";
require_once "controllers/controller_cliente.php";
require_once "controllers/controller_ventas.php";
require_once "controllers/controller_metricos.php";
require_once "controllers/controller_dashboard.php";
require_once "controllers/controller_biblioteca.php";
//models
require_once "models/login.model.php";
require_once "models/usuario.model.php";
require_once "models/categorias.model.php";
require_once "models/libro.model.php";
require_once "models/cliente.model.php";
require_once "models/ventas.model.php";
require_once "models/metricos.model.php";
require_once "models/dashboard.model.php";
require_once "models/biblioteca.model.php";

$template = new TemplateController();
$template->template();
