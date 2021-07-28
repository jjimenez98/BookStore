<?php

require_once "../../../controllers/controller_ventas.php";
require_once "../../../models/ventas.model.php";

class TablaVentas
{

    public function mostrarTablaVentas()
    {
        $respuesta = VentasController::buscarVentasController();

        if (!empty($respuesta)) {
            $json = '{
                "data": [';

            for ($i = 0; $i < count($respuesta); $i++) {


                $json .= '[
                      "' . ($i + 1) . '",
                      "' . $respuesta[$i]["correo"] . '",
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

    $mostrarTablaVentas = new TablaVentas();
    $mostrarTablaVentas->mostrarTablaVentas();
}
