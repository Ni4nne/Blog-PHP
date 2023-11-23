<?php
require_once 'includes/redireccion.php';
require_once 'includes/header.php';
require_once 'includes/lateral.php';
?>

<!-- CONTENIDO PRINCIPAL -->
<div id="principal">
    <h1> Crear entrada </h1>
    </br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo"> Título de la entrada: </label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
        
        <label for="descripcion"> Descripción de la entrada: </label>
        <input type="text" name="descripcion"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

        <label for="categoria"> Selecciona la categoría: </label>
        <select name="categoria">
            
            <?php
            //Las categorias se consiguen con la función conseguirCategorias
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias)):
            ?>

            <option value="<?=$categoria['id']?>">
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