<?php
include 'conexion.php';

$mensaje = '';

if (isset($_GET['id'])) {
    $idInmueble = $_GET['id'];

    $consulta = "SELECT * FROM TBLInmueble WHERE IdInmueble = $idInmueble";
    $resultado = mysqli_query($con, $consulta);

    if (mysqli_num_rows($resultado) === 1) {
        $inmueble = mysqli_fetch_assoc($resultado);
    } else {
        echo '<div class="alert alert-danger" role="alert">Inmueble no encontrado.</div>';
        exit;
    }
} else {
    echo '<div class="alert alert-danger" role="alert">ID de inmueble no proporcionado.</div>';
    exit;
}

if (isset($_POST['actualizar'])) {
    // Procesar las imágenes
    if (isset($_FILES['imagenes']['name']) && is_array($_FILES['imagenes']['name'])) {
        $uploadDirectory = 'imagenes/';

        foreach ($_FILES['imagenes']['name'] as $key => $name) {
            if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
                $uniqueName = uniqid('img_') . '_' . time() . '.' . $fileExtension;
                $uploadPath = $uploadDirectory . $uniqueName;

                if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$key], $uploadPath)) {
                    $rutaImagen = $uploadPath;
                    $sql = "INSERT INTO imagenesinmuebles (IdInmueble, RutaImagen) VALUES ('$idInmueble', '$rutaImagen')";
                    if (!mysqli_query($con, $sql)) {
                        $mensaje .= 'Error al guardar la ruta de la imagen en la base de datos: ' . mysqli_error($con) . '<br>';
                    }
                } else {
                    $mensaje .= 'Error al mover el archivo cargado.<br>';
                }
            }
        }
    }


    // Actualizar el inmueble
    $precio_actualizado = isset($_POST['Precio']) ? $_POST['Precio'] : '';
    $localidad_actualizada = isset($_POST['localidad']) ? $_POST['localidad'] : '';
    $direccion_actualizada = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $estrato_actualizado = isset($_POST['estrato']) ? $_POST['estrato'] : '';
    $areaConstruida_actualizada = isset($_POST['Area_construida']) ? $_POST['Area_construida'] : '';
    $numBaños_actualizados = isset($_POST['N_baños']) ? $_POST['N_baños'] : '';
    $numHabitaciones_actualizadas = isset($_POST['N_habitaciones']) ? $_POST['N_habitaciones'] : '';
    $numPisos_actualizados = isset($_POST['N_pisos']) ? $_POST['N_pisos'] : '';
    $categoria_actualizada = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $contacto_actualizado = isset($_POST['Contacto']) ? $_POST['Contacto'] : '';
    $numCocinas_actualizadas = isset($_POST['N_cocinas']) ? $_POST['N_cocinas'] : '';
    $numGarajes_actualizados = isset($_POST['Garaje']) ? $_POST['Garaje'] : '';
    $numPatios_actualizados = isset($_POST['Patio']) ? $_POST['Patio'] : '';
    $numEstudios_actualizados = isset($_POST['Estudio']) ? $_POST['Estudio'] : '';


    $actualizar = "UPDATE TBLInmueble 
    SET Precio = '$precio_actualizado',
        Localidad = '$localidad_actualizada', 
        Dirección = '$direccion_actualizada', 
        Estrato = '$estrato_actualizado', 
        Area_construida = '$areaConstruida_actualizada', 
        Baños = '$numBaños_actualizados', 
        Habitaciones = '$numHabitaciones_actualizadas', 
        NumeroPisos = '$numPisos_actualizados', 
        codigoc = '$categoria_actualizada',
        Contacto = '$contacto_actualizado',
        Cocina = '$numCocinas_actualizadas',
        Garaje = '$numGarajes_actualizados',
        Patio = '$numPatios_actualizados',
        Estudio = '$numEstudios_actualizados'
    WHERE IdInmueble = $idInmueble";

    if (mysqli_query($con, $actualizar)) {
        $mensaje = '<div class="alert alert-success" role="alert">Inmueble actualizado correctamente.</div>';
    } else {
        $mensaje = '<div class="alert alert-danger" role="alert">Error al actualizar el inmueble: ' . mysqli_error($con) . '</div>';
    }
}

$consultaImagenes = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble";
$resultadoImagenes = mysqli_query($con, $consultaImagenes);
$imagenes = array();

