<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title> Blog de Viajes </title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
</head>

<body>
    <!-- CABECERA -->
    <header id="header">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php"> Blog de Viajes </a>
        </div>

        <!-- MENÚ -->
        
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php"> Inicio </a>
                </li>

                <?php 
                    $categorias =conseguirCategorias($db);
                    if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
                ?> 
                
                    <li>
                        <a href="categoria.php?id=<?=$categoria['id']?>"> <?=$categoria['nombre'] ?> </a>
                    </li>
                
                <?php 
                    endwhile; 
                    endif;
                ?>

                <li>
                    <a href="./sobrenosotros.php"> Sobre nosotros </a>
                </li>

                <li>
                    <a href="./contacto.php"> Contacto </a>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>

    <div id="container">