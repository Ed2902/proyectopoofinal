<?php
require_once("../Clases/HistoricoModificacion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Historico = $_POST["ID_Historico"];
    $Fecha = $_POST["Fecha"];
    $Detalles = $_POST["Detalles"];
    $ID_ProductoFK = $_POST["ID_ProductoFK"];
    $ID_UsuarioFK = $_POST["ID_UsuarioFK"];

    $historico = new HistoricoModificacion($Fecha, $Detalles, $ID_ProductoFK, $ID_UsuarioFK, $ID_Historico);
    $resultado = $historico->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">

                <h2 class="text-center mb-4">Formulario de Actualización de Registro</h2>

                <!-- Mostrar mensaje de resultado de la actualización -->
                <?php if (isset($resultado)) : ?>
                    <p class="text-success text-center mb-4"><?php echo $resultado; ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="ID_Historico" class="form-label">ID del Registro a actualizar:</label>
                    <input type="number" name="ID_Historico" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Fecha" class="form-label">Nueva Fecha:</label>
                    <input type="date" name="Fecha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Detalles" class="form-label">Nuevos Detalles:</label>
                    <input type="text" name="Detalles" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_ProductoFK" class="form-label">Nuevo ID del Producto:</label>
                    <input type="number" name="ID_ProductoFK" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_UsuarioFK" class="form-label">Nuevo ID del Usuario:</label>
                    <input type="number" name="ID_UsuarioFK" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Registro</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
