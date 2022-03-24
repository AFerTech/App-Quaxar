<div class="contenedor olvide">
<?php include_once  __DIR__ .'/../templates/nombre-sitio.php'; ?>


    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar contraseña</p>

        <form class="formulario" method="POST" action="/recuperar">
            <div class="campo">
                <label for="email">Email</label>
                <input	
                    type="email"
                    id="email"
                    placeholder="Tu email"
                    name="email">
            </div>
            
            <input type="submit"
                   class="boton"
                   value="Enviar">
        </form>
        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            
        </div>

    </div>
</div>