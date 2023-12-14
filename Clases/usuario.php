<?php

require_once ("conexion.php");
class usuario {
    private $ID_Usuario;
    private $NombreUsuario;
    private $Contrasena;
    private $ID_RolFK;

    //private $estado;
    const TABLA = 'usuarios';

    // Constructor
    public function __construct($NombreUsuario, $Contrasena, $ID_RolFK, $ID_Usuario=null) {
        $this->ID_Usuario = $ID_Usuario;
        $this->NombreUsuario = $NombreUsuario;
        $this->Contrasena = $Contrasena;
        $this->ID_RolFK = $ID_RolFK;
        //$this->estado = $estado;
    }

    // Getters y Setters

    
    public function getID_Usuario() {
        return $this->ID_Usuario;
    }

    public function setIdCliente($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    public function getNombreUsuario() {
        return $this->NombreUsuario;
    }

    public function setNombreUsuario($NombreUsuario) {
        $this->NombreUsuario = $NombreUsuario;
    }

    public function getContrasena() {
        return $this->Contrasena;
    }

    public function setContrasena($Contrasena) {
        $this->Contrasena = $Contrasena;
    }


    public function getID_RolFK() {
        return $this->ID_RolFK;
    }

    public function setID_RolFK($ID_RolFK) {
        $this->ID_RolFK = $ID_RolFK;
    }

    //public function getEstado() {
       /// return $this->estado;
    //}

    //public function setEstado($estado) {
        //$this->estado = $estado;
    //}

    public function guardar(){
        
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO usuarios ( NombreUsuario, Contrasena, ID_RolFK) VALUES ( :NombreUsuario, :Contrasena, :ID_RolFK)');

        // Relacionar los parámetros de la consulta con las variables correspondientes
        try {
        $consulta -> bindParam(':NombreUsuario', $this->NombreUsuario);
        $consulta -> bindParam(':Contrasena', $this->Contrasena);
        $consulta -> bindParam(':ID_RolFK', $this->ID_RolFK);
        $consulta -> execute();
        $this->ID_Usuario = $conexion->lastInsertId();
        echo "Proveedor guardado con éxito";
    } catch (PDOException $e) {
        echo "Ha surgio un error y no se pudo guardar el proveedor. Detalle: ". $e->getMessage();
    }
    
    }
    
    public static function mostrar(){
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT *  FROM ' . self::TABLA . ' ORDER BY NombreUsuario');
            $consulta -> execute();
            $registros = $consulta->fetchAll();
            return $registros;

    }
    public function actualizar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET NombreUsuario=:NombreUsuario, Contrasena=:Contrasena, ID_RolFK=:ID_RolFK WHERE ID_Usuario=:ID_Usuario');
    
        try {
            $consulta->bindParam(':NombreUsuario', $this->NombreUsuario);
            $consulta->bindParam(':Contrasena', $this->Contrasena);
            $consulta->bindParam(':ID_RolFK', $this->ID_RolFK);
            $consulta->bindParam(':ID_Usuario', $this->ID_Usuario);
            $consulta->execute();
            echo "Usuario actualizado con éxito";
        } catch (PDOException $e) {
            echo "Ha surgido un error y no se pudo actualizar el usuario. Detalle: " . $e->getMessage();
        }
    }

    public function eliminar()
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Usuario = :ID_Usuario');

    try {
        $consulta->bindParam(':ID_Usuario', $this->ID_Usuario);
        $consulta->execute();

        return "Usuario eliminado con éxito";
    } catch (PDOException $e) {
        return "Error al eliminar el usuario. Detalle: " . $e->getMessage();
    }
}

public static function obtenerUsuarioPorID($ID_Usuario)
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE ID_Usuario = :ID_Usuario');
    $consulta->bindParam(':ID_Usuario', $ID_Usuario);
    $consulta->execute();
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    $conexion = null;

    return $usuario;
}







}
