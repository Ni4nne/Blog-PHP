<!-- SIDEBAR -->
<aside id="sidebar">

<div id="buscador" class="block-aside">
            <h3> Buscar entradas </h3>

            <!-- Formulario BUSCADOR -->
            <form action="buscar.php" method="POST">
                <input type="text" name="busqueda">
                <input type="submit" value="Buscar">
            </form>
        </div>

    <?php
    //Si existe $_SESSION['usuario'] muestra los botones
    if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="block-aside">
            <h3> Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']; ?> </h3>

            <!-- BOTONES ACCIONES HTML-->
            <a href="crear-entrada.php" class="boton boton-verde"> Crear entradas </a>
            <a href="crear-categoria.php" class="boton boton"> Crear categorías </a>
            <a href="mis-datos.php" class="boton boton-naranja"> Mis datos </a>
            <a href="cerrar.php" class="boton boton-cerrar"> Cerrar Sessión </a>

        </div>
    <?php endif; ?>

    <?php
    //Si no existe $_SESSION['usuario'] muestra los menús para acceder / registrarse
    if (!isset($_SESSION['usuario'])) : ?>
        <div id="login" class="block-aside">
            <h3> Identifícate </h3>


            <?php
            //Muestra errores en LOGIN
            if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <!-- Formulario LOGIN -->
            <form action="login.php" method="POST">
                <label for="email"> Email: </label>
                <input type="email" name="email">

                <label for="password"> Contraseña: </label>
                <input type="password" name="password">

                <input type="submit" value="Entrar">
            </form>
        </div>

        <div id="register" class="block-aside">
            <h3> Regístrate </h3>

            <?php
            //Muestra el REGISTRO completado
            if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php 
            
            //Si no se completa el REGISTRO, se muestra mensaje de error del array errores
            elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <!-- Formulario REGISTRO -->
            <form action="registro.php" method="POST">
                <label for="nombre"> Nombre: </label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellidos"> Apellidos: </label>
                <input type="text" name="apellidos" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

                <label for="email"> Email: </label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password"> Contraseña: </label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" name="submit" value="Registrar" />
            </form>
            <?php if(isset($_SESSION['errores'])) {
                    echo borrarErrores();
                    }

                    if(isset($_SESSION['completado'])) {
                        echo borrarErrores();
                        }
            ?>

        </div>
    <?php endif; ?>
</aside>