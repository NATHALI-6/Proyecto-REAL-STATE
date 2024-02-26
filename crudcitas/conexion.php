<?php
//   http://localhost/crudrealstate/conexion.php -->
$servername="localhost";
$database="realstate";
$username="root";
$pasaword="";

    $con=  new mysqli("$servername", "$username", "$pasaword", "$database");

    if($con -> connect_error ) {
        die("FALLA EN LA CONEXION " . $con -> connect_error) ; 
    }

?>
