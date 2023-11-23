<?php
//Si no existe, se inicia la sesión
if(!isset($_SESSION)) {
    session_start();
}

//Si no existe el usuario, redirige a la página index.php
if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

?>