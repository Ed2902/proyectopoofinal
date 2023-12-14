<?php


require_once("../Clases/Compras.php");

$objCompra = new Compras($_POST["CantidadCompra"], $_POST["Precio_Compra"],$_POST["Precio_Venta"],$_POST["ID_ProductoFK"], $_POST["ID_ProveedorFK"]);

$objCompra->guardarCompra();


echo $objCompra->getCantidadCompra();
echo $objCompra->getPrecio_Compra();
echo $objCompra->getPrecio_Venta();
echo $objCompra->getID_ProductoFK();
echo $objCompra->getID_ProveedorFK();

?>