<?php


require_once("../clases/HistoricoModificacion.php");
//$objPersonaje = personaje::guardar();
//Crear un objeto (instancia de una clase)

//var_dump($_POST);

$objhistorico = new HistoricoModificacion($_POST["Fecha"], $_POST["Detalles"], $_POST["ID_ProductoFK"], $_POST["ID_UsuarioFK"]);

$objhistorico->guardar();


echo $objhistorico->getFecha();
echo $objhistorico->getDetalles();
echo $objhistorico->getID_ProductoFK();
echo $objhistorico->getID_UsuarioFK();
?>