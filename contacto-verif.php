<?php
if (isset($_POST)) {

    //Incluir conexión a la BBDD
    require_once 'includes/conexion.php';

    //Se recogen los valores del formulario. Operador ternario.
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $comentario = isset($_POST['comentario']) ? mysqli_real_escape_string($db, $_POST['comentario']) : false;

    $errores = array();

    //Validar nombre que no esté vacío
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es correcto.";
    }

    //Validar email: con la función filter_var se pasan los parámetros y el tipo de filtro para email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es correcto.";
    }

    //Validar comentario que no esté vacío
    if (!empty($comentario)) {
        $comentario_validado = true;
    } else {
        $comentario_validado = false;
        $errores['comentario'] = "El comentario no puede estar vacío.";
    }

    $guardar_comentario = false;

    if (count($errores) == 0) {
        $guardar_comentario = true;

        //Insertar comentario en la BBDD
        $sql = "INSERT INTO contacto VALUES (null,'$nombre', '$email', '$comentario');";
        $enviar = mysqli_query($db, $sql);
    }

    if ($enviar) {
        $_SESSION['completado'] = "Tu comentario ha sido enviado!!";
    } else {
        $_SESSION['errores']['general'] = "Alguno de los campos contiene errores o están vacíos.";
    }
} else {
    $_SESSION['errores'] = $errores;
}

header('Location: contacto.php');
?>