<?php
require_once "../Clases/historicomodificacion.php";

if (isset($_GET['id'])) {
    $ID_Historico = $_GET['id'];

    // Obtén los datos del historial de modificación que deseas eliminar
    $historicoDatos = HistoricoModificacion::obtenerHistoricoPorID($ID_Historico);

    if ($historicoDatos) {
        // Crea una instancia de HistoricoModificacion con los datos obtenidos
        $historico = new HistoricoModificacion(
            $historicoDatos['Fecha'],
            $historicoDatos['Detalles'],
            $historicoDatos['ID_ProductoFK'],
            $historicoDatos['ID_UsuarioFK'],
            $ID_Historico
        );

        // Intenta eliminar el registro
        $mensaje = $historico->eliminar();

        echo $mensaje;
    } else {
        echo "No se encontró el registro con el ID proporcionado.";
    }
} else {
    echo "ID de historial no proporcionado.";
}
?>
