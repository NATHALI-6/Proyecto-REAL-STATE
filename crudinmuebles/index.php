<?php
include 'conexion.php';

// Verificar si se ha enviado la petición de eliminación por AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_inmueble'])) {
    $idInmueble = $_POST['id_inmueble'];

    // Consulta SQL para eliminar el inmueble por su ID
    $sql = "DELETE FROM TBLInmueble WHERE IdInmueble = $idInmueble";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
        exit;
    }
}
?>

<!-- contar el numero de inmuebles  -->
<?php
include 'conexion.php';

// Contar el número de registros en la tabla TBLInmueble
$consulta_contar = "SELECT COUNT(*) AS total FROM TBLInmueble";
$resultado_contar = mysqli_query($con, $consulta_contar);
$fila_contar = mysqli_fetch_assoc($resultado_contar);
$total_registros = $fila_contar['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Inmuebles</title>
    
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
</head>
<body>
    <?php
    include 'conexion.php';
    
    // Consulta de los datos de la tabla TBLInmueble
    $consulta = "SELECT TBLInmueble.IdInmueble,TBLInmueble.Precio, TBLInmueble.Localidad, TBLInmueble.Dirección, TBLInmueble.Estrato, TBLInmueble.Area_construida, TBLInmueble.NumeroPisos, TBLInmueble.Habitaciones, TBLInmueble.Baños,TBLInmueble.Cocina,TBLInmueble.Garaje,TBLInmueble.Patio,TBLInmueble.Estudio, TBLInmueble.Contacto, TBLCategoria.Nombres 
                 FROM TBLInmueble 
                 INNER JOIN TBLCategoria ON TBLInmueble.codigoc = TBLCategoria.IdCategoria";

    $registro = mysqli_query($con, $consulta) or die("Problemas en el select:" . mysqli_error($con));
    ?>

    <header>
        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <span> INMOBILIARIA JF </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../pagina_html/entrar_admin.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white"
                                    href="../crudusuarios/index.php">Añadir Usuarios
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white"
                                    href="../crudcitas/index.php">Añadir Cita
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-success "><a class="nav-link text-white"
                                    href="../crudinmuebles/index.php">Añadir Inmueble
                                    <i class="bi bi-plus-lg"></i></a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark "><a class="nav-link text-white"
                                    href="../pagina_html/inicio.html">Cerrar sesión</a></button>
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
            <h1>REGISTRO DE INMUEBLES | INMOBILIARIA JF</h1>
        </div>
    </div>
    <!-- fin del Titulo -->

    <div class="container-fluid">
        <div class="text-center mb-3">
            <a href="create.php" class="btn btn-success">Agregar Registro</a>
            <div class="col-md-auto">
                <p style="color: red;">Total de registros: <?php echo $total_registros; ?></p>
            </div>
        </div>
        

        <table class="table table-bordered table-striped text-center ">
            <thead>
                <tr>
                    <th>ID Inmueble</th>
                    <th>Imagenes</th>
                    <th>Precio</th>
                    <th>Localidad</th>
                    <th>Dirección</th>
                    <th>Estrato</th>
                    <th>Área Construida</th>
                    <th>Número de Pisos</th>
                    <th>Habitaciones</th>
                    <th>Baños</th>
                    <th>Cocina</th>
                    <th>Garaje</th>
                    <th>Patio</th>
                    <th>Estudio</th>
                    <th>Contacto</th>
                    <th>Categoría</th>
                    <th colspan="2" class="text-center">Opciones</th>
                    <th>Visualizacion</th>
                </tr>
            </thead>
            <tbody>
    <?php while ($reg = mysqli_fetch_array($registro)): ?>
        <tr>
            <td><?= $reg['IdInmueble'] ?></td>
            <td>
                <?php
                // Consulta para obtener la ruta de la primera imagen del inmueble
                $idInmueble = $reg['IdInmueble'];
                $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                $resultado_imagen = mysqli_query($con, $consulta_imagen);
                $row_imagen = mysqli_fetch_assoc($resultado_imagen);
                $ruta_imagen = $row_imagen['RutaImagen'];

                // Si se encontró una imagen, mostrar miniatura
                if ($ruta_imagen) {
                    echo '<img src="' . $ruta_imagen . '" alt="Miniatura" style="max-width: 100px; max-height: 100px;">';
                } else {
                    echo 'No hay imagen';
                }
                ?>
            </td>
            <td><?= '$'. $reg['Precio'] ?></td>
            <td><?= $reg['Localidad'] ?></td>
            <td><?= $reg['Dirección'] ?></td>
            <td><?= $reg['Estrato'] ?></td>
            <td><?= $reg['Area_construida'] ?></td>
            <td><?= $reg['NumeroPisos'] ?></td>
            <td><?= $reg['Habitaciones'] ?></td>
            <td><?= $reg['Baños'] ?></td>
            <td><?= $reg['Cocina'] ?></td>
            <td><?= $reg['Garaje']?></td>
            <td><?= $reg['Patio']?></td>
            <td><?= $reg['Estudio']?></td>
            <td><?= $reg['Contacto'] ?></td>
            <td><?= $reg['Nombres'] ?></td>
            <td>
                <a href="update.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
            <td>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $reg['IdInmueble'] ?>">
    <i class="bi bi-trash3"></i>
</button>

            </td>
            <td>
    <a href="interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-info">
        Ver Inmueble
    </a>
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