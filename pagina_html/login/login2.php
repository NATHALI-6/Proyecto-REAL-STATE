<?php
// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir correo electrónico del formulario
    $correo = $_POST['correo'];

    // Aquí puedes agregar la lógica para enviar el correo de recuperación
    // Por ejemplo, puedes enviar un correo con un enlace único para restablecer la contraseña

    // Redirigir al usuario a una página de confirmación o mostrar un mensaje
    echo '<script>alert("Se ha enviado un correo de recuperación.");</script>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLVIDO CONTRASEÑA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_login2.css">

    <!-- Enlace al CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    <imgi  src="imge/gotas.jpg " alt="">
    <div class="containeri">
        <!-- Logotipo -->
        <img src="imagen/LOGO JF cuadro.png" alt="">

        <!-- Encabezado de bienvenida -->
        <h2 class="welcome-heading"> RECUPERAR CONTRASEÑA
            <span class="dkp-heading"></span>
        </h2>        
        <div class="input-container">
            <br>
            <!-- Formulario de recuperación de contraseña -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <!-- Campo de entrada de correo electrónico -->
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="correo" placeholder="Correo electrónico" required>
                </div>
          
                <!-- Botón para enviar el correo de recuperación -->
                <center><button type="submit" class="btn btn-primary boton">Enviar</button></center>
            </form>
            <!-- Enlace para volver al inicio de sesión -->
            <center><a href="login.php" class="forget-password">Volver</a></center>
        </div>
    </div>
            
    <!-- Enlace al JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
