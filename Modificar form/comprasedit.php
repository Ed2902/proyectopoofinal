<?php
require_once("../Clases/compras.php");

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $ID_DetalleCompra = $_POST["ID_DetalleCompra"];
    $CantidadCompra = $_POST["CantidadCompra"];
    $Precio_Compra = $_POST["Precio_Compra"];
    $Precio_Venta = $_POST["Precio_Venta"];
    $ID_ProductoFK = $_POST["ID_ProductoFK"];
    $ID_ProveedorFK = $_POST["ID_ProveedorFK"];

    // Crear un objeto Compras con los datos del formulario
    $compra = new Compras($CantidadCompra, $Precio_Compra, $Precio_Venta, $ID_ProductoFK, $ID_ProveedorFK, $ID_DetalleCompra);

    // Llamar al método actualizar()
    $resultado = $compra->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            margin-top: 50px;
        }

        form {
            width: 50%;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            margin-top: 10px;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .mensaje {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Formulario de Actualización de Compra</h2>

        <!-- Mostrar mensaje de resultado de la actualización -->
        <?php if (isset($resultado)) : ?>
            <p class="text-success mensaje"><?php echo $resultado; ?></p>
        <?php endif; ?>

        <!-- Formulario de actualización -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

            <label for="ID_DetalleCompra">ID que desea cambiar:</label>
            <input type="text" name="ID_DetalleCompra" required>

            <label for="CantidadCompra">Nueva Cantidad Comprada:</label>
            <input type="text" name="CantidadCompra" required>

            <label for="Precio_Compra">Nuevo Precio de Compra:</label>
            <input type="text" name="Precio_Compra" required>

            <label for="Precio_Venta">Nuevo Precio de Venta:</label>
            <input type="text" name="Precio_Venta" required>

            <label for="ID_ProductoFK">Nuevo Producto:</label>
            <input type="text" name="ID_ProductoFK" required>

            <label for="ID_ProveedorFK">Nuevo Proveedor:</label>
            <input type="text" name="ID_ProveedorFK" required>

            <button type="submit">Actualizar Compra</button>
        </form>
    </div>

</body>

</html>
