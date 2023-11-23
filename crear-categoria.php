<?php
require_once 'includes/redireccion.php'; 
require_once 'includes/header.php'; 
require_once 'includes/lateral.php'; 
?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Crear categorías </h1>
    </br>
        <form action="guardar-categoria.php" method="POST">

            <label for ="nombre"> Nombre de la categoría: </label>
            <input type="text" name="nombre" />

            <?php if(isset($_SESSION['errores'])) {
                echo "<div class='alerta alerta-error'>"."Error Categoria".'</div>';
            }
            ?>

            <input type="submit" value="Guardar" />

        </form>

</div> <!-- Fin contenedor principal -->

<?php require_once 'includes/pie.php'; ?>