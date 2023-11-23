<?php

if (isset($_POST)) {

    //Incluir conexión a la BBDD
    require_once 'includes/conexion.php';

    //Se recogen los valores del formulario. Operador ternario. Escapar datos para evitar inyección SQL
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //Array de errores para validar campos del formulario
    $errores = array();

    //Validar nombre: Valida que no esté vacío, que no sea numérico y que no contenga ningún número
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es correcto.";
    }

    //Validar apellidos: Valida que no esté vacío, que no sea numérico y que no contenga ningún número
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son correctos.";
    }

    //Validar email: con la función filter_var se pasan los parámetros y el tipo de filtro para email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es correcto.";
    }

    //Validar contraseña: únicamente que no esté vacía
    if (!empty($password)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = "Por favor, introduzca una contraseña";
    }

    $guardar_usuario = false;

    if (count($errores) == 0) {
        $guardar_usuario = true;

        //Cifrar la contraseña del usuario
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        //Insertar usuario en la BBDD
        //FIXME: cuando inserta un usuario ya existente en la tabla USUARIOS lanza "Fatal error: 
        //Uncaught mysqli_sql_exception: Duplicate entry 'kevin@kevin.com' for key 'uq_email'"
        $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        //FIXME: Cuando se registra el usuario solo se muestra el mensaje correcto
        //No se eliminan los formularios de acceso/ registro
        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con éxito!!";
            header('Location: index.php');
        } else {
            $_SESSION['errores']['general'] = "Error al guardar el usuario.";
        }

    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');
?>
