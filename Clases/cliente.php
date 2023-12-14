<?php

require_once ("conexion.php");
class Cliente {
    private $ID_Cliente;
    private $NombreCli;
    private $DireccionCli;
    private $Telefono;
    //private $estado;
    const TABLA = 'clientes';

    // Constructor
    public function __construct($ID_Cliente, $NombreCli, $DireccionCli, $Telefono,) {
        $this->ID_Cliente = $ID_Cliente;
        $this->NombreCli = $NombreCli;
        $this->DireccionCli = $DireccionCli;
        $this->Telefono = $Telefono;
        //$this->estado = $estado;
    }

    // Getters y Setters

    
    public function getIdCliente() {
        return $this->ID_Cliente;
    }

    public function setIdCliente($ID_Cliente) {
        $this->ID_Cliente = $ID_Cliente;
    }

    public function getNombre() {
        return $this->NombreCli;
    }

    public function setNombre($NombreCli) {
        $this->NombreCli = $NombreCli;
    }

    public function getDireccion() {
        return $this->DireccionCli;
    }

    public function setDireccion($DireccionCli) {
        $this->DireccionCli = $DireccionCli;
    }


    public function getTelefono() {
        return $this->Telefono;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    //public function getEstado() {
       /// return $this->estado;
    //}

    //public function setEstado($estado) {
        //$this->estado = $estado;
    //}

    public function guardar(){
        {
            $conexion = new Conexion();
            $consulta = $conexion->prepare('INSERT INTO ' .self::TABLA .'(ID_Cliente, NombreCli, DireccionCli, Telefono)VALUES (:ID_Cliente, :NombreCli, :DireccionCli, :Telefono )');
            $consulta -> bindParam(':ID_Cliente', $this->ID_Cliente);
            $consulta -> bindParam(':NombreCli', $this->NombreCli);
            $consulta -> bindParam(':DireccionCli', $this->DireccionCli);
            $consulta -> bindParam(':Telefono', $this->Telefono);
            $consulta -> execute();
            
        }
    }
    public static function mostrar(){
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT ID_Cliente,NombreCli,DireccionCli,Telefono FROM ' . self::TABLA . ' ORDER BY NombreCli');
            $consulta -> execute();
            $registros = $consulta->fetchAll();
            return $registros;

    }

    public function actualizar() {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET NombreCli = :NombreCli, DireccionCli = :DireccionCli, Telefono = :Telefono WHERE ID_Cliente = :ID_Cliente');
        
        $consulta->bindParam(':ID_Cliente', $this->ID_Cliente);
        $consulta->bindParam(':NombreCli', $this->NombreCli);
        $consulta->bindParam(':DireccionCli', $this->DireccionCli);
        $consulta->bindParam(':Telefono', $this->Telefono);

        try {
            $consulta->execute();
            return "Cliente actualizado con éxito";
        } catch (PDOException $e) {
            return "Error al actualizar el cliente. Detalle: " . $e->getMessage();
        }

    }
    public function eliminar()
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Cliente = :ID_Cliente');

    try {
        $consulta->bindParam(':ID_Cliente', $this->ID_Cliente);
        $consulta->execute();

        return "Cliente eliminado con éxito";
    } catch (PDOException $e) {
        return "Error al eliminar el cliente. Detalle: " . $e->getMessage();
    }
}

public static function obtenerClientePorID($ID_Cliente)
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT ID_Cliente, NombreCli, DireccionCli, Telefono FROM ' . self::TABLA . ' WHERE ID_Cliente = :ID_Cliente');
    $consulta->bindParam(':ID_Cliente', $ID_Cliente);
    $consulta->execute();
    $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
    $conexion = null;

    return $cliente;
}

public static function mostrarClientes()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Cliente, NombreCli, DireccionCli, Telefono FROM ' . self::TABLA . ' ORDER BY NombreCli');
        $consulta->execute();
        $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $conexion = null;

        return $clientes;
    }

    

}