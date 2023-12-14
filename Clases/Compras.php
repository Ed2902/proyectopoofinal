<?php

require_once("conexion.php");

class Compras
{
    private $ID_DetalleCompra;
    private $CantidadCompra;
    private $Precio_Compra;
    private $Precio_Venta;
    private $ID_ProductoFK;
    private $ID_ProveedorFK;
    const TABLA = 'DetalleCompras';

    // Getters y Setters
    public function getId()
    {
        return $this->ID_DetalleCompra;
    }

    public function setId($ID_DetalleCompra)
    {
        $this->ID_DetalleCompra = $ID_DetalleCompra;
    }

    public function getCantidadCompra()
    {
        return $this->CantidadCompra;
    }

    public function setCantidadCompra($CantidadCompra)
    {
        $this->CantidadCompra = $CantidadCompra;
    }

    public function getPrecio_Compra()
    {
        return $this->Precio_Compra;
    }

    public function setPrecio_Compra($Precio_Compra)
    {
        $this->Precio_Compra = $Precio_Compra;
    }

    public function getPrecio_Venta()
    {
        return $this->Precio_Venta;
    }

    public function setPrecio_Venta($Precio_Venta)
    {
        $this->Precio_Venta = $Precio_Venta;
    }

    public function getID_ProductoFK()
    {
        return $this->ID_ProductoFK;
    }

    public function setID_ProductoFK($ID_ProductoFK)
    {
        $this->ID_ProductoFK = $ID_ProductoFK;
    }

    public function getID_ProveedorFK()
    {
        return $this->ID_ProveedorFK;
    }

    public function setID_ProveedorFK($ID_ProveedorFK)
    {
        $this->ID_ProveedorFK = $ID_ProveedorFK;
    }

    // Constructor
    public function __construct($CantidadCompra, $Precio_Compra, $Precio_Venta, $ID_ProductoFK, $ID_ProveedorFK, $ID_DetalleCompra = null)
    {
        $this->ID_DetalleCompra = $ID_DetalleCompra;
        $this->CantidadCompra = $CantidadCompra;
        $this->Precio_Compra = $Precio_Compra;
        $this->Precio_Venta = $Precio_Venta;
        $this->ID_ProductoFK = $ID_ProductoFK;
        $this->ID_ProveedorFK = $ID_ProveedorFK;
    }

    public function guardarCompra()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA . '(CantidadCompra, Precio_Compra, Precio_Venta, ID_ProductoFK, ID_ProveedorFK, ID_DetalleCompra) VALUES (:CantidadCompra, :Precio_Compra, :Precio_Venta, :ID_ProductoFK, :ID_ProveedorFK, :ID_DetalleCompra)');
        $consulta->bindParam(':CantidadCompra', $this->CantidadCompra);
        $consulta->bindParam(':Precio_Compra', $this->Precio_Compra);
        $consulta->bindParam(':Precio_Venta', $this->Precio_Venta);
        $consulta->bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
        $consulta->bindParam(':ID_ProveedorFK', $this->ID_ProveedorFK);
        $consulta->bindParam(':ID_DetalleCompra', $this->ID_DetalleCompra);
        $consulta->execute();
        $this->ID_DetalleCompra = $conexion->lastInsertId();
        $conexion = null;
    }

    public static function mostrarCompras()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_DetalleCompra, CantidadCompra, Precio_Compra, Precio_Venta, ID_ProductoFK, ID_ProveedorFK  FROM ' . self::TABLA . ' ORDER BY CantidadCompra');
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET CantidadCompra = :CantidadCompra, Precio_Compra = :Precio_Compra, Precio_Venta = :Precio_Venta, ID_ProductoFK = :ID_ProductoFK WHERE ID_DetalleCompra = :ID_DetalleCompra');
        
        try {
            $consulta->bindParam(':CantidadCompra', $this->CantidadCompra);
            $consulta->bindParam(':Precio_Compra', $this->Precio_Compra);
            $consulta->bindParam(':Precio_Venta', $this->Precio_Venta);
            $consulta->bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
            $consulta->bindParam(':ID_DetalleCompra', $this->ID_DetalleCompra);
            $consulta->execute();

            return "Compra actualizada con éxito";
        } catch (PDOException $e) {
            return "Error al actualizar la compra. Detalle: " . $e->getMessage();
        }
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_DetalleCompra = :ID_DetalleCompra');

        try {
            $consulta->bindParam(':ID_DetalleCompra', $this->ID_DetalleCompra);
            $consulta->execute();

            return "Compra eliminada con éxito";
        } catch (PDOException $e) {
            return "Error al eliminar la compra. Detalle: " . $e->getMessage();
        }
    }

    public static function obtenerDetalleCompraPorID($idDetalleCompra)
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT CantidadCompra, Precio_Compra, Precio_Venta, ID_ProductoFK, ID_ProveedorFK FROM ' . self::TABLA . ' WHERE ID_DetalleCompra = :ID_DetalleCompra');
        $consulta->bindParam(':ID_DetalleCompra', $idDetalleCompra);
        $consulta->execute();
        $detalleCompra = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;

        return $detalleCompra;
    }
}

?>
