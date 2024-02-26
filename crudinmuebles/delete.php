<?php
include 'conexion.php';

// Verificar si se ha enviado la petición de eliminación por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_inmueble'])) {
    $idInmueble = $_POST['id_inmueble'];

    // Asegúrate de que $idInmueble es un valor válido (puedes agregar más validaciones si es necesario)
    if (!is_numeric($idInmueble)) {
        echo "ID de inmueble no válido.";
        exit;
    }

    // Consulta SQL para eliminar los registros relacionados en imagenesinmuebles
    $sql_eliminar_imagenes = "DELETE FROM imagenesinmuebles WHERE IdInmueble = $idInmueble";

    // Consulta SQL para eliminar el inmueble por su ID
    $eliminar = "DELETE FROM TBLInmueble WHERE IdInmueble = $idInmueble";

    // Ejecutar la consulta para eliminar las imágenes
    if (mysqli_query($con, $sql_eliminar_imagenes)) {
        // Ejecutar la consulta para eliminar el inmueble
        if (mysqli_query($con, $eliminar)) {
            // Puedes mostrar un mensaje de éxito aquí si lo deseas
        } else {
            // Manejar errores durante la eliminación
            echo "Error al eliminar el inmueble: " . mysqli_error($con);
        }
    } else {
        // Manejar errores durante la eliminación de imágenes
        echo "Error al eliminar las imágenes del inmueble: " . mysqli_error($con);
    }
}

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit;
?>
