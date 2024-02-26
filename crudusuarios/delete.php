<?php
include 'conexion.php';

// Verificar si se ha enviado la petición de eliminación por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $idUsuario = $_POST['id_usuario'];

    // Asegúrate de que $idUsuario es un valor válido (puedes agregar más validaciones si es necesario)
    if (!is_numeric($idUsuario)) {
        echo "ID de usuario no válido.";
        exit;
    }

    // Consulta SQL para eliminar el usuario por su ID
    $eliminar = "DELETE FROM TblUsuarios WHERE IdUsuarios = $idUsuario";

    if (mysqli_query($con, $eliminar)) {
        // Puedes mostrar un mensaje de éxito aquí si lo deseas
    } else {
        // Manejar errores durante la eliminación
        echo "Error al eliminar el usuario: " . mysqli_error($con);
    }
}

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit;
?>
