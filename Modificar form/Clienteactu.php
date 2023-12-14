<?php
require_once("../Clases/cliente.php");

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $ID_Cliente = $_POST["ID_Cliente"];
    $NombreCli = $_POST["NombreCli"];
    $DireccionCli = $_POST["DireccionCli"];
    $Telefono = $_POST["Telefono"];

    // Crear un objeto Cliente con los datos del formulario
    $cliente = new Cliente($ID_Cliente, $NombreCli, $DireccionCli, $Telefono);

    // Llamar al método actualizar()
    $resultado = $cliente->actualizar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Actualización de Cliente</title>
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
        <h2>Formulario de Actualización de Cliente</h2>

        <!-- Mostrar mensaje de resultado de la actualización -->
        <?php if (isset($resultado)) : ?>
            <p class="text-success mensaje"><?php echo $resultado; ?></p>
        <?php endif; ?>

        <!-- Formulario de actualización -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

            <label for="ID_Cliente">ID del Cliente a actualizar:</label>
            <input type="text" name="ID_Cliente" required>

            <label for="NombreCli">Nuevo Nombre del Cliente:</label>
            <input type="text" name="NombreCli" required>

            <label for="DireccionCli">Nueva Dirección del Cliente:</label>
            <input type="text" name="DireccionCli" required>

            <label for="Telefono">Nuevo Teléfono del Cliente:</label>
            <input type="text" name="Telefono" required>

            <button type="submit">Actualizar Cliente</button>
        </form>
    </div>

</body>

</html>
