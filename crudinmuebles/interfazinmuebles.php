<?php
include 'conexion.php';

// Obtener el ID del inmueble desde la URL
$idInmueble = isset($_GET['id']) ? $_GET['id'] : null;

// Validar que se proporcionó un ID de inmueble válido
if (!$idInmueble) {
    echo 'ID de inmueble no válido.';
    exit;
}

// Consultar la información del inmueble por su ID
$consultaInmueble = "SELECT * FROM TBLInmueble WHERE IdInmueble = $idInmueble";
$resultado = mysqli_query($con, $consultaInmueble);

// Validar que se encontró el inmueble
if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo 'Inmueble no encontrado.';
    exit;
}

// Obtener los datos del inmueble
$datosInmueble = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Inmueble</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../codigo_css/pag.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">

    <!-- link de los estilos de la interfaz del inmueble -->
    <link rel="stylesheet" href="../codigo_css/styleinterfazin.css">
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
                        <a class="nav-link active" aria-current="page" href="../pagina_html/entrar.php">Inicio</a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="#ofertas-inmuebles">Inmuebles</a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="#sugerencias-caja-inmobiliaria">Sugerencias</a>
                    </li>
                    <li class="nav-item mr-1">
                        <a class="nav-link" href="#contacto-inmobiliaria">Contacto</a>
                    </li>
                    </li>
                        </li>
                        <li class="nav-item">
                        <button type="button" class="btn btn-dark" style="height:40px; padding: 0;">
                            <a class="nav-link" href="../pagina_html/login/login.php" style="color: inherit;">Iniciar session</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- fin de la barra de navegancion -->

<div class="container">
<?php
// Obtener el ID del inmueble desde la URL
$idInmueble = isset($_GET['id']) ? $_GET['id'] : null;


