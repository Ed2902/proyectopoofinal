<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Dashboard - Productos</h1>

    <?php
    require_once "../Clases/producto.php";

    // Obtener datos de productos
    $productos = Producto::mostrar();

    if (!empty($productos)) {
        // Mostrar los datos en una tabla
        echo "<h2>Tabla de Productos</h2>";
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Precio Compra</th>
                        <th>Cantidad Disponible</th>
                        <th>ID Categoría</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($productos as $producto) {
            echo "<tr>
                    <td>" . $producto["ID_Producto"] . "</td>
                    <td>" . $producto["NombreProd"] . "</td>
                    <td>" . $producto["CodigoProducto"] . "</td>
                    <td>" . $producto["DescripcionProd"] . "</td>
                    <td>" . $producto["PrecioUnitario"] . "</td>
                    <td>" . $producto["PrecioCompra"] . "</td>
                    <td>" . $producto["Cantidad_Disponible"] . "</td>
                    <td>" . $producto["ID_CategoriaFK"] . "</td>
                </tr>";
        }

        echo "</tbody></table>";

        // Obtener la cantidad total disponible por categoría
        $cantidadPorCategoria = Producto::obtenerCantidadDisponiblePorCategoria();

        if (!empty($cantidadPorCategoria)) {
            // Mostrar el gráfico de cantidad disponible por categoría
            echo "<h2>Gráfico de Cantidad Disponible por Categoría</h2>";
            echo '<div style="width: 80%; margin: 20px auto;">
                    <canvas id="productosChartPorCategoria" width="400" height="200"></canvas>
                  </div>';

            // Obtener datos para el gráfico
            $etiquetasPorCategoria = array();
            $datosGraficoPorCategoria = array();

            foreach ($cantidadPorCategoria as $categoria) {
                $etiquetasPorCategoria[] = "Categoría " . $categoria["ID_CategoriaFK"];
                $datosGraficoPorCategoria[] = $categoria["Total"];
            }

            // Crear el script para el gráfico de barras
            echo '<script>
                    var ctxPorCategoria = document.getElementById("productosChartPorCategoria").getContext("2d");
                    var myChartPorCategoria = new Chart(ctxPorCategoria, {
                        type: "bar",
                        data: {
                            labels: ' . json_encode($etiquetasPorCategoria) . ',
                            datasets: [{
                                label: "Cantidad Disponible por Categoría",
                                data: ' . json_encode($datosGraficoPorCategoria) . ',
                                backgroundColor: [
                                    "rgba(75, 192, 192, 0.2)",
                                    "rgba(255, 99, 132, 0.2)",
                                    "rgba(255, 205, 86, 0.2)",
                                    "rgba(54, 162, 235, 0.2)",
                                    "rgba(153, 102, 255, 0.2)",
                                    "rgba(255, 159, 64, 0.2)"
                                ],
                                borderColor: [
                                    "rgba(75, 192, 192, 1)",
                                    "rgba(255, 99, 132, 1)",
                                    "rgba(255, 205, 86, 1)",
                                    "rgba(54, 162, 235, 1)",
                                    "rgba(153, 102, 255, 1)",
                                    "rgba(255, 159, 64, 1)"
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                  </script>';
        } else {
            echo "No hay cantidad disponible de productos por categoría.";
        }

        // Mostrar el gráfico de cantidad disponible de cada producto (en gráfico de torta)
        echo "<h2>Gráfico de Cantidad Disponible de Cada Producto</h2>";
        echo '<div style="width: 105%; margin: 20px auto;"> <!-- Ajuste del ancho al 105% -->
                <canvas id="productosChart" width="500" height="250"></canvas> <!-- Ajuste de la altura al doble -->
              </div>';

        // Obtener datos para el gráfico
        $etiquetas = array();
        $datosGrafico = array();

        foreach ($productos as $producto) {
            $etiquetas[] = $producto["NombreProd"];
            $datosGrafico[] = $producto["Cantidad_Disponible"];
        }

        // Crear el script para el gráfico de torta
        echo '<script>
                var ctx = document.getElementById("productosChart").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ' . json_encode($etiquetas) . ',
                        datasets: [{
                            label: "Cantidad Disponible de Cada Producto",
                            data: ' . json_encode($datosGrafico) . ',
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.5)",
                                "rgba(54, 162, 235, 0.5)",
                                "rgba(255, 205, 86, 0.5)",
                                "rgba(75, 192, 192, 0.5)",
                                "rgba(153, 102, 255, 0.5)",
                                "rgba(255, 159, 64, 0.5)"
                            ],
                            borderColor: [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(255, 205, 86, 1)",
                                "rgba(75, 192, 192, 1)",
                                "rgba(153, 102, 255, 1)",
                                "rgba(255, 159, 64, 1)"
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: "right"
                            },
                            title: {
                                display: true,
                                text: "Cantidad Disponible de Cada Producto"
                            }
                        }
                    }
                });
              </script>';
    } else {
        echo "No hay datos de productos.";
    }
    ?>
</div>

</body>
</html>
