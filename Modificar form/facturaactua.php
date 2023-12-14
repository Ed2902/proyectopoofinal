<?php
require_once("../Clases/facturas.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Factura = $_POST["ID_Factura"];
    $Fecha = $_POST["Fecha"];
    $Cantidad = $_POST["Cantidad"];
    $Total = $_POST["Total"];
    $ID_ProductoFK = $_POST["ID_ProductoFK"];
    $ID_ClienteFK = $_POST["ID_ClienteFK"];

    $factura = new Factura($ID_Factura, $Fecha, $Cantidad, $Total, $ID_ProductoFK, $ID_ClienteFK);
    $resultado = $factura->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Factura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">

                <h2 class="text-center mb-4">Formulario de Actualización de Factura</h2>

                <!-- Mostrar mensaje de resultado de la actualización -->
                <?php if (isset($resultado)) : ?>
                    <p class="text-success text-center mb-4"><?php echo $resultado; ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="ID_Factura" class="form-label">ID de la Factura a actualizar:</label>
                    <input type="text" name="ID_Factura" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Fecha" class="form-label">Nueva Fecha:</label>
                    <input type="date" name="Fecha" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Cantidad" class="form-label">Nueva Cantidad:</label>
                    <input type="text" name="Cantidad" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Total" class="form-label">Nuevo Total:</label>
                    <input type="text" name="Total" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_ProductoFK" class="form-label">Nuevo ID del Producto:</label>
                    <input type="text" name="ID_ProductoFK" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_ClienteFK" class="form-label">Nuevo ID del Cliente:</label>
                    <input type="text" name="ID_ClienteFK" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Factura</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
