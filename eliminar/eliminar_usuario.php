<?php
require_once "../Clases/usuario.php";

if (isset($_GET['id'])) {
    $ID_Usuario = $_GET['id'];

    // Obtén los datos del usuario que deseas eliminar
    $usuarioDatos = usuario::obtenerUsuarioPorID($ID_Usuario);

    if ($usuarioDatos) {
        // Crea una instancia de usuario con los datos obtenidos
        $usuario = new usuario(
            $usuarioDatos['NombreUsuario'],
            $usuarioDatos['Contrasena'],
            $usuarioDatos['ID_RolFK'],
            $ID_Usuario
        );

        // Intenta eliminar el usuario
        $mensaje = $usuario->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el usuario con el ID proporcionado.";
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
