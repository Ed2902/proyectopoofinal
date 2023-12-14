<?php
require_once("conexion.php");
require_once("../PHPMailer-master/src/PHPMailer.php");
require_once("../PHPMailer-master/src/SMTP.php");
require_once("../PHPMailer-master/src/Exception.php"); // Agrega la importación de Exception
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; // Agrega esta línea

class Proveedor {
    private $ID_Proveedor;
    private $NombreProv;
    private $DireccionProv;
    private $Telefono;
    private $Correo;
    const TABLA = 'proveedores';

    public function __construct($ID_Proveedor, $NombreProv, $DireccionProv, $Correo, $Telefono) {
        $this->ID_Proveedor = $ID_Proveedor;
        $this->NombreProv = $NombreProv;
        $this->DireccionProv = $DireccionProv;
        $this->Correo = $Correo;
        $this->Telefono = $Telefono;
    }

    public function getidProveedor() {
        return $this->ID_Proveedor;
    }

    public function setidProveedor($ID_Proveedor) {
        $this->ID_Proveedor = $ID_Proveedor;
    }

    public function getNombreProv() {
        return $this->NombreProv;
    }

    public function setNombreProv($NombreProv) {
        $this->NombreProv = $NombreProv;
    }

    public function getDireccionProv() {
        return $this->DireccionProv;
    }

    public function setDireccionProv($DireccionProv) {
        $this->DireccionProv = $DireccionProv;
    }

    public function getCorreo() {
        return $this->Correo;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function getTelefonos() {
        return $this->Telefono;
    }

    public function setTelefonos($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO proveedores (ID_Proveedor, NombreProv, DireccionProv, Telefono, Correo) VALUES (:ID_Proveedor, :NombreProv, :DireccionProv, :Telefono, :Correo)');

        try {
            $consulta->bindParam(':ID_Proveedor', $this->ID_Proveedor);
            $consulta->bindParam(':NombreProv', $this->NombreProv);
            $consulta->bindParam(':DireccionProv', $this->DireccionProv);
            $consulta->bindParam(':Telefono', $this->Telefono);
            $consulta->bindParam(':Correo', $this->Correo);
            $consulta->execute();

            // Enviar correo electrónico con PHPMailer
            $mail = new PHPMailer   ();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'danicaama08@gmail.com'; // Coloca tu dirección de correo Gmail
            $mail->Password = 'Liz27082003'; // Coloca tu contraseña Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('danicaama08@gmail.com', 'Daniela Caamaño');
            $mail->addAddress($this->Correo, $this->NombreProv);

            $mail->Subject = 'Registro de Proveedor';
            $mail->Body = 'Hola bienvenido' . $this->NombreProv . ', tu proveedor ha sido registrado correctamente.';

            if ($mail->send()) {
                echo "Proveedor guardado con éxito y correo enviado";
            } else {
                echo "Error al enviar el correo. Detalle: " . $mail->ErrorInfo;
            }
        } catch (PDOException $e) {
            echo "Ha surgido un error y no se pudo guardar el proveedor. Detalle: " . $e->getMessage();
        }
    
    }
    public static function mostrar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Proveedor ,NombreProv ,DireccionProv ,Telefono ,Correo FROM ' . self::TABLA . ' ORDER BY NombreProv');
        $consulta -> execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public function actualizar() {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET NombreProv = :NombreProv, DireccionProv = :DireccionProv, Telefono = :Telefono, Correo = :Correo WHERE ID_Proveedor = :ID_Proveedor');
        
        $consulta->bindParam(':ID_Proveedor', $this->ID_Proveedor);
        $consulta->bindParam(':NombreProv', $this->NombreProv);
        $consulta->bindParam(':DireccionProv', $this->DireccionProv);
        $consulta->bindParam(':Telefono', $this->Telefono);
        $consulta->bindParam(':Correo', $this->Correo);

        try {
            $consulta->execute();
            return "Proveedor actualizado con éxito";
        } catch (PDOException $e) {
            return "Error al actualizar el proveedor. Detalle: " . $e->getMessage();
        }
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Proveedor = :ID_Proveedor');

        try {
            $consulta->bindParam(':ID_Proveedor', $this->ID_Proveedor);
            $consulta->execute();

            return "Proveedor eliminado con éxito";
        } catch (PDOException $e) {
            return "Error al eliminar el proveedor. Detalle: " . $e->getMessage();
        }
    }

    public static function obtenerProveedorPorID($ID_Proveedor)
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT ID_Proveedor, NombreProv, DireccionProv, Telefono, Correo FROM ' . self::TABLA . ' WHERE ID_Proveedor = :ID_Proveedor');
        $consulta->bindParam(':ID_Proveedor', $ID_Proveedor);
        $consulta->execute();
        $proveedor = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;

        return $proveedor;
    }

}





?>