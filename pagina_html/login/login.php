<?php
// Iniciar la sesión
session_start();

// Verificar si se han enviado datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar las credenciales en la base de datos
    $con = new mysqli("localhost", "root", "", "realstate");

    // Adaptar la consulta a tu estructura de base de datos
    $consulta = "SELECT * FROM tblusuarios WHERE Nombres = '$usuario' AND Contraseña = '$contrasena'";
    $resultado = $con->query($consulta);

    if ($resultado->num_rows > 0) {
        // Inicio de sesión exitoso, almacenar el rol en la sesión
        $usuario = $resultado->fetch_assoc();
        $_SESSION['rol'] = $usuario['rol'];  // Change 'Rol' to 'rol'

        // Redirigir según el rol
        if ($_SESSION['rol'] == 'administrador') {
            header("Location: ../entrar_admin.php");
        } else {
            header("Location: ../entrar_usuario.php");
        }
        exit();
        
    } else {
        // Credenciales incorrectas, redirigir o mostrar mensaje de error
        echo '<script>alert("Credenciales incorrectas.");</script>';
    }

    // Cerrar la conexión
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <!-- link de boostrap de css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
    <style>
        /* Estilos generales para resetear el diseño */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos para el cuerpo de la página */
        body {
            font-family: arial, "lato", sans-serif;
            background-image: url('imge/imagenblanca.jpg');
            background-size: cover;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        img {
            border: 1px ; /* Puedes ajustar el grosor y el color del borde según tus preferencias */
            border-radius: 1px; /* Añade esquinas redondeadas al borde */
            max-width: 50%; /* Asegura que la imagen no sobrepase el ancho del contenedor */
            height: auto; /* Ajusta automáticamente la altura según el ancho */
            display: block; /* Elimina el espacio extra debajo de la imagen */
            margin: 0 auto; /* Centra la imagen en el contenedor */
            border-radius: 50% 5px;
        }

        /* Estilos para el contenedor principal */
        .containere {
            width: 400px;
            height: 610px;
            background-color: rgba(233, 238, 244, 0.877);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px; /* Radio de borde para esquinas redondeadas */
            box-shadow: 3px 3px 5px; /* Sombra */
        }

        .login-btn {
            margin: 10px auto;
            padding: 8px 92px;
            background-image: linear-gradient(to left, rgb(95, 95, 244), rgb(51, 210, 242)); /* Gradiente de fondo */
            backdrop-filter: blur(5px); /* Aplica un desenfoque al botón */
            border-radius: 40px;
            text-decoration: none;
            color: #224bdd;
            text-transform: capitalize;
        }

        /* estilo de boton */
        .boton{
            width: 100%;
            background-image: linear-gradient(to left, rgb(95, 95, 244), rgb(51, 210, 242)); /* Gradiente de fondo */
        }

        /* Estilos para el encabezado de bienvenida */
        .welcome-heading {
            font-size: 1.1rem;
            text-align: center;
            text-transform: capitalize;
            color: rgb(91, 129, 241);
        }

        /* Estilos para los campos de entrada */
        .input-box, .input-box1 {
            width: 220px;
            height: 30px;
            margin: 10px auto;
            border-radius: 40px;
            outline: none;
            border: none;
            padding-left: 10px;
            box-shadow: 10px 10px 13px;
        }

        /* Estilos para el enlace de "volver" */
        .forget-password {
            margin: 10px auto;
            text-decoration: none;
            font-weight: bold;
        }

        /* Estilos para el enlace "Register now" */
        .register-now {
            text-decoration: none;
            margin-top: 10px;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <imgi  src="imge/gotas.jpg " alt="">

    <div class="containere">
        <!-- Imagen del logotipo -->
        <img src="imagen/LOGO JF cuadro.png" alt=""><br>

        <!-- Encabezado de bienvenida -->
        <h2 class="welcome-heading"> INICIAR SESION
            <span class="dkp-heading"></span>
        </h2>
        
        <!-- Formulario de inicio de sesión -->
        <form action="" method="POST">
            <!-- Campo de entrada para el nombre de usuario -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" name="usuario" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <!-- Campo de entrada para la contraseña -->
            <div class="input-group mb-3">
                <span class="input-group-text icono" id="togglePassword">
                    <i class="fa fa-eye"></i>
                </span>
                <input type="password" name="contrasena" class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1" id="password">
            </div>
            <!-- Botón de inicio de sesión -->
            <center><button type="submit" class="btn btn-primary  boton">ENTRAR</button></center>
        </form>

        <!-- Contenedor de los enlaces adicionales -->
        <div class="links-container box">
            <!-- Enlace para recuperar contraseña -->
            <a href="login2.php" class="forget-password">Recuperar contraseña</a>
            <br>
            <!-- Enlace para registrar una nueva cuenta -->
            <a href="crear_cuenta.php" class="register-now">Crear Cuenta</a>
        </div>
    </div>
    </div>

    <!-- link de javascrip de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
        // Toggle visibility of password
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
    </script>
</body>
</html>
