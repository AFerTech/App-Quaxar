<div class="contenedor reestablecer">
<?php include_once  __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">

        <p class="descripcion-pagina">Ingresar nueva contraseña</p>

        <?php include_once __DIR__ .'/../templates/alertas.php'; ?>

        <?php  if($mostrar) {   ?>

        <form class="formulario" method="POST" >
            <div class="campo">
                <label for="password">Password</label>
                <input	
                    type="password"
                    id="password"
                    placeholder="Password"
                    name="password">
            </div>
            <div class="campo">
                <label for="password2">Repetir password</label>
                <input	
                    type="password"
                    id="password2"
                    placeholder="Password"
                    name="password2">
            </div>
            <input type="submit"
                   class="boton"
                   value="Guardar">
        </form>

        <?php } ?>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            
        </div>

    </div>
</div>