<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar a la base de datos y realizar la lógica de guardar
    $inmuebleId = isset($_POST['IdInmueble']) ? $_POST['IdInmueble'] : null;

    // Aquí deberías realizar la lógica de guardar en tu base de datos
    // (insertar el inmueble en la tabla de inmuebles guardados, por ejemplo).

    // Redirigir a la página de inmuebles guardados
    header('Location: guardados_usuario.php');
    exit();
} else {
    // Si no es una solicitud POST, muestra el inmueble guardado (puedes personalizar según tu estructura de base de datos)

    // Reemplaza con tu propia información de conexión
    include 'conexion.php';

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    // Obtener información del inmueble guardado desde la base de datos
    $inmuebleId = isset($_POST['IdInmueble']) ? $_POST['IdInmueble'] : null;

    if ($inmuebleId !== null) {
        $sql = "SELECT * FROM TBLInmueble WHERE ID = $inmuebleId";

        $result = $con->query($sql);

        // Verificar si se obtuvieron resultados
        if ($result && $result->num_rows > 0) {
            $inmueble = $result->fetch_assoc();

            // Muestra la información del inmueble
            echo '<h1>Inmueble Guardado</h1>';
            echo '<img src="http://localhost/login/crudinmuebles/' . $inmueble['Imagen'] . '" alt="Imagen de Inmueble">';
            echo '<p>Precio: $' . number_format($inmueble['Precio']) . ' COP</p>';
            // Muestra otros detalles del inmueble según tu estructura de base de datos
            // ...

        } else {
            echo '<p>No se encontró el inmueble.</p>';
        }
    } else {
        echo '<p>No se recibió el ID del inmueble correctamente.</p>';
    }

    // Cerrar la conexión a la base de datos
    $con->close();
}
?>
