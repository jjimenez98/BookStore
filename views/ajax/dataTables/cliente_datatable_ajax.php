<?php

require_once "../../../controllers/controller_cliente.php";
require_once "../../../models/cliente.model.php";

class TablaClientes
{
    public function mostrarTablaClientes()
    {
        $respuesta = ClienteController::buscarClientesController();

        if (!empty($respuesta)) {

            $json = '{
              "data": [';

            for ($i = 0; $i < count($respuesta); $i++) {

                $cliente = "<a  href='clientes/" . $respuesta[$i]["codigo"] . "'>" . $respuesta[$i]["nombre_completo"] . "</a>";

                $json .= '[
                    "' . ($i + 1) . '",
                    "' . $respuesta[$i]["estado"] . '",
                    "' . $cliente . '",
                    "' . $respuesta[$i]["correo"] . '",
                    "' . $respuesta[$i]["fecha_alta"] . '",
                    "' . $respuesta[$i]["codigo"] . '"
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

    $mostrarTablaClientes = new TablaClientes();
    $mostrarTablaClientes->mostrarTablaClientes();
}
