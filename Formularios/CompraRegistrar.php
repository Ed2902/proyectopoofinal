<?php    
    require_once('../Clases/producto.php');
    require_once('../Clases/proveedor.php');
    $productos = Producto::mostrar();
    $Proveedores = Proveedor::mostrar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background: rgba(255, 255, 255, 0.9) url('../images/pila-vista-superior-capas-papel-colores.jpg') no-repeat center center fixed; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <form onsubmit="return enviarFormulario()" method="POST" action="../Objetos/GuardarCompra.php" class="col-lg-6 col-md-8 col-sm-10 col-12 p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.7);">
                <h2 class="text-center mb-4">Compra</h2>
                
                <div class="mb-3">
                    <label for="CantidadCompra" class="form-label">Cantidad de Compra</label>
                    <input type="number" class="form-control" id="CantidadCompra" name="CantidadCompra" required>
                </div>
                <div class="mb-3">
                    <label for="PrecioCompra" class="form-label">Precio de Compra</label>
                    <input type="number" class="form-control" id="PrecioCompra" name="Precio_Compra" required>
                </div>
                <div class="mb-3">
                    <label for="PrecioVenta" class="form-label">Precio de Venta</label>
                    <input type="number" class="form-control" id="PrecioVenta" name="Precio_Venta" required>
                </div>
                <div class="mb-3">
                    <label for="Producto" class="form-label">Producto</label>
                    <select class="form-select" id="Producto" name="ID_ProductoFK" required>
                        <option selected disabled>Seleccione</option>
                        <?php
                            foreach ($productos as $producto) {
                                echo "<option value='" . $producto['ID_Producto'] . "'>" . $producto['NombreProd'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Proveedor" class="form-label">Proveedor</label>
                    <select class="form-select" id="Proveedor" name="ID_ProveedorFK" required>
                        <option selected disabled>Seleccione</option>
                        <?php
                            foreach ($Proveedores as $proveedor) {
                                echo "<option value='" . $proveedor['ID_Proveedor'] . "'>" . $proveedor['NombreProv'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function enviarFormulario() {
            alert('Formulario enviado correctamente');
            return true; // O false, según tus necesidades
        }
    </script>
</body>

</html>