?>


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        // Consultar las imágenes del inmueble actual
        $consultaImagenes = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble";
        $resultadoImagenes = mysqli_query($con, $consultaImagenes);
        $numImagenes = mysqli_num_rows($resultadoImagenes);

        // Generar indicadores para cada imagen
        for ($i = 0; $i < $numImagenes; $i++) {
            $active = ($i == 0) ? 'active' : ''; // Marcar la primera imagen como activa
            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        // Mostrar cada imagen en el carrusel
        $contador = 0;
        while ($filaImagen = mysqli_fetch_assoc($resultadoImagenes)) {
            $active = ($contador == 0) ? 'active' : ''; // Marcar la primera imagen como activa
            echo '<div class="carousel-item ' . $active . '">';
            echo '<img src="' . $filaImagen['RutaImagen'] . '" class="d-block w-100" alt="Imagen ' . ($contador + 1) . '">';
            echo '</div>';
            $contador++;
        }
        ?>
    </div>
    <!-- Controles de navegación del carrusel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

    <div class="mt-4">
        <h3>Descripción del Inmueble</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro consectetur, explicabo nam nostrum cumque sed, pariatur enim quasi accusamus, rerum adipisci doloribus ullam possimus voluptatem iusto vitae ipsum sequi animi!
            Itaque dicta expedita eligendi deleniti. Rerum numquam odio eaque ad, voluptas cumque reiciendis quae incidunt eveniet repellat pariatur odit sed rem facere non dolorem laudantium quasi enim, ab nemo dolore!
            Aut, voluptates repudiandae nesciunt distinctio dicta porro aperiam iure sint ab delectus ipsum harum aperiam cum praesentium quidem magni magnam.</p>
    </div>

    <br><br><br><br>

    <!-- Mostrar los detalles del inmueble aquí -->
    <div>
        <h2>ID Inmueble: <?= $datosInmueble['IdInmueble'] ?></h2>
        <!-- Mostrar otros detalles del inmueble según sea necesario -->
        <p>Localidad: <?= $datosInmueble['Localidad'] ?></p>
        <p>Dirección: <?= $datosInmueble['Dirección'] ?></p>
        <p>Estrato: <?= $datosInmueble['Estrato'] ?></p>
    </div>

    <!-- Características del Inmueble -->
    <div class="columna row mt-12">
        <h3 class="infoinmu">Caracteristicas</h3>
        <div class="col-lg-6">
            <br>
            <div class="row">
                <!-- Estrato -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-stack"></i>
                        <p>Estrato: <?= $datosInmueble['Estrato'] ?></p>
                    </div>
                </div>

                <!-- Área construida -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-rulers"></i>
                        <p>Área construida: <?= $datosInmueble['Area_construida'] ?> m²</p>
                    </div>
                </div>

                <!-- Pisos -->
                <div class="col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-house-fill"></i>
                        <p>Pisos: <?= $datosInmueble['NumeroPisos'] ?></p>
                    </div>
                    <br><br>
                </div>

                <!-- Baños -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-droplet-half"></i>
                        <p>Baños: <?= $datosInmueble['Baños'] ?></p>
                    </div>
                </div>

                <!-- Habitaciones -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-house-fill"></i>
                        <p>Habitaciones: <?= $datosInmueble['Habitaciones'] ?></p>
                    </div>
                </div>

                <!-- Cocina -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-cookie"></i>
                        <p>Cocina: <?= $datosInmueble['Cocina'] ?></p>
                    </div>
                    <br><br>
                </div>

                <!-- Garaje -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-car-front-fill"></i>
                        <p>Garaje: <?= $datosInmueble['Garaje'] ?></p>
                    </div>
                </div>

                <!-- Patio -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-house-fill"></i>
                        <p>Patio: <?= $datosInmueble['Patio'] ?></p>
                    </div>
                </div>

                <!-- Estudio -->
                <div class="columna col-lg-4">
                    <div class="property-info-box">
                        <i class="bi bi-house-fill"></i>
                        <p>Estudio: <?= $datosInmueble['Estudio'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- aca comienza la parte de el precio de el inmueble  -->
    <div class="pre col-lg-6">
      <div class="price-contact-box">

        <h2 class="precio">Precio del Inmueble</h2>
        <p class="ubi">Desde (COP)</p>
        <h2 class="valor"> $ <?= $datosInmueble['Precio'] ?></h2>
        <h3>NEGOCIABLES</h3>
        <br>
        
        <h2 class="precio">¿Te interesa este Inmueble?</h2><br>
        <button type="button" class="btn btn-info">Quiero que me Contacten</button><br><br>
       <div><button type="button" class="btn btn-info">Contactar por whatsapp </button></div>
        
        
        <br>
        <p class="ubi">consulta con un acesor y nuestras redes abajo</p>
      
      </div>
    </div>
    </div>

    <!-- aca termina la seccion de lso iconos de las Caracteristicas de el inmueble -->

    
  </div>

</div>


<br><br>
 <!-- FOOTER -->
 <footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <!-- Sección de enlaces del footer -->
            <section class="mb-4 text-center">
                <h1 class="text-center text-footer">INMOBILIARIA JF</h1>
            </section>
            <hr>
            <!-- Sección de enlaces del footer -->


            <!-- Sección de contacto centrada -->
            <!-- seccion de la izquierda -->
            <section class="text-center container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase">DANOS TU OPINION</h5>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a class="btn btn-outline-dark btn-floating m-1" href="#!" role="button">
                            <i class="bi bi-instagram"></i>
                        </a>

                    </div>

                    <!-- seccion de el medio -->
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase" id="contacto-inmobiliaria">Contáctanos</h5>
                        <ul class="list-unstyled contact-list">
                            <li class="d-md-flex d-block align-items-center">
                                <i class="bi bi-envelope me-3"></i>
                                <span>Correo electrónico: info@inmobiliariajf.com</span>
                            </li>
                            <li class="d-md-flex d-block  align-items-center mr-5">
                                <i class="bi bi-phone me-3"></i>
                                <span>Teléfono: +123 456 789</span>
                            </li>
                        </ul>
                    </div>

                    <!-- seccion de la derecha -->
                    <div class="col-lg-4 col-md-12 mx-auto mb-5 mb-md-0">
                        <h5 class="text-uppercase">BUSCAR EN LA PAGINA</h5>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <button class="btn btn-info" type="button">
                                <i class="bi bi-search"></i> <!-- Ícono de búsqueda de Bootstrap -->
                            </button>
                        </div>
                    </div>


                </div>
            </section>





            <!-- Sección de contacto -->
        </div>

        <!-- Texto de derechos de autor -->
        <div class="bg-dark text-white p-3">
            <div class="container text-center">
                © 2023 Inmobiliaria JF
            </div>
        </div>
    </footer>


<!-- Link de Bootstrap javaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
