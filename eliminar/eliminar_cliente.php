<?php
require_once "../Clases/Cliente.php"; // Asegúrate de que la ruta sea correcta

if (isset($_GET['id'])) {
    $ID_Cliente = $_GET['id'];

    // Obtén los datos del cliente que deseas eliminar
    $clienteDatos = Cliente::obtenerClientePorID($ID_Cliente);

    if ($clienteDatos) {
        // Crea una instancia de Cliente con los datos obtenidos
        $cliente = new Cliente(
            $clienteDatos['ID_Cliente'],
            $clienteDatos['NombreCli'],
            $clienteDatos['DireccionCli'],
            $clienteDatos['Telefono']
        );

        // Intenta eliminar el cliente
        $mensaje = $cliente->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el cliente con el ID proporcionado.";
    }
} else {
    echo "ID de cliente no proporcionado.";
}
?>

