<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Últimas entradas </h1>

    <?php
    $entradas = conseguirEntradas($db, true);
    if (!empty($entradas)):
        while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
            <article class="entrada">
                
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?> </h2>
                    <span class="fecha">
                        <?=$entrada['categoria'].' | ' .$entrada['fecha']?>
                    </span>
                    <p> 
                    
                        <?= 
                        //Función substring para delimitar el num de carácteres que se 
                        //mostrarán de la entrada en el índice.
                        substr($entrada ['descripcion'], 0, 250). " ..."?>
                    </p>
                </a>
            </article>

    <?php
        endwhile;
        endif;
    ?>

    <div id="ver-todas">
        <a href="entradas.php"> Ver todas las entradas </a>
    </div>

</div> <!-- Fin contenedor principal -->

<?php require_once 'includes/pie.php'; ?>