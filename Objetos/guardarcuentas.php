<?php


require_once("../Clases/CuentasCobrar.php");

$objCuentasCobrar = new CuentasCobrar(null, $_POST["Monto_Debido"], $_POST["Fecha_Limite"], $_POST["ID_ClienteFK"]);

$objCuentasCobrar->guardar();

echo $objCuentasCobrar->getMonto_Debido();
echo $objCuentasCobrar->getFecha_Limite();
echo $objCuentasCobrar->getID_ClienteFK();

?>
