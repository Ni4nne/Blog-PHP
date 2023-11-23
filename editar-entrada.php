<?php 
    require_once 'includes/redireccion.php';
    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php'; 
    
	$entrada_actual = conseguirEntrada($db, $_GET['id']);

	if(!isset($entrada_actual['id'])){
		header("Location: index.php");
	}

    require_once 'includes/header.php';
    require_once 'includes/lateral.php'; ?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Editar entrada: <?=$entrada_actual['titulo']?> </h1>
    </br>
    <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label for="titulo"> Título de la entrada: </label>
        <input type="text" name="titulo" value ="<?=$entrada_actual['titulo']?>" />
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
        
        <label for="descripcion"> Descripción de la entrada: </label>
        <input type="text" name="descripcion" value ="<?=$entrada_actual['descripcion']?>"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label for="categoria"> Selecciona la categoría: </label>
        <select name="categoria">
            
            <?php
            //Las categorias se consiguen con la función conseguirCategorias
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)):
            ?>

            <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
                <?=$categoria['nombre']?>
            </option>

                        <?php
                endwhile;
            endif;
            ?>
        </select>

        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <input type="submit" value="Guardar" />
    </form>
<?php borrarErrores(); ?>

</div> <!-- Fin contenedor principal -->

<?php require_once 'includes/pie.php'; ?>