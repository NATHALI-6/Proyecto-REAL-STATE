<?php
// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Validar los datos recibidos (por ejemplo, comprobar si el correo es válido)

    // Conectar a la base de datos (cambia los valores según tu configuración)
    $con = new mysqli("localhost", "root", "", "tu_base_de_datos");

    // Verificar la conexión
    if ($con->connect_error) {
        die("La conexión falló: " . $con->connect_error);
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, telefono, correo, contrasena) VALUES ('$nombre', '$apellido', '$telefono', '$correo', '$contrasena')";

    if ($con->query($sql) === TRUE) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar el usuario: " . $con->error;
    }

    // Cerrar la conexión
    $con->close();
}
?>
