<?php

require_once("conexion.php");

class HistoricoModificacion
{
    private $ID_Historico;
    private $Fecha;
    private $Detalles;
    private $ID_ProductoFK;
    private $ID_UsuarioFK;

    const TABLA = 'historicomodificacion';

    // Constructor
    public function __construct($Fecha, $Detalles, $ID_ProductoFK, $ID_UsuarioFK, $ID_Historico = null)
    {
        $this->Fecha = $Fecha;
        $this->Detalles = $Detalles;
        $this->ID_ProductoFK = $ID_ProductoFK;
        $this->ID_UsuarioFK = $ID_UsuarioFK;
        $this->ID_Historico = $ID_Historico;
    }

    // Getters
    public function getFecha()
    {
        return $this->Fecha;
    }

    public function getDetalles()
    {
        return $this->Detalles;
    }

    public function getID_ProductoFK()
    {
        return $this->ID_ProductoFK;
    }

    public function getID_UsuarioFK()
    {
        return $this->ID_UsuarioFK;
    }

    public function getID_Historico()
    {
        return $this->ID_Historico;
    }

    // Setters
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    public function setDetalles($Detalles)
    {
        $this->Detalles = $Detalles;
    }

    public function setID_ProductoFK($ID_ProductoFK)
    {
        $this->ID_ProductoFK = $ID_ProductoFK;
    }

    public function setID_UsuarioFK($ID_UsuarioFK)
    {
        $this->ID_UsuarioFK = $ID_UsuarioFK;
    }

    // The unnecessary setID_Historico method has been removed.

    public function guardar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA . ' (Fecha, Detalles, ID_ProductoFK, ID_UsuarioFK) VALUES (:Fecha, :Detalles, :ID_ProductoFK, :ID_UsuarioFK)');
        try {
            $consulta->bindParam(':Fecha', $this->Fecha);
            $consulta->bindParam(':Detalles', $this->Detalles);
            $consulta->bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
            $consulta->bindParam(':ID_UsuarioFK', $this->ID_UsuarioFK);
            $consulta->execute();
            $this->ID_Historico = $conexion->lastInsertId();
            echo "Registro guardado con éxito";
        } catch (PDOException $e) {
            echo "Ha surgido un error y no se pudo guardar el registro. Detalle: " . $e->getMessage();
        }
    }

    public static function mostrar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Historico, Fecha, Detalles, ID_ProductoFK, ID_UsuarioFK FROM ' . self::TABLA . ' ORDER BY ID_Historico');
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET Fecha = :Fecha, Detalles = :Detalles, ID_ProductoFK = :ID_ProductoFK, ID_UsuarioFK = :ID_UsuarioFK WHERE ID_Historico = :ID_Historico');

        $consulta->bindParam(':ID_Historico', $this->ID_Historico);
        $consulta->bindParam(':Fecha', $this->Fecha);
        $consulta->bindParam(':Detalles', $this->Detalles);
        $consulta->bindParam(':ID_ProductoFK', $this->ID_ProductoFK);
        $consulta->bindParam(':ID_UsuarioFK', $this->ID_UsuarioFK);

        try {
            $consulta->execute();
            return "Registro actualizado con éxito";
        } catch (PDOException $e) {
            return "Error al actualizar el registro. Detalle: " . $e->getMessage();
        }
    }
    public function eliminar()
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Historico = :ID_Historico');

    try {
        $consulta->bindParam(':ID_Historico', $this->ID_Historico);
        $consulta->execute();

        return "Registro eliminado con éxito";
    } catch (PDOException $e) {
        return "Error al eliminar el registro. Detalle: " . $e->getMessage();
    }
}

public static function obtenerHistoricoPorID($ID_Historico)
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT ID_Historico, Fecha, Detalles, ID_ProductoFK, ID_UsuarioFK FROM ' . self::TABLA . ' WHERE ID_Historico = :ID_Historico');
    $consulta->bindParam(':ID_Historico', $ID_Historico);
    $consulta->execute();
    $historico = $consulta->fetch(PDO::FETCH_ASSOC);
    $conexion = null;

    return $historico;
}
}










