<?php

require_once("../Clases/facturas.php");

$objfactura = new Factura($_POST["idFactura"], $_POST["fecha"], $_POST["cantidad"], $_POST["total"], $_POST["idProductoFK"], $_POST["idClienteFK"]);

$objfactura->guardar();

echo $objfactura->getID_Factura();
echo $objfactura->getFecha();
echo $objfactura->getCantidad();    
echo $objfactura->getTotal();
echo $objfactura->getID_ProductoFK();
echo $objfactura->getID_ClienteFK();

?>