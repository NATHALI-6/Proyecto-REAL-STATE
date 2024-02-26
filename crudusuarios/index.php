<?php
include 'conexion.php';

// Consulta SQL para obtener todos los usuarios
$consulta = "SELECT * FROM TblUsuarios";
$resultado = $con->query($consulta);

?>
<!-- ------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Usuarios</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="realstate/estilos.css">
    <!-- http://localhost:4433/PAGINA_REALSTATE/crudinmuebles/index.php -->
    <!-- http://localhost/PAGINA_REALSTATE/crudinmuebles/index.php -->

</head>

<body>
    <header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <span> INMOBILIARIA JF </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../pagina_html/entrar_admin.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white" href="../crudusuarios/index.php">Añadir Usuarios
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white" href="../crudcitas/index.php">Añadir Cita
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white" href="../crudinmuebles/index.php">Añadir Inmueble
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark "><a class="nav-link text-white" href="../pagina_html/inicio.html">Cerrar sesión</a></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>



    <!-- fin del header -->

    <!-- Titulo  -->
    <div class="container">
        <div class="row text-center">
            <h1>REGISTRO DE USUARIOS | INMOBILIARIA JF</h1>
        </div>
    </div>
    </div>
    <br>
    <!-- boton de crear usuarios -->
    <div class="container">
        <div class="text-center mb-3">
            <a href="create.php" class="btn btn-success">Agregar Registro</a>
        </div>
        <!-- fin del boton -->

        <div class="container">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>ID USUARIO</th>
                        <th>NOMBRES</th>
                        <th>CORREO</th>
                        <th>CONTRASEÑA</th>
                        <th>ROL</th>
                        <th colspan="2" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $fila['IdUsuarios'] ?></td>
                            <td><?= $fila['Nombres'] ?></td>
                            <td><?= $fila['Correo'] ?></td>
                            <td><?= $fila['Contraseña'] ?></td>
                            <td><?= $fila['rol'] ?></td>
                            <td>
                                <a href="editar.php?id=<?= $fila['IdUsuarios'] ?>" class="btn btn-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $fila['IdUsuarios'] ?>">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                        <?php include('modaleliminar.php'); ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>



        <!-- Confirm Delete Modal -->

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>

        <!-- Link de Bootstrap javaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>