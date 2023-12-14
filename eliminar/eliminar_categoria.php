<?php
require_once "../Clases/categoria.php";

if (isset($_GET['id'])) {
    $idCategoria = $_GET['id'];

    // Obtén los datos de la categoría que deseas eliminar (asumo que tienes funciones para esto)
    $categoriaDatos = categoria::obtenerCategoriaPorID($idCategoria);

    if ($categoriaDatos) {
        // Crea una instancia de categoria con los datos obtenidos
        $categoria = new categoria(
            $categoriaDatos['NombreCategoria'],
            $categoriaDatos['DescripcionCat'],
            $idCategoria
        );

        // Intenta eliminar la categoría
        $mensaje = $categoria->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró la categoría con el ID proporcionado.";
    }
} else {
    echo "ID de categoría no proporcionado.";
}
?>
