<?php

require_once("../Clases/producto.php");

$objProducto = new Producto($_POST["NombreProd"], $_POST["CodigoProducto"], $_POST["DescripcionProd"], $_POST["PrecioUnitario"], $_POST["PrecioCompra"], $_POST["Cantidad_Disponible"], $_POST["ID_CategoriaFK"]);

$objProducto->guardar();

echo $objProducto->getNombreProd();
echo $objProducto->getCodigoProducto();
echo $objProducto->getDescripcion();    
echo $objProducto->getPrecioUnitario();
echo $objProducto->getPrecioCompra();
echo $objProducto->getCantidad_Disponible();
echo $objProducto->getID_CategoriaFK();
?>