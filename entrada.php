<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$entrada_actual = conseguirEntrada($db, $_GET['id']);

	if(!isset($entrada_actual['id'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
   
<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> <?=$entrada_actual['titulo']?> </h1>

    <span class="fecha"> <?=$entrada_actual['categoria'] .'  | ' .$entrada_actual['fecha']?> </span>
    <div class="autor"> Autor de la entrada: <?=$entrada_actual['usuario']?> </div>

    <br>
    <p>
        <?=$entrada_actual['descripcion']?>
    </p>

    <?php if(isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
		<br/>	
		<a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar entrada</a>
		<a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-cerrar">Eliminar entrada</a>
	<?php endif; ?>


</div> <!-- Fin contenedor principal -->

<?php require_once 'includes/pie.php'; ?>