<?php

require_once ("conexion.php");
class categoria {
    private $ID_Categoria;
    private $NombreCategoria;
    private $DescripcionCat;
    
    const TABLA = 'categorias';

    // Constructor
    public function __construct($NombreCategoria, $DescripcionCat, $ID_Categoria=null) {
        $this->ID_Categoria = $ID_Categoria;
        $this->NombreCategoria = $NombreCategoria;
        $this->DescripcionCat = $DescripcionCat;
    }

    // Getters
    public function getID_Categoria() {
        return $this->ID_Categoria;
    }

    public function getNombreCategoria() {
        return $this->NombreCategoria;
    }

    public function getDescripcionCat() {
        return $this->DescripcionCat;
    }

    // Setters
    public function setID_Categoria($ID_Categoria) {
        $this->ID_Categoria = $ID_Categoria;
    }

    public function setNombreCategoria($NombreCategoria) {
        $this->NombreCategoria = $NombreCategoria;
    }

    public function setDescripcionCat($DescripcionCat) {
        $this->DescripcionCat = $DescripcionCat;
    }

    public function guardar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('INSERT INTO categorias (NombreCategoria, DescripcionCat)VALUES (:NombreCategoria, :DescripcionCat )');
        try{
           $consulta -> bindParam(':NombreCategoria', $this->NombreCategoria);
           $consulta -> bindParam(':DescripcionCat', $this->DescripcionCat);
           $consulta->execute();
           $this->ID_Categoria = $conexion->lastInsertId();
           echo "categoria guardado con éxito";
       } catch (PDOException $e) {
           echo "Ha surgio un error y no se pudo guardar el proveedor. Detalle: ". $e->getMessage();
       }
        }

    
     public static function mostrar(){
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT ID_Categoria,NombreCategoria,DescripcionCat FROM ' . self::TABLA . ' ORDER BY ID_Categoria');
            $consulta -> execute();
            $registros = $consulta->fetchAll();
            return $registros;

    }
    public function actualizar(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('UPDATE categorias SET NombreCategoria = :NombreCategoria,
         DescripcionCat = :DescripcionCat WHERE ID_Categoria = :ID_Categoria');
        try {
            $consulta->bindParam(':ID_Categoria', $this->ID_Categoria);
            $consulta->bindParam(':NombreCategoria', $this->NombreCategoria);
            $consulta->bindParam(':DescripcionCat', $this->DescripcionCat);
            $consulta->execute();
           
            return "Categoría actualizada con éxito";
        } catch (PDOException $e) {
            
            return "Error al actualizar la categoría. Detalle: " . $e->getMessage();
        }
    }


    public function eliminar()
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('DELETE FROM ' . self::TABLA . ' WHERE ID_Categoria = :ID_Categoria');

        try {
            $consulta->bindParam(':ID_Categoria', $this->ID_Categoria);
            $consulta->execute();

            return "Categoría eliminada con éxito";
        } catch (PDOException $e) {
            return "Error al eliminar la categoría. Detalle: " . $e->getMessage();
        }
    }

    public static function obtenerCategoriaPorID($idCategoria)
    {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT NombreCategoria, DescripcionCat FROM ' . self::TABLA . ' WHERE ID_Categoria = :ID_Categoria');
        $consulta->bindParam(':ID_Categoria', $idCategoria);
        $consulta->execute();
        $categoria = $consulta->fetch(PDO::FETCH_ASSOC);
        $conexion = null;

        return $categoria;
    }

    public static function verificarProductosAsociados($idCategoria)
{
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT COUNT(*) FROM productos WHERE ID_CategoriaFK = :ID_CategoriaFK');
    $consulta->bindParam(':ID_CategoriaFK', $idCategoria);
    $consulta->execute();
    $cantidadProductos = $consulta->fetchColumn();
    $conexion = null;

    return ($cantidadProductos > 0);
}


}

?>