<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

if (isset($_POST['crear'])) {
    // Obtiene los valores enviados desde el formulario
    $idCita = $_POST['doc'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $telefono = $_POST['telefono'];
    $categoriaId = $_POST['categoria'];
    $inmuebleId = $_POST['inmueble']; // Nuevo campo para el ID del inmueble

    // Realiza la inserción en la tabla TBLCita
    $insercion = "INSERT INTO TBLCita (IdCita, Dirección, Fecha, Telefono, codigoc, infoinmueble) VALUES ('$idCita', '$direccion', '$fecha', '$telefono', '$categoriaId', $inmuebleId)";
    if (mysqli_query($con, $insercion)) {
        echo '<script>alert("Registro creado exitosamente.");</script>';
    } else {
        echo '<script>alert("Error al crear el registro: ' . mysqli_error($con) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Crear Registro</title>
    <!-- http://localhost/crudrealstate/create.php  -->
</head>
</head>
<body>
    
    <h1 class="text-center mt-4 mb-4">REGISTRO DE CITAS REAL STATE</h1>

    <div class="container">
        <div class="row">
            <div class="col-a">
                <h2>REGISTRAR CITAS</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6 offset-3">
                <form action="create.php" method="post">
                    <div class="mb-3">
                        <label for="doc" class="form-label">ID de Cita</label>
                        <input type="number" class="form-control" name="doc" placeholder="Digita el ID de la cita" required>
                    </div>
                    <div>
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Digita la dirección" required>
                    </div>
                    <br>
                    <div>
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="fecha" placeholder="Ingresa la fecha" required>
                    </div>
                    <br>
                    <div>
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" name="telefono" placeholder="Digita el número de teléfono" required>
                    </div>
                    <br>
                    <div>
                        <label for="inmueble" class="form-label">Seleccionar Inmueble</label>
                        <select class="form-control" name="inmueble" required>
                            <option value="" disabled selected>Selecciona un inmueble</option>
                            <?php
                            $consultaInmuebles = "SELECT IdInmueble, Dirección FROM TBLInmueble";
                            $inmuebles = mysqli_query($con, $consultaInmuebles) or die("Problemas con el consulta de inmuebles" . mysqli_error($con));

                            while ($inmueble = mysqli_fetch_array($inmuebles)) {
                                echo '<option value="' . $inmueble['IdInmueble'] . '">' . $inmueble['IdInmueble'] . ' - ' . $inmueble['Dirección'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br><br>
                    <div class="form-check">
                        <?php
                        $registros = mysqli_query($con, "SELECT IdCategoria, Nombres FROM TBLCategoria") or die("Problemas con el select" . mysqli_error($con));
                        while ($reg = mysqli_fetch_array($registros)) {
                            echo '<input class="form-check-input" type="radio" name="categoria" value="' . $reg['IdCategoria'] . '" id="categoria_' . $reg['IdCategoria'] . '">';
                            echo '<label class="form-check-label" for="categoria_' . $reg['IdCategoria'] . '">' . $reg['Nombres'] . '</label><br>';
                        }
                        ?>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-success w-100" name="crear">ADICIONAR</button>
                </form>
                <a href="index.php" class="btn btn-primary mt-3">Volver</a>
            </div>
        </div>
    </div>
    
</body>
</html>
