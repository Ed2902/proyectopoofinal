<?php
require_once("../Clases/Producto.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Producto = $_POST["ID_Producto"];
    $NombreProd = $_POST["NombreProd"];
    $CodigoProducto = $_POST["CodigoProducto"];
    $DescripcionProd = $_POST["DescripcionProd"];
    $PrecioUnitario = $_POST["PrecioUnitario"];
    $PrecioCompra = $_POST["PrecioCompra"];
    $Cantidad_Disponible = $_POST["Cantidad_Disponible"];
    $ID_CategoriaFK = $_POST["ID_CategoriaFK"];

    $producto = new Producto($NombreProd, $CodigoProducto, $DescripcionProd, $PrecioUnitario, $PrecioCompra, $Cantidad_Disponible, $ID_CategoriaFK, $ID_Producto);
    $resultado = $producto->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">

                <h2 class="text-center mb-4">Formulario de Actualización de Producto</h2>

                <!-- Mostrar mensaje de resultado de la actualización -->
                <?php if (isset($resultado)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $resultado; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="ID_Producto" class="form-label">ID del Producto a actualizar:</label>
                    <input type="text" name="ID_Producto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="NombreProd" class="form-label">Nuevo Nombre del Producto:</label>
                    <input type="text" name="NombreProd" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="CodigoProducto" class="form-label">Nuevo Código del Producto:</label>
                    <input type="text" name="CodigoProducto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="DescripcionProd" class="form-label">Nueva Descripción del Producto:</label>
                    <input type="text" name="DescripcionProd" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="PrecioUnitario" class="form-label">Nuevo Precio Unitario del Producto:</label>
                    <input type="text" name="PrecioUnitario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="PrecioCompra" class="form-label">Nuevo Precio de Compra del Producto:</label>
                    <input type="text" name="PrecioCompra" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Cantidad_Disponible" class="form-label">Nueva Cantidad Disponible del Producto:</label>
                    <input type="text" name="Cantidad_Disponible" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ID_CategoriaFK" class="form-label">Nuevo ID de Categoría del Producto:</label>
                    <input type="text" name="ID_CategoriaFK" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            </form>
        </div>
    </div>
</body>

</html>
