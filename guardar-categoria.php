<?php

if (isset($_POST)) {
    //Incluir conexión a la BBDD
    require_once 'includes/conexion.php';

    $nombreCategoria = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

    //Array de errores para validar campos del formulario
    $errores = array();

    //Validar nombre: Valida que no esté vacío, que no sea numérico y que no contenga ningún número
    if (!empty($nombreCategoria) && !is_numeric($nombreCategoria) && !preg_match("/[0-9]/", $nombreCategoria)) {
        $categoria_validada = true;
        $_SESSION['errores'] = null;
        header("Location: index.php");
        
    } else {
        $categoria_validada = false;
        $errores['nombre'] = "La categoría no es correcta.";
        header("Location: crear-categoria.php");
    }

    //Si no hay errores en la validación se añade la categoría
    if(count($errores) == 0){
    $sql = "INSERT INTO categorias VALUES (null, '$nombreCategoria');";
    $guardar = mysqli_query($db, $sql);
    }else {
        $_SESSION['errores'] = $errores;
    }
}

?>