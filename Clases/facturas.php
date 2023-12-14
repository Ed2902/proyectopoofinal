<?php

require_once ("conexion.php");
class Factura {
    private $ID_Factura;
    private $Fecha;
    private $Cantidad;
    private $Total;
    private $ID_ProductoFK;
    private $ID_ClienteFK;

    const TABLA = 'facturas';

    // Constructor
    public function __construct($idFactura, $fecha, $cantidad, $total, $idProductoFK, $idClienteFK) {
        $this->ID_Factura = $idFactura;
        $this->Fecha = $fecha;
        $this->Cantidad = $cantidad;
        $this->Total = $total;
        $this->ID_ProductoFK = $idProductoFK;
        $this->ID_ClienteFK = $idClienteFK;
    }

    // Métodos Get
    public function getID_Factura() {
        return $this->ID_Factura;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function getCantidad() {
        return $this->Cantidad;
    }

    public function getTotal() {
        return $this->Total;
    }

    public function getID_ProductoFK() {
        return $this->ID_ProductoFK;
    }

    public function getID_ClienteFK() {
        return $this->ID_ClienteFK;
    }

    // Métodos Set
    public function setID_Factura($idFactura) {
        $this->ID_Factura = $idFactura;
    }

    public function setFecha($fecha) {
        $this->Fecha = $fecha;
    }

    public function setCantidad($cantidad) {
        $this->Cantidad = $cantidad;
    }

    public function setTotal($total) {
        $this->Total = $total;
    }

    public function setID_ProductoFK($idProductoFK) {
        $this->ID_ProductoFK = $idProductoFK;
    }

    public function setID_ClienteFK($idClienteFK) {
        $this->ID_ClienteFK = $idClienteFK;
    }

    public function guardar(){
        
            $conexion = new Conexion();
            $consulta = $conexion->prepare('INSERT INTO facturas (ID_Factura, Fecha, Cantidad, Total, ID_ProductoFK, ID_ClienteFK)
            VALUES (:ID_Factura, :Fecha, :Cantidad, :Total, :ID_ProductoFK, :ID_ClienteFK)');

            try {
            $consulta -> bindParam(':ID_Factura', $this->ID_Factura);
            $consulta -> bindParam(':Fecha', $this->Fecha);
            $consulta -> bindParam(':Cantidad', $this->Cantidad);
            $consulta -> bindParam(':Total', $this->Total);
            $consulta -> bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
            $consulta -> bindParam(':ID_ClienteFK', $this->ID_ClienteFK);
            $consulta -> execute(); 
           
            

             echo "Proveedor guardado con éxito";
            } catch (PDOException $e) {
                echo "Ha surgio un error y no se pudo guardar el proveedor. Detalle: ". $e->getMessage();
            }
    }

    public static function mostrar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Factura, Fecha, Cantidad, Total, ID_ProductoFK, ID_ClienteFK 
        FROM ' . self::TABLA . ' ORDER BY ID_Factura');
        $consulta -> execute();
        $registros = $consulta->fetchAll();
        return $registros;

    }
    public function actualizar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET Fecha = :Fecha, Cantidad = :Cantidad, Total = :Total, ID_ProductoFK = :ID_ProductoFK, ID_ClienteFK = :ID_ClienteFK WHERE ID_Factura = :ID_Factura');

        $consulta->bindParam(':ID_Factura', $this->ID_Factura);
        $consulta->bindParam(':Fecha', $this->Fecha);
        $consulta->bindParam(':Cantidad', $this->Cantidad);
        $consulta->bindParam(':Total', $this->Total);
        $consulta->bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
        $consulta->bindParam(':ID_ClienteFK', $this->ID_ClienteFK);

        try {
            $consulta->execute();
            return "Factura actualizada con éxito";
        } catch (PDOException $e) {
            return "Error al actualizar la factura. Detalle: " . $e->getMessage();
    }
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Factura = :ID_Factura');

        try {
            $consulta->bindParam(':ID_Factura', $this->ID_Factura);
            $consulta->execute();

            return "Factura eliminada con éxito";
        } catch (PDOException $e) {
            return "Error al eliminar la factura. Detalle: " . $e->getMessage();
        }
    }

    public static function obtenerFacturaPorID($ID_Factura)
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Factura, Fecha, Cantidad, Total, ID_ProductoFK, ID_ClienteFK FROM ' . self::TABLA . ' WHERE ID_Factura = :ID_Factura');
        $consulta->bindParam(':ID_Factura', $ID_Factura);
        $consulta->execute();
        $factura = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;

        return $factura;
    }

}
