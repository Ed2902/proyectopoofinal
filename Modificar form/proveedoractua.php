<?php
require_once("../Clases/proveedor.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Proveedor = $_POST["ID_Proveedor"];
    $NombreProv = $_POST["NombreProv"];
    $DireccionProv = $_POST["DireccionProv"];
    $Telefono = $_POST["Telefono"];
    $Correo = $_POST["Correo"];

    $proveedor = new Proveedor($ID_Proveedor, $NombreProv, $DireccionProv, $Correo, $Telefono);
    $resultado = $proveedor->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Proveedor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">

                <h2 class="text-center mb-4">Formulario de Actualización de Proveedor</h2>

                <!-- Mostrar mensaje de resultado de la actualización -->
                <?php if (isset($resultado)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $resultado; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="ID_Proveedor" class="form-label">ID del Proveedor a actualizar:</label>
                    <input type="text" name="ID_Proveedor" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="NombreProv" class="form-label">Nuevo Nombre del Proveedor:</label>
                    <input type="text" name="NombreProv" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="DireccionProv" class="form-label">Nueva Dirección del Proveedor:</label>
                    <input type="text" name="DireccionProv" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Telefono" class="form-label">Nuevo Teléfono del Proveedor:</label>
                    <input type="text" name="Telefono" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Correo" class="form-label">Nuevo Correo del Proveedor:</label>
                    <input type="email" name="Correo" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
            </form>
        </div>
    </div>
</body>

</html>
