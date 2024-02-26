<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se ha enviado una ruta de imagen
    if (isset($_POST['imagen'])) {
        $rutaImagen = $_POST['imagen'];

        // Elimina la entrada correspondiente de la base de datos
        $consultaEliminar = "DELETE FROM imagenesinmuebles WHERE RutaImagen = '$rutaImagen'";
        
        // Agrega esta línea para imprimir la consulta de eliminación
        echo "Consulta de eliminación: $consultaEliminar";

        if (mysqli_query($con, $consultaEliminar)) {
            echo 'Imagen eliminada correctamente de la base de datos.';
        } else {
            echo 'Error al eliminar la imagen de la base de datos: ' . mysqli_error($con);
        }
    } else {
        echo 'No se proporcionó una ruta de imagen válida.';
    }
} else {
    echo 'Acceso denegado.';
}
?>