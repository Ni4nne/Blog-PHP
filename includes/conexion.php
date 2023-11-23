<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "blog-php";

    $db = mysqli_connect($server, $username, $password,$database) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//Codificar resultados para que admita carácteres utf-8
mysqli_query($db, "SET NAMES 'utf8'");

//Si no existe, se inicia la sesión
if(!isset($_SESSION)) {
    session_start();
}

?>