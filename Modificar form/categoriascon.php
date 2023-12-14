<?php
require_once("../Clases/categoria.php");

// Manejar la actualización desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_categoria = $_POST["id_categoria"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nueva_descripcion = $_POST["nueva_descripcion"];

    $categoria = new categoria($nuevo_nombre, $nueva_descripcion, $id_categoria);
    $resultado = $categoria->actualizar();
    $categorias = categoria::mostrar();
}

// Obtener y mostrar las categorías existentes
$categorias = categoria::mostrar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Formulario de Actualización de Categoría</title>
</head>

<body style="background: rgba(255, 255, 255, 0.7) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="bg-white p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.8);">
                    <h2 class="text-center mb-4">Formulario de Actualización de Categoría</h2>

                    <!-- Mostrar mensaje de resultado de la actualización -->
                    <?php if (isset($resultado)) : ?>
                        <p class="text-success text-center"><?php echo $resultado; ?></p>
                    <?php endif; ?>

                    <!-- Mostrar las categorías existentes 
                    <h3 class="text-center">Categorías existentes:</h3>
                    <ul class="list-group">
                        <?php foreach ($categorias as $cat) : ?>
                            <li class="list-group-item"><?php echo $cat['ID_Categoria'] . "   " . $cat['NombreCategoria']; ?></li>
                        <?php endforeach; ?>
                    </ul>-->    

                    <!-- Formulario de actualización -->
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">ID de Categoría a actualizar:</label>
                        <input type="text" name="id_categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nuevo_nombre" class="form-label">Nuevo Nombre:</label>
                        <input type="text" name="nuevo_nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nueva_descripcion" class="form-label">Nueva Descripción:</label>
                        <input type="text" name="nueva_descripcion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
