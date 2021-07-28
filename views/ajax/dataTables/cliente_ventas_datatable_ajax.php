<?php
require_once "../../../controllers/controller_cliente.php";
require_once "../../../models/cliente.model.php";

class TablaClienteVentas
{
    public function mostrarTablaClienteVentas($idcliente)
    {
        $respuesta = ClienteController::buscarClienteVentasController($idcliente);
        if (!empty($respuesta)) {

            $json = '{
                  "data": [';

            for ($i = 0; $i < count($respuesta); $i++) {


                $json .= '[
                        "' . ($i + 1) . '",
                        "' . $respuesta[$i]["cantidad"] . '",
                        "' . $respuesta[$i]["monto"] . '",
                        "' . $respuesta[$i]["fecha_alta"] . '"
                    ],';
            }

            $json = substr($json, 0, -1);

            $json .= ']
                  }';

            echo $json;
        } else {

            echo '{"data":[]}';
        }
    }
}

session_start();

if ($_SESSION["iniciarSesion"] == "ok") {

    if (isset($_GET["data"])) {
        $mostrarTablaClienteVentas = new TablaClienteVentas();
        $mostrarTablaClienteVentas->mostrarTablaClienteVentas($_GET["data"]);
    }
}
