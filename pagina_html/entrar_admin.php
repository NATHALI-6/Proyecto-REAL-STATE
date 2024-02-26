<?php
include '../crudinmuebles/conexion.php';

// Consulta de los datos específicos de la tabla TBLInmueble
$consultaDatos = "SELECT  TBLInmueble.Precio, TBLInmueble.Localidad, TBLInmueble.Baños, TBLInmueble.Habitaciones, TBLInmueble.NumeroPisos
                  FROM TBLInmueble 
                  INNER JOIN TBLCategoria ON TBLInmueble.codigoc = TBLCategoria.IdCategoria";

// Verificar si se han enviado parámetros de búsqueda
if (isset($_GET['location']) || isset($_GET['price']) || isset($_GET['category'])) {
    $consultaDatos .= " WHERE 1"; // Iniciar la condición WHERE

    // Verificar si se ha seleccionado una ubicación
    if (isset($_GET['location']) && !empty($_GET['location'])) {
        // Filtrar por la ubicación seleccionada
        $ubicacion = mysqli_real_escape_string($con, $_GET['location']);
        $consultaDatos .= " AND TBLInmueble.Localidad LIKE '%$ubicacion%'";
    }

    // Verificar si se ha seleccionado un precio máximo
    if (isset($_GET['price']) && !empty($_GET['price'])) {
        // Filtrar por el precio máximo seleccionado
        $precioMaximo = mysqli_real_escape_string($con, $_GET['price']);
        $consultaDatos .= " AND TBLInmueble.Precio <= $precioMaximo";
    }

    // Filtrar por categoría si se proporciona
    if (isset($_GET['category'])) {
        $categoriaSeleccionada = mysqli_real_escape_string($con, $_GET['category']);
        $consultaDatos .= " AND TBLCategoria.Nombres = '{$categoriaSeleccionada}'";
    }
}

// Ejecutar la consulta
$resultadoInmuebles = mysqli_query($con, $consultaDatos) or die("Problemas en el select:" . mysqli_error($con));
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBILIARIA JF</title>
    <link rel="stylesheet" href="../codigo_css/pag.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- link de los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Google Fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">

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
                        <li class="nav-item mr-1">
                            <a class="nav-link" href="#ofertas-inmuebles">Inmuebles</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="nav-link" href="#sugerencias-caja-inmobiliaria">Sugerencias</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Añadir
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../crudusuarios/index.php">Añadir Usuarios</a></li>
                                <li><a class="dropdown-item" href="../crudcitas/index.php">Añadir Cita</a></li>
                                <li><a class="dropdown-item" href="../crudinmuebles/index.php">Añadir Inmueble</a></li>
                            </ul>
                        </li>


                        <li class="nav-item dropdown">
    <div class="nav-link dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../imagenes/LOGOJF.png" width="30" height="30" class="rounded-circle" alt="Logo de la página web"> <!-- Logo de la página web en un círculo -->
    </div>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
    <li> <a class="nav-link" href="../pagina_html/guardados_usuario.php">Mis Guardados</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="../pagina_html/login/login.php">
                Cerrar sesión
            </a>
        </li>
    </ul>
