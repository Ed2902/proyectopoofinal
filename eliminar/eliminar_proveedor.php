<?php
require_once "../Clases/Proveedor.php";

if (isset($_GET['id'])) {
    $ID_Proveedor = $_GET['id'];

    // Obtén los datos del proveedor que deseas eliminar
    $proveedorDatos = Proveedor::obtenerProveedorPorID($ID_Proveedor);

    if ($proveedorDatos) {
        // Crea una instancia de Proveedor con los datos obtenidos
        $proveedor = new Proveedor(
            $proveedorDatos['ID_Proveedor'],
            $proveedorDatos['NombreProv'],
            $proveedorDatos['DireccionProv'],
            $proveedorDatos['Correo'],
            $proveedorDatos['Telefono']
        );

        // Intenta eliminar el proveedor
        $mensaje = $proveedor->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el proveedor con el ID proporcionado.";
    }
} else {
    echo "ID de proveedor no proporcionado.";
}
?>
