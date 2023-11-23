<?php 
    //Incluir menu cabecera y lateral
    require_once 'includes/header.php';
    require_once 'includes/lateral.php'; 


    //Si no exite la categoria de $_GET, se redirige a index
    $categoria_actual = conseguirCategoria($db, $_GET['id']);
    if(!isset($categoria_actual['id'])){
        header("Location: index.php");
    }
?>
   
<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Entradas de <?=$categoria_actual['nombre']?> </h1>

    <?php 
		$entradas = conseguirEntradas($db, null, $_GET['id']);

		if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
			while($entrada = mysqli_fetch_assoc($entradas)):
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>">
						<h2><?=$entrada['titulo']?></h2>
						<span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		else:
	?>
		<div class="alerta alerta-error">No hay entradas en esta categoría</div>
	<?php endif; ?>


    </div> <!--fin principal-->

    <?php require_once 'includes/pie.php'; ?>