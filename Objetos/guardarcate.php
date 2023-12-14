<?php


require_once "../Clases/categoria.php";




$objcategoria = new categoria($_POST["NombreCategoria"], $_POST["DescripcionCat"]);

$objcategoria->guardar();


echo $objcategoria->getNombreCategoria();
echo $objcategoria->getDescripcionCat();


?>