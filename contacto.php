<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/helpers.php'; ?>


<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Déjanos saber tus comentarios y sugerencias </h1>
<br>

<?php
            //Muestra el ENVIO del comentario
            if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php 
            
            //Si no se completa el envio, se muestra mensaje de error del array errores
            elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <!-- Formulario CONTACTO -->
            <form action="contacto-verif.php" method="POST">
                <label for="nombre"> Nombre: </label>
                <input type="text" name="nombre" />
                
                <label for="email"> Email: </label>
                <input type="email" name="email" />
                
                <label for="comentario"> Comentario: </label>
                <input type="text" name="comentario" />
                
                <input type="submit" name="submit" value="Enviar" />
            </form>

            <?php if(isset($_SESSION['errores'])) {
                    echo borrarErrores();
                    }

                    if(isset($_SESSION['completado'])) {
                        echo borrarErrores();
                        }
            ?>
        </div>
    
    <?php require_once 'includes/pie.php'; ?>