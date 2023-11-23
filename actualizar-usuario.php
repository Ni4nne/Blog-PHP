<?php

if (isset($_POST)) {

    //Incluir conexión a la BBDD
    require_once 'includes/conexion.php';

    //Se recogen los valores del formulario. Operador ternario.
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    //Array de errores para validar campos del formulario
    $errores = array();

    //Validar nombre que no esté vacío, que no sea numérico y que no contenga ningún número
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es correcto.";
    }

    //Validar apellidos que no estén vacíos, que no sean numéricos y que no contengan ningún número
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

    $guardar_usuario = false;

    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;
        
        //Comprobar si existe el correo nuevo en la BBDD
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            
            //Actualización del usuario en la tabla BBDD
                $sql = "UPDATE usuarios SET ".
                "nombre = '$nombre',".
                "apellidos = '$apellidos',".
                "email = '$email' ".
                "WHERE id = ".$usuario['id'];
            $guardar = mysqli_query($db, $sql);


            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "Los datos se han actualizado con éxito!!";
                
            } else {
                $_SESSION['errores']['general'] = "Error al actualizar los datos.";
            }
        }else{
            $_SESSION['errores']['general'] = "El correo ya existe.";
        }   
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: mis-datos.php');
?>
