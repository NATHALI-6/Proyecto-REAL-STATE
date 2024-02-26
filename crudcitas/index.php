<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Citas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- estilos unicos -->
    <link rel="stylesheet" href="realstate/estilos.css">

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
    <?php
    include 'conexion.php';

    // Consulta de los datos 
    $consulta = "SELECT TBLCita.IdCita, TBLCita.Dirección, TBLCita.Fecha, TBLCita.Telefono, TBLCategoria.Nombres,TBLInmueble.IdInmueble
                 FROM TBLCita 
                 INNER JOIN TBLCategoria ON TBLCita.codigoc = TBLCategoria.IdCategoria
                 INNER JOIN TBLInmueble ON TBLCita.infoinmueble = TBLInmueble.IdInmueble";

    $registro = mysqli_query($con, $consulta) or die("Problemas en el select:" . mysqli_error($con));
    ?>

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
                            <a class="nav-link active" aria-current="page" href="../pagina_html/entrar_admin.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white"
                                    href="../crudusuarios/index.php">Añadir Usuarios
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

    <!-- Titulo  -->
    <div class="container">
        <div class="row text-center">
            <h1>REGISTRO DE CITAS | INMOBILIARIA JF</h1>
        </div>
    </div>
    <!-- fin del Titulo -->

    <div class="container">
        <div class="text-center mb-3">
            <a href="create.php" class="btn btn-success">Agregar Registro</a>
        </div>

        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID CITA</th>
                    <th>DIRECCIÓN</th>
                    <th>FECHA</th>
                    <th>TELÉFONO</th>
                    <th>CATEGORÍA</th>
                    <th>INMUEBLE</th>
                    <th colspan="2" text>
                        <center>Opciones</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Para mostrar los registros en la tabla
                while ($reg = mysqli_fetch_array($registro)) {
                    echo '<tr>
                <td>' . $reg['IdCita'] . '</td>
                <td>' . $reg['Dirección'] . '</td>
                <td>' . $reg['Fecha'] . '</td>
                <td>' . $reg['Telefono'] . '</td>
                <td>' . $reg['Nombres'] . '</td>
                <td style="text-align: center;">' . $reg['IdInmueble'] . '</td>
                <td class="text-center">
                    <a href="editar.php?id=' . $reg['IdCita'] . '" class="btn btn-primary">Editar</a>
                    <a href="delete.php?id=' . $reg['IdCita'] . '" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>';
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>