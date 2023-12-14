<?php


require_once("../Clases/usuario.php");
//$objPersonaje = personaje::guardar();
//Crear un objeto (instancia de una clase)

//var_dump($_POST);

$objusuario = new usuario($_POST["NombreUsuario"], $_POST["Contrasena"],$_POST["ID_RolFK"]);

$objusuario->guardar();


echo $objusuario->getNombreUsuario();
echo $objusuario->getContrasena();
echo $objusuario->getID_RolFK();
?>