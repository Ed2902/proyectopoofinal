<?php


require_once("../Clases/cliente.php");
//$objPersonaje = personaje::guardar();
//Crear un objeto (instancia de una clase)

//var_dump($_POST);

$objcliente = new cliente($_POST["ID_Cliente"], $_POST["NombreCli"], $_POST["DireccionCli"],$_POST["Telefono"]);

$objcliente->guardar();

echo $objcliente->getIdCliente();
echo $objcliente->getNombre();
echo $objcliente->getDireccion();
echo $objcliente->getTelefono();
?>