<?php
//Iniciar la sesion y conexión a BBDD
require_once 'includes/conexion.php';

//Recoger datos del formulario
if(isset($_POST)) {

    //Borrar posibles sesiones de login anteriores con error
    session_unset();

    //Recoger variables del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consultar credenciales usuario en la BBDD
    $sql = "SELECT * FROM usuarios WHERE email = '$email' ";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) ==1){
        $usuario = mysqli_fetch_assoc($login);
        
        //Comprobar contraseña
        $verify = password_verify($password,$usuario['password']);

        if($verify){
            //Si la verificación es correcta, se crea una sesión
            //y se dirige al index.php
            $_SESSION['usuario'] = $usuario; 
            header('Location: index.php');     
            
            //Si la verif. es correcta se elimina la sesión de error
            if(isset($_SESSION['error_login'])){
                session_unset($_SESSION['error_login']);
            }
        }else{
            //Si la verificación es incorrecta, se muestra mensaje de error
            $_SESSION['error_login']= "Login incorrecto.";
        }
    }else{
        //Mensaje de error
        $_SESSION['error_login']= "Login incorrecto.";
    }
}

header('Location: index.php');
?>
