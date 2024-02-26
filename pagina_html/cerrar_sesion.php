<?php
// Iniciar la sesión
session_start();

// Deshabilitar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a donde desees después de cerrar sesión
header("Location: ../pagina_html/entrar.php");
exit();
?>