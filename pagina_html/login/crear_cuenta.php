<?php
include '../conexion.php';

// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombres = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contraseña'];

    // Generar un ID único y aleatorio de 6 caracteres
    $id = substr(bin2hex(random_bytes(3)), 0, 6);

    // Verificar si el ID ya existe
    $verificar_id = "SELECT * FROM TblUsuarios WHERE IdUsuarios = '$id'";
    $resultado = $con->query($verificar_id);

    while ($resultado->num_rows > 0) {
        // Si el ID ya existe, genera uno nuevo
        $id = substr(bin2hex(random_bytes(3)), 0, 6);
        $resultado = $con->query("SELECT * FROM TblUsuarios WHERE IdUsuarios = '$id'");
    }

    // Consulta SQL para insertar el nuevo usuario con el ID generado
    $consulta = "INSERT INTO TblUsuarios (IdUsuarios, Nombres, Correo, Contraseña, rol) VALUES ('$id', '$nombres', '$correo', '$contrasena', 'usuario')";

    // Ejecutar la consulta
    if ($con->query($consulta)) {
        // Usuario registrado correctamente
        echo '<script>alert("Se ha registrado correctamente.");</script>';
    } else {
        // Error al registrar el usuario
        echo '<script>alert("Error al registrarse.");</script>';
    }
} 

// Cerrar la conexión
$con->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_login3.css">
    <!-- link de boostrap de css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="containero">
    <!-- Imagen del logo -->
    <img src="imagen/LOGO JF cuadro.png" alt="">
    
    <!-- Encabezado de bienvenida -->
    <br>
    <h2 class="welcome-heading"> CREAR CUENTA
        <span class="dkp-heading"></span>
    </h2>

    <!-- Contenedor de las casillas de entrada -->
    <div class="box">
        <span class="borderLine"></span>
        <!-- Formulario de registro -->
        <form action="" method="POST">
            <!-- Casilla de entrada para el nombre -->
            <div class="inputBox">
                <input type="text" name="nombre" placeholder="NOMBRES" required>
                <span>NOMBRES</span>
                <i></i>
            </div>
        
            <!-- Casilla de entrada para el correo -->
            <div class="inputBox">
                <input type="email" name="correo" placeholder="CORREO" required>
                <span>CORREO</span>
                <i></i>
            </div>
            <!-- Casilla de entrada para la contraseña -->
            <div class="inputBox">
                <input type="password" name="contraseña" placeholder="CONTRASEÑA" required>
                <span>CONTRASEÑA</span>
                <i></i>
            </div>
            <!-- Botón de crear cuenta -->
            <button type="submit" class="btn btn-primary boton">CREAR CUENTA</button>
        </form>
        <!-- Enlace para volver al inicio de sesión -->
        <div class="links">
            <a href="login.php" class="forget-password">volver</a>
        </div>
    </div>
</div>

<!-- link de javascrip de bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
