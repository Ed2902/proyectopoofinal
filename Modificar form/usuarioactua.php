<?php
require_once("../Clases/usuario.php");

// Variable para almacenar el resultado del proceso de actualización
$mensajeActualizacion = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Usuario = $_POST["ID_Usuario"];
    $NombreUsuario = $_POST["NombreUsuario"];
    $Contrasena = $_POST["Contrasena"];
    $ID_RolFK = $_POST["ID_RolFK"];

    $usuario = new Usuario($NombreUsuario, $Contrasena, $ID_RolFK, $ID_Usuario);
    $mensajeActualizacion = $usuario->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">

                <h2 class="text-center mb-4">Formulario de Actualización de Usuario</h2>

                <!-- Formulario de actualizar usuario -->
                <div class="mb-3">
                    <label for="ID_Usuario" class="form-label">ID del Usuario a actualizar:</label>
                    <input type="text" name="ID_Usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="NombreUsuario" class="form-label">Nuevo Nombre de Usuario:</label>
                    <input type="text" name="NombreUsuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Contrasena" class="form-label">Nueva Contraseña:</label>
                    <input type="password" name="Contrasena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_RolFK" class="form-label">Nuevo ID de Rol:</label>
                    <input type="text" name="ID_RolFK" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            </form>
        </div>

        <!-- Mensaje de resultado centrado debajo del formulario -->
        <?php if (!empty($mensajeActualizacion)) : ?>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12 alert alert-success text-center">
                    <?php echo $mensajeActualizacion; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o
