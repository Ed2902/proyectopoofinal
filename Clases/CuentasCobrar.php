<?php

require_once ("conexion.php");

class CuentasCobrar {
    private $ID_Cuenta;
    private $Monto_Debido;
    private $Fecha_Limite;
    private $ID_ClienteFK;
    const TABLA = 'cuentasporcobrar';

    public function __construct($Monto_Debido, $Fecha_Limite, $ID_ClienteFK, $ID_Cuenta=null) {
        $this->ID_Cuenta = $ID_Cuenta;
        $this->Monto_Debido = $Monto_Debido;
        $this->Fecha_Limite = $Fecha_Limite;
        $this->ID_ClienteFK = $ID_ClienteFK;
    }

    public function getID_Cuenta() {
        return $this->ID_Cuenta;
    }

    public function getMonto_Debido() {
        return $this->Monto_Debido;
    }

    public function getFecha_Limite() {
        return $this->Fecha_Limite;
    }

    public function getID_ClienteFK() {
        return $this->ID_ClienteFK;
    }

    public function setID_Cuenta($ID_Cuenta) {
        $this->ID_Cuenta = $ID_Cuenta;
    }

    public function setMonto_Debido($Monto_Debido) {
        $this->Monto_Debido = $Monto_Debido;
    }

    public function setFecha_Limite($Fecha_Limite) {
        $this->Fecha_Limite = $Fecha_Limite;
    }


    public function guardar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO cuentasporcobrar (Monto_Debido,Fecha_Limite,ID_ClienteFK)VALUES (:Monto_Debido, :Fecha_Limite, :ID_ClienteFK)');
        try{
           $consulta -> bindParam(':Monto_Debido', $this->Monto_Debido);
           $consulta -> bindParam(':Fecha_Limite', $this->Fecha_Limite);
           $consulta -> bindParam(':ID_ClienteFK', $this->ID_ClienteFK);
           $consulta->execute();
           $this->ID_Cuenta = $conexion->lastInsertId();
           echo "Cuenta guardada con éxito";
       } catch (PDOException $e) {
           echo "Ha surgio un error y no se pudo guardar el monto. Detalle: ". $e->getMessage();
       }
        }

     public static function mostrar(){
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT ID_Cuenta,Monto_Debe,Fecha_Limite FROM ' . self::TABLA . ' ORDER BY ID_Cuenta');
            $consulta -> execute();
            $registros = $consulta->fetchAll();
            return $registros;

    }
    
}