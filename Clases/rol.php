<?php

require_once ("conexion.php");
class rol {
    private $ID_Rol;
    private $NombreRol;
    private $DescripcionRol;
    
    const TABLA = 'roles';

    // Constructor
    public function __construct($NombreRol, $DescripcionRol, $ID_Rol=null) {
        $this->ID_Rol = $ID_Rol;
        $this->NombreRol = $NombreRol;
        $this->DescripcionRol = $DescripcionRol;
    }

    // Getters
    public function getID_Rol() {
        return $this->ID_Rol;
    }

    public function getNombreRol() {
        return $this->NombreRol;
    }

    public function getDescripcionRol() {
        return $this->DescripcionRol;
    }

    // Setters
    public function setID_Rol($ID_Rol) {
        $this->ID_Rol = $ID_Rol;
    }

    public function setNombreRol($NombreRol) {
        $this->NombreRol = $NombreRol;
    }

    public function setDescripcionRol($DescripcionRol) {
        $this->DescripcionRol = $DescripcionRol;
    }

    public function guardar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO roles (NombreRol,DescripcionRol)VALUES (:NombreRol, :DescripcionRol)');
        try{
           $consulta -> bindParam(':NombreRol', $this->NombreRol);
           $consulta -> bindParam(':DescripcionRol', $this->DescripcionRol);
           $consulta->execute();
           $this->ID_Rol = $conexion->lastInsertId();
           echo "Rol guardado con éxito";
       } catch (PDOException $e) {
           echo "Ha surgio un error y no se pudo guardar el Rol. Detalle: ". $e->getMessage();
       }
        }

     public static function mostrar(){
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT ID_Rol,NombreRol,DescripcionRol FROM ' . self::TABLA . ' ORDER BY ID_Rol');
            $consulta -> execute();
            $registros = $consulta->fetchAll();
            return $registros;

    }
    
}