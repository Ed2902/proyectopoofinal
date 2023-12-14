<?php


require_once("../Clases/rol.php");
//$objPersonaje = personaje::guardar();
//Crear un objeto (instancia de una clase)

//var_dump($_POST);

$objrol = new rol($_POST["NombreRol"], $_POST["DescripcionRol"]);

$objrol->guardar();


echo $objrol->getNombreRol();
echo $objrol->getDescripcionRol();
?>