</li>

                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- fin de la barra de navegacion -->








    <!-- seccion de el Carrusel -->

    <section class="carrusel-casas" id="carouselExampleAutoplaying">
        <!--  container-fluid es para poner el carrusel en toda la pantalla de la pagina principal pero que deje un espacio a los lados  -->
        <div id="slider-casas" class="carousel slide" data-bs-ride="carousel">
            <!-- data-bs-ride="carousel" este es lo que hace que el carrusel se deslice automáticamente -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#slider-casas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#slider-casas" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <!-- primera imagen de el carrusel -->
                <div class="carousel-item active">
                    <img src="../imagenes/carrusel/imagencarrusel1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tu confianza es Nuestra prioridad</h5>
                        <p>Agradecemos que nos elijas</p>
                    </div>
                </div>
                <!-- segunda imagen de el carrusel -->
                <div class="carousel-item">
                    <img src="../imagenes/carrusel/imagencarrusel2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <!-- tercera imagen de el carrusel -->
                <div class="carousel-item">
                    <img src="../imagenes/carrusel/imagencarrusel3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
                <!-- cuarta imagen de el carrusel -->
                <div class="carousel-item">
                    <img src="../imagenes/carrusel/imagencarrusel4.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Fourth slide label</h5>
                        <p>Some representative placeholder content for the fourth slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slider-casas" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider-casas" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- fin de el Carrusel -->







    <!-- filtro para buscar inmuebles -->
    <?php
    include '../crudinmuebles/conexion.php';

    // Consulta para obtener localidades distintas
    $consultaLocalidades = "SELECT DISTINCT Localidad FROM TBLInmueble";
    $resultadoLocalidades = mysqli_query($con, $consultaLocalidades) or die("Problemas en la consulta de localidades:" . mysqli_error($con));

    // Consulta para obtener categorías
    $consultaCategorias = "SELECT * FROM TBLCategoria";
    $categorias = mysqli_query($con, $consultaCategorias) or die("Problemas en el select de categorías:" . mysqli_error($con));

    // Verifica si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Verifica si hay localidades disponibles
        if ($resultadoLocalidades->num_rows > 0) {
    ?>
            <section>
                <div class="container search">
                    <h2 class="text-center">Buscar Propiedades</h2>
                    <form action="" method="get" class="d-flex flex-wrap">
                        <div class="col-md-4 mb-3">
                            <label for="category">Categoría:</label>
                            <div class="input-group">
                                <select name="category" class="custom-select">
                                    <option value="">Todas</option>
                                    <?php
                                    while ($categoria = mysqli_fetch_assoc($categorias)) {
                                        echo '<option value="' . $categoria['Nombres'] . '">' . $categoria['Nombres'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="location">Ubicación:</label>
                            <div class="input-group">
                                <select name="location" class="custom-select">
                                    <option value="">Todas</option>
                                    <?php
                                    // Reiniciar el puntero del resultado de localidades
                                    mysqli_data_seek($resultadoLocalidades, 0);
                                    while ($localidad = mysqli_fetch_assoc($resultadoLocalidades)) {
                                        echo '<option value="' . $localidad['Localidad'] . '">' . $localidad['Localidad'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="price">Precio Máximo:</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>&nbsp;</label>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary flex-fill me-2">Buscar</button>
                                <button type="button" class="btn btn-secondary flex-fill" id="limpiarBtn">Limpiar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
    <?php
        } else {
            echo '<p>No hay localidades disponibles en la base de datos.</p>';
        }
    }
    ?>

    <script>
        // Función para redirigir a la página principal sin parámetros de búsqueda
        function limpiarFiltros() {
            window.location.href = 'entrar_admin.php';
        }

        // Asociar la función al evento de clic del botón Limpiar
        document.getElementById('limpiarBtn').addEventListener('click', limpiarFiltros);
    </script>




    <!-- Sección de resultados de búsqueda -->
    <section class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
            <?php
            // Verificar si se han enviado parámetros de búsqueda
            if (isset($_GET['location']) || isset($_GET['price']) || isset($_GET['category'])) {
                // Construir la consulta SQL base
                $query = "SELECT * FROM tblinmueble WHERE 1";

                // Verificar y agregar condiciones de filtrado según los parámetros recibidos
                if (isset($_GET['location']) && !empty($_GET['location'])) {
                    $localidad = $_GET['location'];
                    $query .= " AND Localidad = '$localidad'";
                }
                if (isset($_GET['price']) && !empty($_GET['price'])) {
                    $precio_maximo = $_GET['price'];
                    $query .= " AND Precio <= $precio_maximo";
                }
                if (isset($_GET['category']) && !empty($_GET['category'])) {
                    $categoria = $_GET['category'];
                    // Obtener el ID de la categoría
                    $consulta_categoria = "SELECT IdCategoria FROM tblcategoria WHERE Nombres = '$categoria'";
                    $resultado_categoria = mysqli_query($con, $consulta_categoria);

                    if ($row_categoria = mysqli_fetch_assoc($resultado_categoria)) {
                        $id_categoria = $row_categoria['IdCategoria'];
                        $query .= " AND codigoc = $id_categoria";
                    } else {
                        // La categoría no existe, manejar este caso según tu lógica de aplicación
                    }
                }

                // Ejecutar la consulta SQL
                $resultadoInmuebles = mysqli_query($con, $query);

                if ($resultadoInmuebles->num_rows > 0) {
                    while ($reg = $resultadoInmuebles->fetch_assoc()) {
                        // Consultar la ruta de la imagen del inmueble
                        $idInmueble = $reg['IdInmueble'];
                        $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                        $resultado_imagen = mysqli_query($con, $consulta_imagen);
                        $ruta_imagen = "";

                        if ($row_imagen = mysqli_fetch_assoc($resultado_imagen)) {
                            $ruta_imagen = $row_imagen['RutaImagen'];
                        }

            ?>
                        <div class="col">
                            <div class="card h-100">
                                <!-- Mostrar la imagen dentro de la tarjeta -->
                                <img src="http://localhost:8081/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Imagen de Inmueble" style="max-width: 100%; max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP <i class="bi bi-bookmark ms-auto "></i> </h5>
                                    <p class="card-text">
                                        <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                        <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                        <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                                    </p>
                                    <p class="card-text"><?= $reg['Localidad']; ?></p>
                                    <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo '<p class="text-center">No se encontraron resultados.</p>';
                }
            }
            ?>
        </div>
    </section>



    <!-- Resto de tu código HTML -->

    <!-- fin de la seccion de filtro para buscar inmueble -->

    <!-- inicio de la seccion de la informacion de la mision de la inmobiliaria -->
    <section class="info">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 pt-4 pt-lg-0 order-1 order-lg-1 content text-center" data-aos="fade-left">
                    <img src="../imagenes/informacion.jpg" class="img-fluid" alt="Imagen Informativa">
                </div>
                <div class="col-lg-6 order-2 order-lg-2 text-center" data-aos="fade-right">
                    <h3 class="mb-4 tipo-letra">Descubre lo que Inmobiliaria JF te ofrece</h3>
                    <p>
                        Inmobiliaria JF te va a proporcionar la mejor experiencia al buscar tu hogar ideal. Nuestro
                        equipo está dedicado a ofrecer información detallada de las propiedades para que tomes
                        decisiones informadas. Explora una amplia variedad de propiedades que se adaptan a tus
                        necesidades y facilita el proceso de contacto para que puedas obtener más detalles y explorar
                        las opciones disponibles.
                    </p>
                    <ul class="list-unstyled mt-3 d-flex flex-column contact-list-2">
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle me-3"></i>
                            <span>Obtén información detallada de las propiedades</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle me-3"></i>
                            <span>Explora una amplia variedad de propiedades</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle me-3"></i>
                            <span>Facilita el proceso de contacto</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </section>


    <!-- fin de la seccion de info de la mision de la inmobiliaria -->

    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->


    <br>
    <!-- aca comienza la seccion de las tarejetas que muestran algunas casas en oferta y su informacion -->
    <br>
    <section class="container" id="tarjetasSection">
        <div class="text-center">
            <h1 id="ofertas-inmuebles" class="tipo-letra">OFERTAS DE INMUEBLES</h1>
            <hr class="mx-auto" style="width: 21%;">
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 container justify-content-center">
            <?php
            // Consulta para obtener los resultados de la base de datos
            $resultadoInmuebles = mysqli_query($con, "SELECT * FROM tblinmueble") or die("Problemas con el select" . mysqli_error($con));

            if ($resultadoInmuebles->num_rows > 0) {
                while ($reg = $resultadoInmuebles->fetch_assoc()) {
                    // Consulta para obtener la ruta de la imagen del inmueble
                    $idInmueble = $reg['IdInmueble'];
                    $consulta_imagen = "SELECT RutaImagen FROM imagenesinmuebles WHERE IdInmueble = $idInmueble LIMIT 1";
                    $resultado_imagen = mysqli_query($con, $consulta_imagen);

                    // Verifica si se encontró la imagen
                    if ($row_imagen = mysqli_fetch_assoc($resultado_imagen)) {
                        $ruta_imagen = $row_imagen['RutaImagen'];
            ?>
                        <div class="col">
                            <div class="card h-100">
                                <!-- Mostrar la miniatura de la imagen dentro de la tarjeta -->
                                <img src="http://localhost:8081/login/crudinmuebles/<?= $ruta_imagen ?>" alt="Miniatura de Inmueble" style="max-width: 100%; max-height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP <i class="bi bi-bookmark ms-auto "></i></h5>
                                    <p class="card-text">
                                        <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                        <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                        <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                                    </p>
                                    <p class="card-text"><?= $reg['Localidad']; ?></p>
                                    <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        // Si no se encontró la imagen, muestra un mensaje de error o una imagen de marcador de posición
                    ?>
                        <div class="col">
                            <div class="card h-100">
                                <!-- Mostrar una imagen de marcador de posición o un mensaje de error -->
                                <p class="text-center">No hay imagen disponible</p>
                                <div class="card-body">
                                    <h5 class="card-title">$<?= number_format($reg['Precio']); ?> COP <i class="bi bi-bookmark ms-auto "></i></h5>
                                    <p class="card-text">
                                        <?= isset($reg['Habitaciones']) ? $reg['Habitaciones'] . ' Habitaciones - ' : '' ?>
                                        <?= isset($reg['Baños']) ? $reg['Baños'] . ' Baños - ' : '' ?>
                                        <?= isset($reg['NumeroPisos']) ? $reg['NumeroPisos'] . ' Pisos' : '' ?>
                                    </p>
                                    <p class="card-text"><?= $reg['Localidad']; ?></p>
                                    <a href="../crudinmuebles/interfazinmuebles.php?id=<?= $reg['IdInmueble'] ?>" class="btn btn-dark">Más Detalles</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                echo '<p class="text-center">No hay inmuebles registrados.</p>';
            }
            ?>
        </div>
        <div class="d-flex justify-content-center">
            <button id="verMasBtn" class="btn btn-info" style="width: 180px;">
                Ver más
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
            <br>

            <button id="ocultarBtn" class="btn btn-info " style="width: 180px;" style="display: none;">
                Ocultar
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
        </div>
    </section>






    <br>

    <!--FIN  la seccion de las tarjetas que muestran algunas casas en oferta y su informacion  -->
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <!-- Seccion de las sugerencias -->
    <form>
        <h1 class="text-center tipo-letra" id="sugerencias-caja-inmobiliaria">SUGERENCIAS</h1>
        <hr class="mx-auto" style="width: 12%;">
        <div class="container" style="max-width: 600px; ">
            <!-- Establecer el ancho máximo del formulario -->
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" placeholder="Ingresa tu nombre">
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
            </div>
            <div class="form-group">
                <label for="message">Mensaje</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Ingresa tu mensaje"></textarea>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-info" style="width:580px ;">Enviar</button>
        </div>
        </div>
    </form>
    <br>


    <!-- Fin de la seccion de las sugerencias -->

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


    <!-- FIN  Footer -->









    <!-- link del script de los botones de mostrar y ocultar -->
    <script src="../js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>


    <!-- Link javaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>