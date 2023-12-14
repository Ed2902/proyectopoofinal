<?php
require_once "../Clases/facturas.php";

if (isset($_GET['id'])) {
    $ID_Factura = $_GET['id'];

    // Obtén los datos de la factura que deseas eliminar
    $facturaDatos = Factura::obtenerFacturaPorID($ID_Factura);

    if ($facturaDatos) {
        // Crea una instancia de Factura con los datos obtenidos
        $factura = new Factura(
            $facturaDatos['ID_Factura'],
            $facturaDatos['Fecha'],
            $facturaDatos['Cantidad'],
            $facturaDatos['Total'],
            $facturaDatos['ID_ProductoFK'],
            $facturaDatos['ID_ClienteFK']
        );

        // Intenta eliminar la factura
        $mensaje = $factura->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró la factura con el ID proporcionado.";
    }
} else {
    echo "ID de factura no proporcionado.";
}
?>