if (mysqli_num_rows($resultadoImagenes) > 0) {
    while ($filaImagen = mysqli_fetch_assoc($resultadoImagenes)) {
        $imagenes[] = $filaImagen['RutaImagen'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['nuevas_imagenes']) && !empty($_FILES['nuevas_imagenes']['name'][0])) {
        $totalNuevasImagenes = count($_FILES['nuevas_imagenes']['name']);
        $imagenesGuardadas = 0;

        for ($i = 0; $i < $totalNuevasImagenes; $i++) {
            $nombreArchivo = $_FILES['nuevas_imagenes']['name'][$i];
            $tempFile = $_FILES['nuevas_imagenes']['tmp_name'][$i];
            $rutaDestino = 'imagenes/' . $nombreArchivo;

            if (move_uploaded_file($tempFile, $rutaDestino)) {
                $insertarImagen = "INSERT INTO imagenesinmuebles (IdInmueble, RutaImagen) VALUES ('$idInmueble', '$rutaDestino')";
                if (mysqli_query($con, $insertarImagen)) {
                    $imagenesGuardadas++;
                } else {
                    echo 'Error al guardar la imagen en la base de datos.';
                }
            } else {
                echo 'Error al mover la imagen cargada.';
            }
        }

        if ($imagenesGuardadas > 0) {
            echo 'Nuevas imágenes guardadas correctamente.';
        }
    } else {
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inmueble</title>
    <!-- Agrega los enlaces a Bootstrap CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-kmK5I3Fo5w5f5krZ5R5u1Cqz5pRbAUO9RkPrqer2fFt5f5z5D5F5f5f5f5f5f5f5f5" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../codigo_css/createimg.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Editar Inmueble</h1>
        <?php echo $mensaje; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imagenes" class="form-label">Imágenes del inmueble:</label>
                <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple id="imagenes">
                <small class="text-muted"><?php echo count($imagenes); ?> imágenes seleccionadas</small>

                <div id="image-preview" class="image-preview">
                    <?php foreach ($imagenes as $imagen): ?>
                        <div class="img-wrapper">
                            <img src="<?php echo $imagen; ?>" alt="Imagen" class="img-thumbnail">
                            <button type="button" class="btn-close delete-btn" aria-label="Close"></button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Agrega el resto de tus campos de formulario aquí -->

            <script>
        document.getElementById('imagenes').addEventListener('change', function(event) {
            var files = event.target.files;
            var preview = document.getElementById('image-preview');

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('img-wrapper');

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Imagen';
                    img.classList.add('img-thumbnail');

                    var closeButton = document.createElement('button');
                    closeButton.type = 'button';
                    closeButton.classList.add('btn-close', 'delete-btn');
                    closeButton.setAttribute('aria-label', 'Close');

                    closeButton.addEventListener('click', function() {
                        this.parentNode.remove();
                    });

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(closeButton);
                    preview.appendChild(imgWrapper);
                };

                reader.readAsDataURL(files[i]);
            }
        });
    </script>



           <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="Precio" value="<?php echo $inmueble['Precio']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" name="localidad" value="<?php echo $inmueble['Localidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $inmueble['Dirección']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="estrato" class="form-label">Estrato</label>
                <input type="number" class="form-control" name="estrato" value="<?php echo $inmueble['Estrato']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Area_construida" class="form-label">Área Construida</label>
                <input type="text" class="form-control" name="Area_construida" value="<?php echo $inmueble['Area_construida']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="N_baños" class="form-label">Número de Baños</label>
                <input type="number" class="form-control" name="N_baños" value="<?php echo $inmueble['Baños']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="N_habitaciones" class="form-label">Número de Habitaciones</label>
                <input type="number" class="form-control" name="N_habitaciones" value="<?php echo $inmueble['Habitaciones']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="N_pisos" class="form-label">Número de Pisos</label>
                <input type="number" class="form-control" name="N_pisos" value="<?php echo $inmueble['NumeroPisos']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Contacto" class="form-label">Contacto</label>
                <input type="text" class="form-control" name="Contacto" value="<?php echo $inmueble['Contacto']; ?>" required>
            </div>
            <!-- Agregar campos faltantes -->
            <div class="mb-3">
                <label for="N_cocinas" class="form-label">Número de Cocinas</label>
                <input type="number" class="form-control" name="N_cocinas" value="<?php echo $inmueble['Cocina']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Garaje" class="form-label">Garaje</label>
                <input type="number" class="form-control" name="Garaje" value="<?php echo $inmueble['Garaje']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Patio" class="form-label">Patio</label>
                <input type="number" class="form-control" name="Patio" value="<?php echo $inmueble['Patio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Estudio" class="form-label">Estudio</label>
                <input type="number" class="form-control" name="Estudio" value="<?php echo $inmueble['Estudio']; ?>" required>
            </div>

            <div class="form-check">
                <?php
                $categorias = mysqli_query($con, "SELECT IdCategoria, Nombres FROM TBLCategoria") or die("Problemas con el select" . mysqli_error($con));
                while ($cat = mysqli_fetch_array($categorias)) {
                    $isChecked = ($cat['IdCategoria'] == $inmueble['codigoc']) ? 'checked' : '';
                    echo '<input class="form-check-input" type="radio" name="categoria" value="' . $cat['IdCategoria'] . '" id="categoria_' . $cat['IdCategoria'] . '" ' . $isChecked . '>';
                    echo '<label class="form-check-label" for="categoria_' . $cat['IdCategoria'] . '">' . $cat['Nombres'] . '</label><br>';
                }
                ?>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary" name="actualizar">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </form>
            
    </div>
    </div>

           
   

   
</body>
</html>
