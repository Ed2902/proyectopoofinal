<?php
require_once "../Clases/Compras.php";

if (isset($_GET['id'])) {
    $idDetalleCompra = $_GET['id'];

    // Obtén los datos de la compra que deseas eliminar (asumo que tienes funciones para esto)
    $detalleCompra = Compras::obtenerDetalleCompraPorID($idDetalleCompra);

    if ($detalleCompra) {
        // Crea una instancia de Compras con los datos obtenidos
        $compra = new Compras(
            $detalleCompra['CantidadCompra'],
            $detalleCompra['Precio_Compra'],
            $detalleCompra['Precio_Venta'],
            $detalleCompra['ID_ProductoFK'],
            $detalleCompra['ID_ProveedorFK'],
            $idDetalleCompra
        );

        // Intenta eliminar la compra
        $mensaje = $compra->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el detalle de compra con el ID proporcionado.";
    }
} else {
    echo "ID de detalle de compra no proporcionado.";
}
?>
