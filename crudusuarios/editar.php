<?php
include 'conexion.php';

// Definir variables para almacenar los valores actuales
$idEditar = '';
$nombresEditar = '';
$correoEditar = '';
$contrasenaEditar = '';
$rolEditar = '';

// Verificar si se ha proporcionado un ID para editar
if (isset($_GET['id'])) {
    $idEditar = mysqli_real_escape_string($con, $_GET['id']);

    // Consultar la base de datos para obtener los datos actuales del usuario
    $consultaEditar = "SELECT * FROM TblUsuarios WHERE IdUsuarios = '$idEditar'";
    $resultadoEditar = $con->query($consultaEditar);

    if ($resultadoEditar->num_rows == 1) {
        $filaEditar = $resultadoEditar->fetch_assoc();
        $nombresEditar = $filaEditar['Nombres'];
        $correoEditar = $filaEditar['Correo'];
        // No recuperamos la contraseña por razones de seguridad
        $rolEditar = $filaEditar['rol'];
    } else {
        // El ID proporcionado no es válido
        echo '<div class="alert alert-danger" role="alert">El usuario no existe.</div>';
        exit();
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = mysqli_real_escape_string($con, $_POST['nombres']);
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($con, $_POST['contrasena']);
    $rol = ($_POST['rol'] === 'administrador') ? 'administrador' : 'usuario';

    // Verificar si la contraseña está vacía, si es así, no la actualizamos
    $contrasenaActualizar = !empty($contrasena) ? ", Contraseña = '$contrasena'" : '';

    $consultaActualizar = "UPDATE TblUsuarios SET Nombres = '$nombres', Correo = '$correo'$contrasenaActualizar, rol = '$rol' WHERE IdUsuarios = '$idEditar'";

    if ($con->query($consultaActualizar)) {
        echo '<div class="alert alert-success mt-4" role="alert">Usuario actualizado correctamente.</div>';
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">Error al actualizar el usuario: ' . $con->error . '</div>';
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../codigo_css/style2.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Usuario</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $nombresEditar; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correoEditar; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="administrador" <?php echo ($rolEditar === 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="usuario" <?php echo ($rolEditar === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
            <a class="btn btn-primary" href="../crudusuarios/index.php">Ir a la página principal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
