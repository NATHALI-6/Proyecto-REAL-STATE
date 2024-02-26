<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
     <!-- Agrega los enlaces a Bootstrap CSS y JS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-kmK5I3Fo5w5f5krZ5R5u1Cqz5pRbAUO9RkPrqer2fFt5f5z5D5F5f5f5f5f5f5f5f5" crossorigin="anonymous"></script>
    <!-- http://localhost/crudrealstate/delete.php  -->
</head>
<body>
    <?php
    include 'conexion.php';

    // Verifica si se ha enviado un ID válido a través de la URL
    if (isset($_GET['id'])) {
        $idCita = $_GET['id'];

        // Realiza la eliminación en la base de datos
        $eliminar = "DELETE FROM TBLCita WHERE IdCita = $idCita";

        if (mysqli_query($con, $eliminar)) {
            echo '<div class="alert alert-success" role="alert">Registro eliminado correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al eliminar el registro: ' . mysqli_error($con) . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">ID de cita no proporcionado.</div>';
    }
    ?>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Eliminar Cita</h1>
        <a href="index.php" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>
