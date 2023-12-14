<?php


require_once("../Clases/proveedor.php");


$objproveedor = new proveedor($_POST["ID_Proveedor"], $_POST["NombreProv"], $_POST["DireccionProv"], $_POST["Correo"], $_POST["Telefono"]);

$objproveedor->guardar();

echo $objproveedor->getidProveedor();
echo $objproveedor->getNombreProv();
echo $objproveedor->getDireccionProv();
echo $objproveedor->getCorreo();
echo $objproveedor->getTelefonos();
?>