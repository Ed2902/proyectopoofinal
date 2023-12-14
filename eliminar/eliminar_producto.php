<?php
require_once "../Clases/Producto.php";

if (isset($_GET['id'])) {
    $ID_Producto = $_GET['id'];

    // Obtén los datos del producto que deseas eliminar
    $productoDatos = Producto::obtenerProductoPorID($ID_Producto);

    if ($productoDatos) {
        // Crea una instancia de Producto con los datos obtenidos
        $producto = new Producto(
            $productoDatos['NombreProd'],
            $productoDatos['CodigoProducto'],
            $productoDatos['DescripcionProd'],
            $productoDatos['PrecioUnitario'],
            $productoDatos['PrecioCompra'],
            $productoDatos['Cantidad_Disponible'],
            $productoDatos['ID_CategoriaFK'],
            $ID_Producto
        );

        // Intenta eliminar el producto
        $mensaje = $producto->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el producto con el ID proporcionado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}
?>

